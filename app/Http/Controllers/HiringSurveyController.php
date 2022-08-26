<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HiringSurvey;
use App\Models\CompanyName;
use App\Models\CompanyLocation;
use App\Models\JobOpeningTypes;
use App\Models\User;

use Auth;

class HiringSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $job_opening_types = JobOpeningTypes::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $recruiter_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();
        //dd($company_names);

        /*check record is exist or not*/
        $member_details = User::where('users.id', $user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name')
        ->first();

        return view('hiring-survey', compact('member_details','company_names','company_locations','job_opening_types','recruiter_details'));
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
        //
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
