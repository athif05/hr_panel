<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\InitiatingPipForm;
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

        $role_id = Auth::user()->role_id;

        /*query used for show logo and designations in dropdown menu, start here*/
        $users = User::with('company_name')->where('users.id', $user_id)
        ->leftJoin('designations','designations.id','=','users.designation')
        ->select('users.*','designations.name as designation_name')
        ->first();

        $currentLogo = $users->company_name->logo;
        $designation_name = $users->designation_name;
        Session::put('company_logo', $currentLogo);
        Session::put('designation_name', $designation_name);
        /*query used for show logo and designations in dropdown menu, end here*/


        /*check member is under in PIP or not, start here*/
        $is_under_pip_id=0;
        $pip_users = InitiatingPipForm::where('user_id', $user_id)
        ->where('is_approved_by_hr','1')       
        ->first();
        //dd($pip_users);

        if($pip_users!=null){
            $is_under_pip_id=$pip_users->user_id;    
        }
        Session::put('is_under_pip_member', $is_under_pip_id);
        /*check member is under in PIP or not, end here*/
        


        /*these all quries used for show data in dashboard, start here*/
        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_id=0;
        if($role_id==7){
            $company_id = Auth::user()->company_id;
        }

        $user_genders_query = User::where('employee_type','Probation');
        if($company_id!=0){
            $user_genders_query->where('company_id', '=', $company_id);
        }
        $user_genders = $user_genders_query->get();



        $user_appraisal_cycle_query = User::where('employee_type','Probation')
                                ->where('appraisal_cycle','!=','');
        if($company_id!=0){
            $user_appraisal_cycle_query->where('company_id', '=', $company_id);
        }
        $user_appraisal_cycle = $user_appraisal_cycle_query->get();



        $all_users_query = User::where('status','1')->where('is_deleted','0');
        if($company_id!=0){
            $all_users_query->where('company_id', '=', $company_id);
        }
        $all_users = $all_users_query->get();


        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        //$no_of_members = Department::withCount('user')->get();
        //dd($no_of_members);
        //dd(date('m-d', strtotime($user_genders[0]['appraisal_cycle'])));

        /*these all quries used for show data in dashboard, end here*/

        return view('home', compact('users','company_locations','user_genders','user_appraisal_cycle','all_users','department_names','company_names'));
    }



    public function homeDashboardFilter(Request $request)
    {
        $user_id = Auth::user()->id;

        $role_id = Auth::user()->role_id;

        /*query used for show logo and designations in dropdown menu, start here*/
        $users = User::with('company_name')->where('users.id', $user_id)
        ->leftJoin('designations','designations.id','=','users.designation')
        ->select('users.*','designations.name as designation_name')
        ->first();

        $currentLogo = $users->company_name->logo;
        $designation_name = $users->designation_name;
        Session::put('company_logo', $currentLogo);
        Session::put('designation_name', $designation_name);
        /*query used for show logo and designations in dropdown menu, end here*/
        
        /*these all quries used for show data in dashboard, start here*/
        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_id=0;
        if($request->company_id_filter){
            $company_id = $request->company_id_filter;
        }

        $user_genders_query = User::where('employee_type','Probation');
        if($company_id!=0){
            $user_genders_query->where('company_id', '=', $company_id);
        }
        $user_genders = $user_genders_query->get();



        $user_appraisal_cycle_query = User::where('employee_type','Probation')
                                ->where('appraisal_cycle','!=','');
        if($company_id!=0){
            $user_appraisal_cycle_query->where('company_id', '=', $company_id);
        }
        $user_appraisal_cycle = $user_appraisal_cycle_query->get();



        $all_users_query = User::where('status','1')->where('is_deleted','0');
        if($company_id!=0){
            $all_users_query->where('company_id', '=', $company_id);
        }
        $all_users = $all_users_query->get();
        

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        /*these all quries used for show data in dashboard, end here*/

        return view('home', compact('users','company_locations','user_genders','user_appraisal_cycle','all_users','department_names','company_names'));
    }

}
