<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\CompanyName;

class CompanyNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_names = CompanyName::orderBy('name','asc')->get();

        return view('manage-company-names', compact('all_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-company');
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


        $profile_filePath = $request->file('image')->store('all-company-logos');

        $profile_pic_file_path = '/storage/app/' . $profile_filePath;


        $input = CompanyName::insert([
            'name' => $request->name,
            'logo' => $profile_pic_file_path,
            'status' => '1',
        ]);


        if($input){
            return back()->with('success_msg', 'Company is added.');
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
        $company_details = CompanyName::where('id', $id)->first();
        
        return view('update-company-name', compact('company_details'));
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
        $base_url=$_SERVER['DOCUMENT_ROOT'];

        $edit_id=$request->edit_id;

        $request->validate([
            'name' => 'required|max:100',
        ], [
            'name.required' => 'Name is required',
        ]);


        CompanyName::where('id', $edit_id)
            ->update([
                'name' => $request->name,
            ]);


        if($request->file('image')) {

            $image_details = CompanyName::where('id', $edit_id)->first();

            $unlink_url=$base_url.''.$image_details['logo'];


            if($image_details['logo']){
                
                unlink($unlink_url);

            }

            $profile_filePath = $request->file('image')->store('all-company-logos');

            $profile_pic_file_path = '/storage/app/' . $profile_filePath;

            CompanyName::where('id', $edit_id)
            ->update([
                'name' => $request->name,
                'logo' => $profile_pic_file_path,
            ]);

        }
        

        return redirect('/manage-company-names')->with('success_msg', 'Company name updated.');
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
