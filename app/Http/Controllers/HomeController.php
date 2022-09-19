<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\{CompanyName, CompanyLocation, Department};

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

        $user_genders = User::where('employee_type','Probation')->get();


        $user_appraisal_cycle = User::where('employee_type','Probation')
                                ->where('appraisal_cycle','!=','')
                                ->get();



        $all_users = User::where('status','1')->where('is_deleted','0')->get();

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $no_of_departments = User::where('status','1')->where('is_deleted','0')->get();

        //dd(date('m-d', strtotime($user_genders[0]['appraisal_cycle'])));

        return view('home', compact('users','company_locations','user_genders','user_appraisal_cycle','all_users','company_names','no_of_departments'));
    }
}
