<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{User, AnnualReviewMom, AnnualReviewForm, Designation};
use App\Http\Controllers\UserController;

use Auth;

class AnnualReviewMomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($survey_form_id)
    {
        $manager1=Auth::user()->member_id;
        //dd($manager1);
        $manager_array= (new UserController)->multilevel_manager($manager1);

        $all_members = User::where('users.employee_type','Confirmed')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'departments.name as department_name')
        ->orderBy('users.first_name','asc')->get();


        $mom_details = AnnualReviewMom::where('annual_review_form_id',$survey_form_id)
        ->get();


        return view('annual-review-mom-list', compact('all_members','mom_details','survey_form_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

            $request->validate([
                'minutes_of_meeting' => 'required',
                'content' => 'required',
                'confidence' => 'required',
                'communication' => 'required',
                'data_relevance' => 'required',
                'overall_growth_individual' => 'required',
            ], [
                'minutes_of_meeting.required' => 'MOM is required.',
                'content.required' => 'Please rate...',
                'confidence.required' => 'Please rate...',
                'communication.required' => 'Please rate...',
                'data_relevance.required' => 'Please rate...',
                'overall_growth_individual.required' => 'Please rate...',
            ]);


            if($request->recommend_for_promotion!='No'){
                $request->validate([
                    'recommend_for_promotion_id' => 'required',
                ], [
                    'recommend_for_promotion_id.required' => 'Please select designation for promotion',
                ]);
            }


            
            if($request->recommend_increment!='No'){
                $request->validate([
                    'how_much_increment_amount' => 'required',
                ], [
                    'how_much_increment_amount.required' => 'Please share how much amount for increment',
                ]);
            }

        
            $status='2';
        }

        $how_much_increment=0;
        $how_much_increment_amount=0;
        $how_much_increment_percentage=0;

        if($request->recommend_increment=='No'){
            $how_much_increment='';
            $how_much_increment_amount='';
            $how_much_increment_percentage='';
        } else {

            if($request->how_much_increment=='INR'){
                $how_much_increment_amount=$request->how_much_increment_amount;

                if($request->salary_percentage_automate){
                    $how_much_increment_percentage= (($request->how_much_increment_amount/$request->salary_percentage_automate) * 100);
                    $how_much_increment_percentage=number_format((float)$how_much_increment_percentage, 2, '.', '');
                }
                

            } elseif($request->how_much_increment=='%') {

                $how_much_increment_percentage=$request->how_much_increment_amount; //calculate percentage

                $how_much_increment_amount=(($request->how_much_increment_amount/100) * $request->salary_percentage_automate); //calculate amount
            }   
        }


        $survey_form_id=$request->survey_form_id;
        $filled_by=$request->filled_by;
        $filled_for=$request->filled_for;

        $input = AnnualReviewMom::insert([
            'filled_by' => $filled_by,
            'filled_for' => $filled_for,
            'annual_review_form_id' => $survey_form_id,
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => (!is_null($request->content) ? $request->content : "NA"),
            'confidence' => (!is_null($request->confidence) ? $request->confidence : "NA"),
            'communication' => (!is_null($request->communication) ? $request->communication : "NA"),
            'data_relevance' => (!is_null($request->data_relevance) ? $request->data_relevance : "NA"),
            'overall_growth_individual' => (!is_null($request->overall_growth_individual) ? $request->overall_growth_individual : "NA"),
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $how_much_increment_amount,
            'how_much_increment_percentage' => $how_much_increment_percentage,
            'recommend_for_promotion' => $request->recommend_for_promotion,
            'recommend_for_promotion_id' => $request->recommend_for_promotion_id,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($input){
            
            if($status==1){
                
                return redirect("/annual-review-mom-form-edit/$survey_form_id/$filled_for/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                //return redirect('/annual-review-manager-feedback-form-show')

                return redirect("/annual-review-mom-form-show/$survey_form_id/$filled_for/$last_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForm($survey_form_id, $member_id)
    {
        //echo $survey_form_id.'/'.$member_id; dd();

        $filled_by=Auth::user()->id;
        $filled_for=$member_id;


        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();


        $survey_form_details = AnnualReviewForm::where('id',$survey_form_id)
        ->first();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        return view('annual-review-mom-form', compact('survey_form_id','filled_by','filled_for','member_details','survey_form_details','designation_names'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($survey_form_id, $member_id, $edit_id)
    {
        $filled_by=Auth::user()->id;
        $filled_for=$member_id;

        $mom_form_details = AnnualReviewMom::where('id',$edit_id)
        ->where('filled_for',$filled_for)
        ->where('annual_review_form_id',$survey_form_id)
        ->first();

        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $survey_form_details = AnnualReviewForm::where('id',$survey_form_id)
        ->first();

        return view('annual-review-mom-form-edit', compact('survey_form_id','filled_by','filled_for','member_details','survey_form_details','mom_form_details','designation_names'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //echo $request;

        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

            $request->validate([
                'minutes_of_meeting' => 'required',
                'content' => 'required',
                'confidence' => 'required',
                'communication' => 'required',
                'data_relevance' => 'required',
                'overall_growth_individual' => 'required',
            ], [
                'minutes_of_meeting.required' => 'MOM is required.',
                'content.required' => 'Please rate...',
                'confidence.required' => 'Please rate...',
                'communication.required' => 'Please rate...',
                'data_relevance.required' => 'Please rate...',
                'overall_growth_individual.required' => 'Please rate...',
            ]);

            if($request->recommend_for_promotion!='No'){
                $request->validate([
                    'recommend_for_promotion_id' => 'required',
                ], [
                    'recommend_for_promotion_id.required' => 'Please select designation for promotion',
                ]);
            }

            if($request->recommend_increment!='No'){
                $request->validate([
                    'how_much_increment_amount' => 'required',
                ], [
                    'how_much_increment_amount.required' => 'Please share how much increment_amount',
                ]);
            }

            $status='2';
        }
        
        if($request->recommend_for_promotion=='No'){
            $recommend_for_promotion_id='';
        } else {
            $recommend_for_promotion_id=$request->recommend_for_promotion_id;
        }


        $how_much_increment=0;
        $how_much_increment_amount=0;
        $how_much_increment_percentage=0;

        if($request->recommend_increment=='No'){
            $how_much_increment='';
            $how_much_increment_amount='';
            $how_much_increment_percentage='';
        } else {

            if($request->how_much_increment=='INR'){
                $how_much_increment_amount=$request->how_much_increment_amount;

                if($request->salary_percentage_automate){
                    $how_much_increment_percentage= (($request->how_much_increment_amount/$request->salary_percentage_automate) * 100);
                    $how_much_increment_percentage=number_format((float)$how_much_increment_percentage, 2, '.', '');
                }

            } elseif($request->how_much_increment=='%') {

                $how_much_increment_percentage=$request->how_much_increment_amount; //calculate percentage

                $how_much_increment_amount=(($request->how_much_increment_amount/100) * $request->salary_percentage_automate); //calculate amount
            }   
        }

        $edit_id=$request->edit_id;
        $survey_form_id=$request->survey_form_id;
        $filled_by=$request->filled_by;
        $filled_for=$request->filled_for;

        AnnualReviewMom::where('id', $edit_id)
        ->where('annual_review_form_id', $survey_form_id)
        ->where('filled_for', $filled_for)
        ->update([
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => (!is_null($request->content) ? $request->content : "NA"),
            'confidence' => (!is_null($request->confidence) ? $request->confidence : "NA"),
            'communication' => (!is_null($request->communication) ? $request->communication : "NA"),
            'data_relevance' => (!is_null($request->data_relevance) ? $request->data_relevance : "NA"),
            'overall_growth_individual' => (!is_null($request->overall_growth_individual) ? $request->overall_growth_individual : "NA"),
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $how_much_increment_amount,
            'how_much_increment_percentage' => $how_much_increment_percentage,
            'recommend_for_promotion' => $request->recommend_for_promotion,
            'recommend_for_promotion_id' => $recommend_for_promotion_id,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'status' => $status,
        ]);

        
        if($status==1){
                
            return redirect("/annual-review-mom-form-edit/$survey_form_id/$filled_for/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            //return redirect('/annual-review-manager-feedback-form-show')

            return redirect("/annual-review-mom-form-show/$survey_form_id/$filled_for/$edit_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

        }
    }


    public function showDetails($survey_form_id, $filled_for, $id)
    {
        $mom_form_details= AnnualReviewMom::where('id',$id)
        ->where('annual_review_form_id',$survey_form_id)
        ->where('filled_for',$filled_for)
        ->first();

        $survey_form_details = AnnualReviewForm::where('id',$survey_form_id)
        ->first();

        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        return view('annual-review-mom-form-show',compact('mom_form_details','survey_form_details','member_details','designation_names'));

    }
}
