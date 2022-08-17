<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\JobOpeningTypes;

class JobOpeningTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_opening_types_details = JobOpeningTypes::orderBy('name','asc')->get();

        return view('manage-job-opening-types', compact('job_opening_types_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-job-opening-type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ], [
            'name.required' => 'Name is required',
        ]);

        $input = JobOpeningTypes::insert([
            'name' => $request->name,
            'status' => '1',
        ]);


        if($input){
            return back()->with('success_msg', 'Job Opening Type is added.');
        } else {
            return back()->with('error_msg', 'Something is wrong.');
        }
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
        $job_opening_details = JobOpeningTypes::where('id', $id)->first();
        
        return view('update-job-opening-type', compact('job_opening_details'));
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
        $request->validate([
            'name' => 'required|max:100',
        ], [
            'name.required' => 'Name is required',
        ]);

        JobOpeningTypes::where('id', $request->edit_id)
            ->update([
                'name' => $request->name,
            ]);

        return redirect('/manage-job-opening-types')->with('success_msg', 'Job Opening Type name is updated.');
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
