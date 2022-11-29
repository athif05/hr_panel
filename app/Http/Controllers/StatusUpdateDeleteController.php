<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class StatusUpdateDeleteController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request) {

        $table_name=$request->table_name;
        $status=$request->status;
        $id=$request->id;
        
        //DB::enableQueryLog(); //for print sql query
        if($table_name=='annual_review_forms'){
            
            $affected2 = DB::update(
                "update $table_name set status = '0'"
            );

            $affected = DB::update(
                "update $table_name set status = '$status' where id = ?",
                [$id]
            );

        } else {
            
            $affected = DB::update(
                "update $table_name set status = '$status' where id = ?",
                [$id]
            );
        }

            

        /*for print sql query, start here */
        //$quries = DB::getQueryLog();
        //dd($quries);

        /*$input = Role::where('id', $request->role_id)
            ->update([
                'status' => $request->role_status,
            ]);*/

        return $status;

    }


    public function deleteRow(Request $request) {

        /*$input = Role::where('id', $request->role_id)
            ->update([
                'is_deleted' => $request->role_del_status,
            ]);*/

        $table_name=$request->table_name;
        $del_status=$request->del_status;
        $id=$request->id;
        
        //DB::enableQueryLog(); //for print sql query

        $affected = DB::update(
            "update $table_name set is_deleted = '$del_status' where id = ?",
            [$id]
        );


        return $request->del_status;

    }

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

    
}
