<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\MemberEducation;

use Auth;

class MemberEducationController extends Controller
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
    public function saveMemberEducation(Request $request)
    {
        
        $user_id=$request->ajax_user_id; 

        $education_deatils_checks = DB::table('member_educations')
        ->where('user_id', $user_id)
        ->get();

        if(count($education_deatils_checks)>0) {

            DB::table('member_educations')->where('user_id', $user_id)->delete();
        }


        for($i=0;$i<count($request->course_name);$i++) {

            DB::table('member_educations')->insert([
                'user_id' => $user_id,
                'course_name' => $request->course_name[$i],
                'university_name' => $request->university_name[$i],
                'passing_year' => $request->passing_year[$i],
                'percentage' => $request->percentage[$i],
            ]);
        }   


        return true;
        
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
