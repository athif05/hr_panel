<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Department;
use App\Models\CompanyName;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_departments = Department::leftJoin('company_names', 'company_names.id', '=', 'departments.company_id')
        ->select('departments.*', 'company_names.name as company_name_show')
        ->orderBy('departments.name','asc')->get();

        //$all_companies = CompanyName::orderBy('name','asc')->get();

        return view('manage-departments', compact('all_departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $company_details = CompanyName::where('status', '1')
        ->where('is_deleted','0')
        ->get();

        return view('add-new-department', compact('company_details'));
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
            'company_id' => 'required',
        ], [
            'name.required' => 'Name is required',
            'company_id.required' => 'Company name is required',
        ]);

        $input = Department::insert([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'status' => '1',
        ]);


        if($input){
            return back()->with('success_msg', 'Department is added.');
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
        $department_details = Department::where('id', $id)->first();

        $company_details = CompanyName::where('status', '1')
        ->where('is_deleted','0')
        ->get();

        
        return view('update-department', compact('department_details','company_details'));
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
            'company_id' => 'required',
        ], [
            'name.required' => 'Name is required',
            'company_id.required' => 'Company name is required',
        ]);

        Department::where('id', $request->department_id)
            ->update([
                'name' => $request->name,
                'company_id' => $request->company_id,
            ]);

        return redirect('/manage-departments')->with('success_msg', 'Department updated.');
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
