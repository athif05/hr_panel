<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\CompanyLocation;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $users = User::with('company_name')->where('users.id', $user_id)
        ->leftJoin('designations','designations.id','=','users.designation')
        ->select('users.*','designations.name as designation_name')
        ->first();

        $currentLogo = $users->company_name->logo;
        $designation_name = $users->designation_name;
        Session::put('company_logo', $currentLogo);
        Session::put('designation_name', $designation_name);


        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();
        //dd($company_locations);
        return view('home', compact('users','company_locations'));
    }
}
