<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\FreshEyeJournal;
use App\Models\CompanyName;
use App\Models\CompanyLocation;
use App\Models\Designation;
use App\Models\Department;


use App\Models\PlaceYourselfCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Auth;

class FreshEyeJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $manager_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '2')
            ->orWhere('role_id', '3')
            ->orWhere('role_id', '4')
            ->orderBy('first_name','asc')
            ->get();

        $hod_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '4')
            ->orderBy('first_name','asc')
            ->get();

        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $yourself_category_details = PlaceYourselfCategory::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        
        return view('fresh-eye-journal-form', compact('designation_details','department_details','company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details'));

        /*check record is exist or not*/
        /*$check_in_member_details = DB::table('days_45_checkin_members')->where('user_id', $user_id)->first();
        

        if(($check_in_member_details === null) or (($check_in_member_details->status === '0') or ($check_in_member_details->status === ''))){

            return view('fresh-eye-journal-form', compact('company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details'));

        } else if($check_in_member_details->status === '1'){

            return redirect("/fresh-eye-journal-form-edit/$user_id");

        } else if($check_in_member_details->status === '2'){

            return view('fresh-eye-journal-form-show', compact('company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details','check_in_member_details'));
        }*/
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
        echo "store";
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
