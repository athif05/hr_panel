<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile; //for image upload
use Illuminate\Support\Facades\DB;

use App\Models\{AnnualReviewPptUpload};

use Auth;

class AnnualReviewPptUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($survey_from_id)
    {
        $annual_review_ppt_details='';

        $member_id=Auth::user()->id;
        $annual_review_form_id=$survey_from_id;


        $check=AnnualReviewPptUpload::where('member_id',$member_id)
            ->where('annual_review_form_id',$annual_review_form_id)->first();

        if($check){
            $annual_review_ppt_details=$check['ppt_name'];
        }
        
        return view('annual-upload-review-ppt', compact('annual_review_ppt_details','survey_from_id'));
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

        $base_url=$_SERVER['DOCUMENT_ROOT'];

        $member_id=$request->member_id;
        $annual_review_form_id=$request->annual_review_form_id;
        $submitted_date=date('Y-m-d H:i:s');
        
        $request->validate([
            'image' => 'required',
        ], [
            'image.required' => 'Please choose PPT.',
        ]);


        $ppt_details = AnnualReviewPptUpload::where('member_id', $member_id)
                        ->where('annual_review_form_id', $annual_review_form_id)->first();
        //print_r($ppt_details); die;

        $is_udpate=0;
        if($ppt_details){

            $unlink_url=$base_url.''.$ppt_details['ppt_name'];


            if($ppt_details['ppt_name']){
                
                unlink($unlink_url);

            }

            $is_udpate=1;
        }
        


        $profile_filePath = $request->file('image')->store('all-annual-review-ppt');

        $profile_pic_file_path = '/storage/' . $profile_filePath;

        if($is_udpate==1){

            $id=$ppt_details['id'];
            AnnualReviewPptUpload::where('id', $id)->update(['ppt_name' => $profile_pic_file_path]);

            //return back()->with('success_msg', 'Your PPT updated.');

            return redirect("/annual-upload-review-ppt/$annual_review_form_id")->with('success_msg', 'Your PPT updated.');

        } else {

            $input = AnnualReviewPptUpload::insert([
                'member_id' => $member_id,
                'annual_review_form_id' => $annual_review_form_id,
                'ppt_name' => $profile_pic_file_path,
                'submitted_date' => $submitted_date
            ]);

            //return back()->with('success_msg', 'Your PPT saved.');

            return redirect("/annual-upload-review-ppt/$annual_review_form_id")->with('success_msg', 'Your PPT saved.');
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
