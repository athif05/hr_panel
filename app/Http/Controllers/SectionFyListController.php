<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{RoadFy, SectionFyList};

use Auth;

class SectionFyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $annual_review_form_id=$request->annual_review_form_id; 

        //if($request['submit']=='Add') {
            $status='1';
        //} else if($request['submit']=='Add & Next') {

            $request->validate([
                'appraisal_cycle' => 'required',
                'no_of_section' => 'required',
            ], [
                'appraisal_cycle.required' => 'Appraisal cycle is required',
                'no_of_section.required' => 'Number of section is required',
            ]);

            //$status='2';
        //}


        $road_fy_checks = DB::table('road_fys')
        ->where('annual_review_form_id', $annual_review_form_id)
        ->get();

        if(count($road_fy_checks)>0) {

            DB::table('road_fys')->where('annual_review_form_id', $annual_review_form_id)
                ->update([
                    'appraisal_cycle' => $request->appraisal_cycle,
                    'no_of_section' => $request->no_of_section,
                    'status' => $status,
            ]);

        } else {

            DB::table('road_fys')->insert([
                'annual_review_form_id' => $annual_review_form_id,
                'appraisal_cycle' => $request->appraisal_cycle,
                'no_of_section' => $request->no_of_section,
                'status' => $status,
            ]);

        }

        $annual_review_form_checks = SectionFyList::where('annual_review_form_id', $annual_review_form_id)
        ->get();

        if(count($annual_review_form_checks)>0) {

            DB::table('section_fy_lists')->where('annual_review_form_id', $annual_review_form_id)->delete();
        }


        for($i=0;$i<count($request->section_name);$i++) {

            DB::table('section_fy_lists')->insert([
                'annual_review_form_id' => $annual_review_form_id,
                'section_name' => $request->section_name[$i],
                'visible_for' => $request->visible_for[$i],
                'status' => $status,
            ]);
        }  


        if($status==1){

            return redirect("/add-new-road-fy-survey-form/$annual_review_form_id")->with('thank_you', 'Your form save in draft.');

        }/* else if($status==2){

            return redirect("/add-survey-form-question/$annual_review_form_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

        } */

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
