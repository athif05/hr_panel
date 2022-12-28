<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\{RoadFy,RoadFyQuestion, SectionFyList};
use App\Models\{AnnualReviewForm, AnnualReviewFormAnswer};
use App\Models\{CompanyName, Designation, Department, CompanyLocation, JobOpeningTypes, AnnualReviewPptUpload, AnnualReviewHrOneOnOne};
use App\Models\User;

use Auth;

class RoadFyController extends Controller
{

    /* show survey form data after fill survey, start here */
    public function surveyFormView($form_id) {

        $member_id=Auth::user()->id;

        $survey_form_details = AnnualReviewFormAnswer::where('member_id', $member_id)
        ->where('annual_review_form_id', $form_id)
        ->get();


        $survey_form_section_name_details = AnnualReviewFormAnswer::where('member_id', $member_id)
        ->where('annual_review_form_id', $form_id)
        ->groupBy('section_name')
        ->get();


        return view('survey-form-view', compact('survey_form_details','survey_form_section_name_details'));

    }
    /* show survey form data after fill survey, end here */


    /* show road home page, start here */
    public function index()
    {   
        $member_id=Auth::user()->id;

        $annual_review_form_data=AnnualReviewForm::where('status','1')->first();
        $annual_review_form_id=$annual_review_form_data['id'];
        
        
        DB::enableQueryLog(); //for print sql query

        //check annual review form is filled or not
        $check_exist_or_not = AnnualReviewFormAnswer::where('member_id', $member_id)
        ->where('annual_review_form_id', $annual_review_form_id)
        ->first();

        /*for print sql query, start here */
        //$quries = DB::getQueryLog();
        //dd($quries);


        //check ppt uploaded or not
        $annual_review_ppt_details='';
        $check=AnnualReviewPptUpload::where('member_id',$member_id)
            ->where('annual_review_form_id',$annual_review_form_id)->first();

        if($check){
            $annual_review_ppt_details=$check['ppt_name'];
        }


        //check HR1:1 is filled by HR or not
        $check_hr_one_on_one=AnnualReviewHrOneOnOne::where('filled_for',$member_id)
            ->where('annual_review_form_id',$annual_review_form_id)
            ->where('status','2')->first();

        return view('road-fy', compact('annual_review_form_data','check_exist_or_not','annual_review_ppt_details','check_hr_one_on_one'));
    }
    /* show road home page, end here */

    
    /* show all previous road survey question, start here */
    public function show_all_list()
    {

        $roadfys = DB::table('road_fys')->leftJoin('roles','roles.id','=','road_fys.role_id')
        ->select('road_fys.*','roles.name as role_name')
        ->orderBy('road_fys.id','desc')
        ->get();

        return view('show-all-road-fy-survey-form', compact('roadfys'));
    }
    /* show all previous road survey question, end here */

    

    /* add road survey question form, start here */
    public function create($id)
    {
        $roles = Role::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        //$current_year=date('Y');

        $no_of_section=20;

        $review_form_name_data=AnnualReviewForm::where('id',$id)->first();

        $road_fy_data = DB::table('road_fys')->where('annual_review_form_id', $id)->first();
        //dd($road_fy_data);
        
        $section_fy_lists=SectionFyList::where('annual_review_form_id',$id)->get(); 


        return view('add-new-road-fy-survey-form',compact('roles','no_of_section','review_form_name_data','section_fy_lists','road_fy_data'));
    }
    /* add road survey question form, end here */



