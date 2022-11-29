<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{RoadFy, SectionFyList, RoadFyQuestion};

use Auth;

class RoadFyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($form_id, $section_id)
    {
        //echo "show form".$form_id.' / '.$section_id;

        $appraisal_cycle_data = DB::table('road_fys')->where('road_fys.annual_review_form_id',$form_id)
        ->first();

        $section_name_data = SectionFyList::where('id', $section_id)->where('annual_review_form_id', $form_id)
        ->first();

        $question_lists = DB::table('road_fy_questions')
        ->where('annual_review_form_id', $form_id)
        ->where('section_name',$section_name_data['section_name'])
        ->get();

        return view('add-survey-question-section-wise', compact('appraisal_cycle_data','section_name_data','question_lists'));
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
                
        $annual_review_form_id=$request->annual_review_form_id;
        $section_name=$request->section_name;
        $section_id=$request->section_id;

        $question_list_checks = DB::table('road_fy_questions')
        ->where('annual_review_form_id', $annual_review_form_id)
        ->where('section_name',$section_name)
        ->get();

        if(count($question_list_checks)>0) {

            DB::table('road_fy_questions')
            ->where('annual_review_form_id', $annual_review_form_id)
            ->where('section_name',$section_name)
            ->delete();
        }

        $status=1;
        for($i=0;$i<count($request->question_title);$i++) {

            DB::table('road_fy_questions')->insert([
                'annual_review_form_id' => $annual_review_form_id,
                'section_name' => $section_name,
                'question_title' => ($request->question_title[$i]),
                'question_hint' => ($request->question_hint[$i]),
                'question_type' => $request->question_type[$i],
                'question_value' => $request->question_value[$i],
                'status' => $status,
            ]);
        }  


        return redirect("/add-survey-question-section-wise/$annual_review_form_id/$section_id");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
