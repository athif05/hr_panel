<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\{RoadFy,RoadFyQuestion, SectionFyList};
use App\Models\AnnualReviewForm;

use Auth;

class RoadFyController extends Controller
{

    /* show road home page, start here */
    public function index()
    {   
        $annual_review_form_data=AnnualReviewForm::where('status','1')->first();

        return view('road-fy', compact('annual_review_form_data'));
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
        echo "storeMultistepForm";

        dd($request);
    }
    /* save multiple step form data, end here */


    /* multiple step form view, start here */
    public function survey_multistep_form($form_id)
    {
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

        return view('multistep-form',compact('annual_review_form_data','section_lists','question_lists','section_visible'));
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
