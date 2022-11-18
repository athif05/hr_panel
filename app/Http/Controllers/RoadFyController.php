<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\{RoadFy,RoadFyQuestion};

class RoadFyController extends Controller
{
    
    /* show road home page, start here */
    public function index()
    {
        return view('road-fy');
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
    public function create()
    {
        $roles = Role::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $current_year=date('Y');

        return view('add-new-road-fy-survey-form',compact('roles','current_year'));
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
    public function survey_multistep_form()
    {
        return view('multistep-form');
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
}
