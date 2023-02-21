<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\AnnualReviewForm;

use Auth;

class AnnualReviewFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $appraisal_year_lists=array();
        $current_year=date('Y');
        $next_year=$current_year+1;

        array_push($appraisal_year_lists,$current_year);
        array_push($appraisal_year_lists,$next_year);

        return view('create-annual-review-form', compact('appraisal_year_lists'));
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
        $updated_by = Auth::user()->id;
        $status='0';

        /*if($request['submit']=='Save in Draft') {
            $status='1';
        } else if($request['submit']=='Publish') {*/

            $request->validate([
                'form_name' => 'required',
                'appraisal_month' => 'required',
                'appraisal_year' => 'required',
            ], [
                'form_name.required' => 'Name is required',
                'appraisal_month.required' => 'Month is required',
                'appraisal_year.required' => 'Year is Required',
            ]);

            /*$status='2';
        }*/


        $input = AnnualReviewForm::insert([
            'form_name' => $request->form_name,
            'appraisal_month' => $request->appraisal_month,
            'appraisal_year' => $request->appraisal_year,
            'survey_form_label' => $request->survey_form_label,
            'hr_1_1_label' => $request->hr_1_1_label,
            'ppt_label' => $request->ppt_label,
            'stakeholder_label' => $request->stakeholder_label,
            'updated_by' => $updated_by,
            'status' => $status,
        ]);
        $last_id = DB::getPdo()->lastInsertId();

        if($input){
            
            /*if($status==1){

                return redirect("/edit-annual-review-form/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){*/

                return redirect("/add-new-road-fy-survey-form/$last_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

            //}
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAllAnnualReviewForms()
    {
        $all_lists=AnnualReviewForm::leftJoin('road_fys','road_fys.annual_review_form_id','=','annual_review_forms.id')->select('annual_review_forms.*','road_fys.no_of_section as no_of_section')->get();

        $hide_old_survey_form=strtotime(date("1-m-Y", strtotime("-7 months")));

        return view('manage-annual-review-form', compact('all_lists','hide_old_survey_form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appraisal_year_lists=array();
        $current_year=date('Y');
        $next_year=$current_year+1;

        array_push($appraisal_year_lists,$current_year);
        array_push($appraisal_year_lists,$next_year);

        $review_data=AnnualReviewForm::where('id',$id)->first();

        return view('edit-annual-review-form', compact('appraisal_year_lists','review_data'));
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
        $edit_id=$request->edit_id;
        $updated_by = Auth::user()->id;
        $status='0';

        $request->validate([
            'form_name' => 'required',
            'appraisal_month' => 'required',
            'appraisal_year' => 'required',
        ], [
            'form_name.required' => 'Name is required',
            'appraisal_month.required' => 'Month is required',
            'appraisal_year.required' => 'Year is Required',
        ]);


        //echo $status; die;
        
        //DB::enableQueryLog(); //for print sql query

        AnnualReviewForm::where('id', $edit_id)
        ->update([
            'form_name' => $request->form_name,
            'appraisal_month' => $request->appraisal_month,
            'appraisal_year' => $request->appraisal_year,
            'survey_form_label' => $request->survey_form_label,
            'hr_1_1_label' => $request->hr_1_1_label,
            'ppt_label' => $request->ppt_label,
            'stakeholder_label' => $request->stakeholder_label,
            'updated_by' => $updated_by,
            'status' => $status,
        ]);

        /*for print sql query, start here */
        //$quries = DB::getQueryLog();
        //dd($quries);
        
        if($request['submit']=='Update') {

            return redirect("/manage-annual-review-form")->with('success_msg', 'Annual review form updated successfully.');

        } else if($request['submit']=='Update & Next') {

            return redirect("/add-new-road-fy-survey-form/$edit_id")->with('thank_you', 'Annual review form updated successfully, add number of section in annual review form.');
        }
        

        /*if($status==1){

            return redirect("/edit-annual-review-form/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){*/

            //return redirect("/add-new-road-fy-survey-form/$edit_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

        //}
        
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
}
