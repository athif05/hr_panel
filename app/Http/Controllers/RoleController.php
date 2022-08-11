<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_roles = Role::orderBy('name','asc')->get();

        return view('manage-roles', compact('all_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-role');
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

        $input = Role::insert([
            'name' => $request->name,
            'status' => '1',
        ]);


        if($input){
            return back()->with('success_msg', 'Role is added.');
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
        $role_details = Role::where('id', $id)->first();
        
        return view('update-role', compact('role_details'));
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
        //dd($request);
        $request->validate([
            'name' => 'required|max:100',
        ], [
            'name.required' => 'Name is required',
        ]);

        Role::where('id', $request->role_id)
            ->update([
                'name' => $request->name,
            ]);

        return redirect('/manage-roles')->with('success_msg', 'Role updated.');
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


    public function updateStatus(Request $request) {

        $input = Role::where('id', $request->role_id)
            ->update([
                'status' => $request->role_status,
            ]);

        return $request->role_status;

    }


    public function deleteRole(Request $request) {

        $input = Role::where('id', $request->role_id)
            ->update([
                'is_deleted' => $request->role_del_status,
            ]);

        return $request->role_del_status;

    }
}
