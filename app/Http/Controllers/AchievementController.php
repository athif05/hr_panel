<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Achievement;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_achievements = Achievement::orderBy('name','asc')->get();

        return view('manage-achievements', compact('all_achievements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-achievement');
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

        $input = Achievement::insert([
            'name' => $request->name,
            'status' => '1',
        ]);


        if($input){
            return back()->with('success_msg', 'Achievement is added.');
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
        $achievement_details = Achievement::where('id', $id)->first();
        
        return view('update-achievement', compact('achievement_details'));
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

        Achievement::where('id', $request->achievement_id)
            ->update([
                'name' => $request->name,
            ]);

        return redirect('/manage-achievements')->with('success_msg', 'Achievement updated.');
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