    /* save multiple step form data, start here */
    public function store(Request $request)
    {
        //echo "storeMultistepForm";

        $section1_count=count($request->sec1_question);
        $submitted_date=date('Y-m-d H:i:s');
        //echo $section1_count;

        /* check and delete if data already exist for same memeber and survey form, start here */
        $check_exist_or_not = DB::table('annual_review_form_answers')
        ->where('member_id', $request->member_id)
        ->where('annual_review_form_id', $request->annual_review_form_id)
        ->get();

        if(count($check_exist_or_not)>0) {

            DB::table('annual_review_form_answers')->where('user_id', $request->member_id)->where('annual_review_form_id', $request->annual_review_form_id)->delete();
        }
        /* check and delete if data already exist for same memeber and survey form, end here */


        /* submit survey form data, start here */
        for($i=0;$i<$section1_count;$i++){

            $input = AnnualReviewFormAnswer::insert([
                'member_id' => $request->member_id,
                'annual_review_form_id' => $request->annual_review_form_id,
                'section_id' => '1',
                'section_name' => 'General Information',
                'question' => $request->sec1_question[$i],
                'answer' => $request->sec1_answer[$i],
                'question_type' => 'textbox',
                'submitted_date' => $submitted_date,
            ]);

        }

        $qst_count=count($request->questions_id);


        for ($j=0; $j <$qst_count ; $j++) { 
            
            $sq=$request->questions_id[$j];
            
            $section_id=$request->section_id[$j];

            $section_name=$request->section_name[$j];

            $question_type=$request->question_type[$j];

            $qstn=$request->input('question_'.$sq);

            if(is_array($request->input('answer_'.$sq))){
                $answ=implode(',',$request->input('answer_'.$sq));
            } else {
                $answ=$request->input('answer_'.$sq);
            }
            
            //echo "<br>".$sq.' / '.$section_id.' / '.$section_name.' / '.$qstn.' / '.$answ;

            $input = AnnualReviewFormAnswer::insert([
                'member_id' => $request->member_id,
                'annual_review_form_id' => $request->annual_review_form_id,
                'section_id' => $section_id,
                'section_name' => $section_name,
                'question' => $qstn,
                'answer' => $answ,
                'question_type' => $question_type,
                'submitted_date' => $submitted_date,
            ]);

        }
        /* submit survey form data, start here */

        return redirect("/road-fy")->with('thank_you', 'Thank you for your time. Your survey has been submitted.');
        

    }
    /* save multiple step form data, end here */


    /* multiple step form view, start here */
    public function survey_multistep_form($form_id)
    {

        $member_id=Auth::user()->id;

        $check_exist_or_not = AnnualReviewFormAnswer::where('member_id', $member_id)
        ->where('annual_review_form_id', $form_id)
        ->first();

        if($check_exist_or_not) {

            return redirect("/survey-form-view/".$form_id);

        } else {

            $annual_review_form_data=AnnualReviewForm::where('annual_review_forms.id',$form_id)->where('annual_review_forms.status','1')->leftJoin('road_fys','annual_review_form_id','=','annual_review_forms.id')->select('annual_review_forms.*', 'road_fys.no_of_section as no_of_section')->first();

            $section_lists='';
            $question_lists='';
            if($annual_review_form_data) {

                $section_lists=SectionFyList::where('annual_review_form_id',$annual_review_form_data['id'])->get();

                $question_lists=RoadFyQuestion::where('annual_review_form_id',$annual_review_form_data['id'])->orderBy('id', 'ASC')->get();
            }

            $member_role=Auth::user()->role_id;
            if($member_role==1){
                $section_visible='Member';
            } else if($member_role==3) {
                $section_visible='Manager';
            } else if(($member_role==5) || ($member_role==6)) {
                $section_visible='HR';
            }


            
            $member_detail = User::where('users.id',$member_id)
            ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
            ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
            ->leftJoin('departments', 'departments.id', '=', 'users.department')
            ->leftJoin('designations', 'designations.id', '=', 'users.designation')
            ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
            ->first();

            $joining_date = date('Y-m-d', strtotime($member_detail->joining_date));


            /*tenure calculte, start here*/
            $total_tenure=0;

            $sdate = date("y-m-d");
            $edate = $joining_date;
            $date_diff = abs(strtotime($edate) - strtotime($sdate));

            $years = floor($date_diff / (365*60*60*24));
            $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
            //$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $total_tenure=$years.'.'.$months;
            /*$months=$months+($years*12);
            if($months>0){
                $total_tenure= (int)$months;
            }*/

            /*tenure calculte, end here*/
            

            return view('multistep-form',compact('annual_review_form_data','section_lists','question_lists','section_visible','member_detail','total_tenure'));

        }
            
    }
    /* multiple step form view, end here */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $current_year=date('Y');


        $roadfys = DB::table('road_fys')->where('road_fys.id',$id)
        ->first();

        return view('edit-road-fy-survey-form',compact('roles','current_year','roadfys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getNoOfSectionAjax(Request $request){

        $no_of_section=$request->no_of_section;
        $returnHTML = view('annual-review-section-list-ajax', compact('no_of_section'))->render();

        return response()->json($returnHTML);
    }

}
