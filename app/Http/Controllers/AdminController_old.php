<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Exports\MentorExport;
use App\Exports\ModeratorExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Imports\MentorImport;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video_url;
use App\Models\Advertisment;
use App\Models\DatabaseStorageModel;
use App\Models\District;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\QuestionAnswer;
use App\Models\Standard;    
use App\Models\LogActivity;
use App\Models\LogActivityType;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use DB;
use Hash;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;
use Illuminate\Support\Str;
use Excel;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Language;
use App\Models\Topic;
use App\Models\Category;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use Mail;


class AdminController extends Controller
{
    public function adminDashboard()
    {
        $student_count = User::where('user_type','4')->count();
        $moderator_count = User:: where('user_type','2')
        ->where('status', '1')
        ->count();
        $mentor_count = User:: where('user_type','3')
        ->count();
        $post_pending_count = Post::where('status','0')->count();
        $qa_pending_count = QuestionAnswer::where('question_status','0')->count();
        $post_pending_comment_count = PostComment::where('status','0')->count();
        $post_pending_approval = Post::where('status','0')->count();
        $advertisment = Advertisment::all()->count();
      
        return view('pages.Admin.dashboard',compact('mentor_count','student_count','moderator_count','post_pending_count','qa_pending_count','post_pending_comment_count','post_pending_approval','advertisment'));
    }

    public function adminDashboard1($id)
    {
        $data2 = User::find($id);
        return view('pages.Admin.dashboard', ['data2' => $data2]);
 
    }
        public function deletePost(Request $request)
    {
        Post::where('id',$request->post_id)->delete();
        return "success";
    }

    public function deleteQuestion(Request $request)
    {
        QuestionAnswer::where('id',$request->id)->delete();
        return "success";
    }

    public function search(Request $request){
        // where('user_type', '3')
        $term=$request->term && "";
        // DB::enableQueryLog();
        $data = User::where('user_type', '3')
            ->where(function($query) use ($term){
                 $query->where('first_name','LIKE','%'.$term.'%');
                 $query->orWhere('last_name','LIKE','%'.$term.'%');
             })
            // ->where('first_name','LIKE','%'.$term.'%')
            //  ->orWhere('last_name','LIKE','%'.$term.'%')
            // ->where('status', '1')
            ->get();
        // dd(DB::getQueryLog());
        return view('pages.search_result', compact('data'));
    }

    public function deleteComment(Request $request)
    {
        PostComment::where('id',$request->id)->delete();
        return "success";
    }

    public function StudentData(Request $request)
    {
        $studentList = User::with('cityModel')->where('user_type','4');
        
        $state = $request->state;
        if($state){
            $studentList->where("state",$state);
        }

        $district = $request->district;
        if($district){
            $studentList->where("district",$district);
        }

        $city = $request->city;
        if($city){
            $studentList->where("city",$city);
        }

        $standard = $request->standard;
        if($standard){
            $studentList->where('standard', "like", "%" . $standard . "%");
        }

        $age = $request->age;
        if($age){
            $studentList->where('age', "like", "%" . $age . "%");
        }

        $email = $request->email;
        if($email){
            $studentList->where('email', "like", "%" . $email . "%");
        }

        $status = $request->status;        
        if(!is_null($status)){
            $studentList->where('status', "$status");
        }

        $paid_user = $request->paid_user;
        if(!is_null($paid_user)){
            $studentList->where('paid_user', "$paid_user");
        }

        $name = $request->name;
        if ($name) {
            $studentList = $studentList->get();
            $studentList = $studentList->filter(function ($obj) use ($name) {
                $myString = $obj->first_name . " " . $obj->last_name;
                return  Str::contains(strtolower($myString), strtolower($name));
            });
        }

        return Datatables::of($studentList)
            ->addColumn('action', function ($row) {
                $action = '';
                
                    $action.='<a href="' . url('admin/view-student/') . '/'.$row->id . '"" class="btn btn-secondary">View</a>
                        <a href="' . url('admin/edit-student/') . '/'.$row->id . '" 
                                            class="btn btn-secondary btn-circle" data-toggle="tooltip" title="'.trans("app.edit").' '.trans('app.product').'"
                                        >Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-secondary delete_product" data-toggle="tooltip"  title="'.trans("app.delete").' '.trans('app.product').'" 
                                        id="'.$row->id.'">Delete</a>';
                
                return $action;
            })
            ->editColumn('first_name', function ($row) {
                $name = ucfirst($row->first_name);
                return $name;
            })
            ->editColumn('standard', function ($row) { 
                $standard = ucfirst($row->standard);
                return $standard;
            })
            ->editColumn('age', function ($row)
            {
                $age= $row->age; 
                return $age; 
            })
            ->editColumn('email', function ($row)
            {
                $email= $row->email; 
                return $email; 
            })
            ->editColumn('city', function ($row)
            {
                return "Pune";
                // $city_model= $row->cityModel->city_name; 
                // return $city_model; 
            })
            ->editColumn('age', function ($row)
            {
                $age= $row->age; 
                return $age; 
            })
            ->editColumn('status', function ($row)
            {
                if($row->status == '1')
                {
                    return "Active"; 
                }
                if($row->status == '4'){
                    return "Deactive"; 
                }
                
            })
            ->editColumn('paid_user', function ($row)
            {
                if($row->paid_user == '1')
                {
                    return "Yes"; 
                }else{
                    return "No";
                }
            })
            ->editColumn('view_status', function ($row)
            {
                if($row->view_status == '0')
                {
                    return "view only"; 
                }else{
                    return "Interactive";
                }
            })
            ->addIndexColumn()
           
            ->rawColumns(['action', 'name'])
            ->make(true);
    }

    public function registerUser(Request $request)
    {

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->status = '0';
        $user->save();

        FacadesSession::put('message', 'Registartion Successful.');

        return redirect('login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            }
             else if (Auth::user()->user_type == 1) {
                return redirect('super-admin/companies');
            }
        }
        else {
            Session::put('message', 'Inavlid login credentials.');
            return redirect('/login');
        }
        return view('pages.login');
    }

    public function sign_in_form()
    {
        return view('registration.signin');
    }
    public function logout()
    {
      

       $email= Auth::user();

    
        Auth::logout();   
              
        return redirect('login');
    }

    public function forgot_passsword_form()
    {
        return view('registration.forgot_password');
    }

    public function store_user(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'    => 'required',
            'user_name'    => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->first_name = $request->Input('first_name');
        $user->last_name = $request->Input('last_name');
        $user->user_name = $request->Input('user_name');
        $user->email = $request->Input('email');
        $user->password = bcrypt($request->Input('password'));
        if ($user->save()) {
            $data = $html = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $request->Input('email')
            ];

            $view = view('email.welcome', compact('data', 'html'))->render();
            
            Session::flash('success', "User Created Successfully.");
            return back();
        } else {
            Session::flash('error', "Something went wrong while updating user.");
            return back();
        }
    }

    public function edit_profile($user_id)
    {
        $user_id = base64_decode($user_id);
        $user = User::find($user_id);

        return view('user.edit_profile', compact('user'));
    }

    public function profile()
    {
        $auth_id = Auth::id();
        $user = User::where('id', $auth_id)->first();
        $states = State::where('country_id', 101)->get();

        return view('pages.Admin.user.profile', compact('user','states'));
    }

    public function adminprofile()
    {
        $auth_id = Auth::id();
        $user = User::where('id', $auth_id)->first();
        $states = State::where('country_id', 101)->get();
        $cities = City::all();

        return view('pages.Admin.profile', compact('user','states','cities'));
    }

    public function updateAdminProfile(Request $request)
    {
        Auth::user()->first_name = $request->first_name;
        Auth::user()->last_name = $request->last_name;
        Auth::user()->email = $request->email;
        Auth::user()->DOB = $request->DOB;
        Auth::user()->address = $request->address;
        Auth::user()->city = $request->city_id;
        Auth::user()->state = $request->state_id;
        Auth::user()->pincode = $request->pincode;

        if ($request->has('password') && $request->password != "") {
            Auth::user()->password = bcrypt($request->password);
        }
        //public/storage/images
        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // print_r($);die;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            Auth::user()->profile_picture = $fileNameToStore;
        }
        Auth::user()->save();

        Session::put('message', 'Profile updated successfully!');
        return redirect(url('admin/profile'));
    }

    public function addStudentForm()
    {
        $states = State::where('country_id', 101)->get();
        $standards = Standard::all();

        return view('pages.Admin.add-student', compact('states','standards'));
    }

    public function addStudent(Request $request)
    {
        // $adminMaapepicUrl = 'http://adminmaapepic.loc/dashboard/Api/check_username_already_exist_in_adminmaapepic';
        $adminMaapepicUrl = 'https://adminv2.maapepic.progfeel.co.in/dashboard/Api/check_username_already_exist_in_adminmaapepic';

        $ciResponse = Http::asForm()->post($adminMaapepicUrl, [
            'user_name'     => $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no,
        ]);

        if($ciResponse['status'] == 'success')
        {
            $user = User::where('user_name', $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no)->first();
     
            if(!empty($user))
            {
                Session::flash('error', "Username already exist in Ganitalay");
                return back();
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no;
            $user->school_no = $request->school_no;
            $user->email = $request->email;
            $user->DOB = $request->DOB;
            $user->address = $request->address;
            $user->city = $request->taluka_name;
            $user->state = $request->state_id;
            $user->district = $request->district_id;
            $user->pincode = $request->pincode;
            $user->age = $request->age;
            $user->standard = $request->standard;
            $user->reference = $request->reference;
            $user->mobile_no = $request->mobile_no;
            $user->user_type = 4;
            $user->status = '1';
            // $user->view_status = '0';
            $user->view_status = $request->view_status;
    
            $user->password = bcrypt($request->password);
    
            if ($request->has('profile_picture')) {
                $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
                $path = $request->file('profile_picture')->storeAs('images/', $fileNameToStore);
                $user->profile_picture = $fileNameToStore;
            }
            
            $user->save();
            $details['user_type'] = "4";
            $details['email'] = $request->email;
            $details['password'] = $request->password;
            $details['user_name'] = $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no;
            $details['full_name'] = $request->first_name." ".$request->last_name;
            $details['subject'] = "Ganitalay- Login Details";
            $details['from'] = "info@ganitalay.in";
            dispatch(new \App\Jobs\SendEmailJob($details));
    
            /**
            * Called adminmaapepic api to register student
            * Added by ganesh
            * Added on 2025-07-24
            */
    
            if($request->reference == "2")
            {
                //$adminMaapepicUrl1 = 'http://adminmaapepic.loc/dashboard/Api/add_external_student';
                $adminMaapepicUrl1 = 'https://adminv2.maapepic.progfeel.co.in/dashboard/Api/add_external_student';

                $ciResponse = Http::asForm()->post($adminMaapepicUrl1, [
                    'first_name'    => $request->first_name,
                    'middle_name'   => $request->middle_name,
                    'last_name'     => $request->last_name,
                    'user_name'     => $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no,
                    'school_no'     => $request->school_no,
                    'email'         => $request->email,
                    'DOB'           => $request->DOB,
                    'address'       => $request->address,
                    'city'          => $request->taluka_name,
                    'state'         => $request->state_id,
                    'district'      => $request->district_id,
                    'pincode'       => $request->pincode,
                    'age'           => $request->age,
                    'standard'      => $request->standard,
                    'reference'     => $request->reference,
                    'mobile_no'     => $request->mobile_no,
                    'user_type'     => 4,
                    'status'        => '1',
                    'view_status'   => $request->view_status,
                    'profile_picture' => $user->profile_picture ?? null,
                    'password' => $request->password
                ]);
            }
            
            /** End */
            Session::put('message', 'Student added successfully!');
            return redirect(url('admin/students'));
        }
        else
        {
            Session::flash('error', "Username already exist in Ankanaad");
            return back();
        }
    }

    public function addMentorForm(Request $request)
    {
        //  Log::channel('itsolution')->info('This is testing for ItSolutionStuff.com!');
        $states = State::where('country_id', 101)->get();
        // $standards = Standard::all();

        return view('pages.Admin.add-mentor', compact('states'));
    }
    public function addMentor(Request $request)
    {
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->taluka_name;
        $user->state = $request->state_id;
        $user->district = $request->district_id;
        $user->pincode = $request->pincode;
        $user->mentor_type = $request->mentor_type;
        $user->short_bio = $request->short_bio;
        $user->current_work_profile = $request->current_work_profile;
        $user->other_details = $request->other_details;
        $user->mobile_no = $request->mobile_no;
        $user->user_type = '3';
        $user->status = '1';
        $user->view_status = '0';
       
        $user->password = bcrypt($request->password);

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();
               $details['user_type'] = "3";
               $details['email'] = $request->email;
               $details['password'] = $request->password;
               $details['full_name'] = $request->first_name." ".$request->last_name;
               $details['subject'] = "Ganitalay- Login Details";
               $details['from'] = "info@ganitalay.in";
               dispatch(new \App\Jobs\SendEmailJob($details));
        Session::put('message', 'Mentor added successfully!');
        return redirect(url('admin/mentors'));
    }



    public function addAdvertisment (Request $request)
    {

        $user = new Advertisment();
        $user->status = $request->status;

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        if ($request->has('profile_picture1')) {
            $filenameWithExt = $request->file('profile_picture1')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture1')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture1')->storeAs('images', $fileNameToStore);
            $user->profile_picture1 = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Advertisment  added successfully!');
        return redirect(url('admin/advertisment'));
    }

    public function updateAdvertisment(Request $request, $id)
    {
  
        $user = Advertisment::find($id);
            $user->status = $request->status;

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                      // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        if ($request->has('profile_picture1')) {
            $filenameWithExt = $request->file('profile_picture1')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture1')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture1')->storeAs('images', $fileNameToStore);
            $user->profile_picture1 = $fileNameToStore;
        }

        $user->save();
        Session::put('message', 'Advertisment  added successfully!');
        return redirect(url('admin/advertisment'));
 
    }

    public function addModerator(Request $request)
    {

        $user = new User();

        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->view_status = '0';
        $user->moderator_type = $request->moderator_type;


        $user->user_type = '2';
        $user->status = '1';
        $user->password = bcrypt($request->password);

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Moderator added successfully!');
        return redirect(url('admin/moderators'));
    }


    public function updateMentor(Request $request, $id)
    {

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->state = $request->state_id;
        $user->district= $request->district_id;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->mobile_no = $request->mobile_no;
        $user->mentor_type = $request->mentor_type;
        $user->short_bio = $request->short_bio;
        $user->current_work_profile = $request->current_work_profile;
        $user->other_details = $request->other_details;
        $user->senior_mentor = $request->senior_mentor;

        if ($request->has('password') && $request->password != "") {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Mentor updated successfully!');
        return redirect(url('admin/mentors'));
    }

    public function updateModerator(Request $request, $id)
    {

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->moderator_type = $request->moderator_type;

        if ($request->has('password') && $request->password != "") {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Moderator updated successfully!');
        return redirect(url('admin/moderators'));
    }

    public function updateStudent(Request $request, $id)
    {
        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->school_no = $request->school_no;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->taluka_name;
        $user->state = $request->state_id;
        $user->district = $request->district_id;
        $user->pincode = $request->pincode;
        $user->age = $request->age;
        $user->standard = $request->standard;
        $user->reference = $request->reference;
        $user->mobile_no = $request->mobile_no;
        $user->view_status = $request->view_status;

        if ($request->has('password') && $request->password != "") {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('profile_picture')->storeAs('images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Student updated successfully!');
        return redirect(url('admin/students'));
    }


    public function studentList()
    {
        // $data = User::where('user_type', 4)->get();
        $state = State::all();
        return view('pages.Admin.student', ['states'=>$state]);
    }

    public function activity_logs(){
        $startDate = Carbon::today()->startOfMonth();
        $endDate = Carbon::today();
        $users = User::where('user_type', 4)->orWhere('user_type',3)->get();
        $state = State::all();
        $activity_types = LogActivityType::all();
        foreach($activity_types as $key => $value){
            $activity_types[$key]->created_at = date("Y-m-d H:i:s", strtotime($value->created_at.'+5 hours'));
            $activity_types[$key]->created_at = date("Y-m-d H:i:s", strtotime($value->created_at.'+30 minutes'));
        }
        return view('pages.Admin.activity_logs', ['users' => $users, 'activity_types'=>$activity_types,'startDate'=>$startDate,'endDate'=>$endDate,'states'=>$state]);
    }

    public function activity_logs_data(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_type = $request->user_type;
        $user_id = $request->user_id;
        $activity_type = $request->activity_type;
        $pin_code = $request->pin_code;
        $state_id = $request->state_id;

        // $logs = LogActivity::with(['user','activity_type_info'])->orderBy('log_activities.id','desc');
        $logs = LogActivity::with(['user','activity_type_info']);

        if (!empty($start_date)) {
            $logs = $logs->whereDate('log_activities.created_at', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $logs = $logs->whereDate('log_activities.created_at', '<=', $end_date);
        }

        if ($activity_type > 0) {
            $logs = $logs->where('activity_type', $activity_type);
        }

        if ($state_id > 0) {
            $logs = $logs->whereHas('user', function($query) use ($state_id){
                        $query->where('state', $state_id);
                  });
        } 

        if (!empty($pin_code)) {
            $logs = $logs->whereHas('user', function($query) use ($pin_code){
                        $query->where('pincode', 'LIKE', '%'.$pin_code.'%');
                  });
        }

        if ($user_id > 0) {
            $logs = $logs->where('user_id', $user_id);
            
        }

        if ($user_type > 0) {
             $logs = $logs->whereHas('user', function (Builder $query) use ($user_type) {
                $query->where('user_type', $user_type);
            });
        }


        // print_r($logs->toArray());exit();
        return Datatables::of($logs)
            ->addColumn('user_name', function ($row)
            {
                return $row->user->first_name.' '.$row->user->first_name;
            })
            ->addColumn('user_type', function ($row)
            {
                if($row->user->user_type==1){
                    return "Admin";
                }else if($row->user->user_type==2){
                    return "Admin";
                }else if($row->user->user_type==3){
                    return "Mentor";
                }else if($row->user->user_type==4){
                    return "Student";
                }
                return '';
            })->addColumn('activity_type_name', function ($row)
            {
                return $row->activity_type_info->type;
            })
            ->editColumn('created_at', function ($row)
            {
               
                $row->created_at = date("Y-m-d H:i:s", strtotime( $row->created_at.'+5 hours'));
                $row->created_at = date("Y-m-d H:i:s", strtotime( $row->created_at.'+30 minutes'));
                
                return date('d-m-Y h:i A',strtotime($row->created_at)); 
            })
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }

    public function sendEmailAndPasswordToStudent(){
        $users = User::where('email_send',0)->where('user_type',4)->get(['id','email','first_name','last_name']);
        // print_r($users);exit();
        if(count($users) > 0){
            foreach ($users as $key => $value) {
                $password = Str::random(10);
                User::where('id',$value->id)->update(['password'=>bcrypt($password),'email_send'=>1]);
                $details['email'] = $value->email;
                $details['password'] = $password;
                $details['full_name'] = $value->first_name." ".$value->last_name;
                $details['subject'] = "Ganitalay- Login Details";
                $details['from'] = "info@ganitalay.in";
                dispatch(new \App\Jobs\SendEmailJob($details));
            }
            echo "Email send to all students successfully.";
        }else{
            echo "No user pending for send email.";
        }

    }


    // public function importStudents(Request $request)
    // {
    //     $rows = (new StudentImport)->toCollection($request['student_file']);
    //     $newCounts = 0;
    //     $updateCount = 0;
    //     $rowsCount = 0;
    //     foreach ($rows[0] as $row) {
    //         $user_nam = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
    //         $rowsCount++;
    //         $obj = User::where('user_name', $user_nam)->first();
            
    //         if(!$obj) {
    //             //$password = Str::random(10);
    //             $password = "123456";
    //             $obj = new User();
    //             $obj->user_type = "4";
    //             $obj->email = trim($row['email']);
    //             $obj->user_name = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
    //             $obj->status = '1';
    //             $obj->password = bcrypt($password);
    //             $newCounts++;
    //             // send email
    //             $details['user_type'] = "4";
    //             $details['email'] = trim($row['email']);
    //             $details['user_name'] = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
    //             $details['password'] = $password;
    //             $details['full_name'] = $row['first_name']." ".$row['last_name'];
    //             $details['subject'] = "Ganitalay- Login Details";
    //             $details['from'] = "ganitalay@maapepic.com";
    //             dispatch(new \App\Jobs\SendEmailJob($details));
    //         } else {
    //             $updateCount++;
    //         }
            
    //         $obj->first_name = $row['first_name'];
    //         $obj->middle_name = $row['middle_name'];
    //         $obj->last_name = $row['last_name'];
    //         $obj->school_no = $row['school_no'];
    //         $obj->user_name = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
    //         $obj->DOB = $row['dob'];
    //         $dateTimeObject = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']);
    //         $obj->DOB = $dateTimeObject;
    //         $obj->standard = $row['standard'];
    //         $obj->age = $row['age'];
    //         $obj->address = $row['address'];
    //         if(isset($row['paid_user']) && $row['paid_user'] == 'yes') {
    //             $obj->paid_user = 1;
    //         } else {
    //             $obj->paid_user = 0;
    //         }

    //         if(isset($row['state'])){
    //             $state = State::where('state_name', $row['state'])->first();
    //             if(!empty($state)){
    //                     $obj->state = $state->state_id;
    //             }
    //         }

    //         if(isset($row['city'])){
    //             $city = City::where('city_name', $row['city'])->first();
    //             if(!empty($city)){
    //                     $obj->city = $city->city_id;
    //             }
    //         }
    //         if(isset($row['district'])){
    //             $district = District::where('name', $row['district'])->first();
    //             if(!empty($district)) {
    //                 $obj->district = $district->id;
    //             }
    //         }
            
    //         $obj->pincode = $row['pincode'];
    //         $obj->save();
    //     }

    //     // $response =  array(
    //     //      'status' => 'success',
    //     //      'message' => 'Student imported successfully',
    //     //      'total' => $rowsCount,
    //     //      'new'   => $newCounts,
    //     //      'updated'   => $updateCount,
    //     // );
    //     // Session::put("import_response", $response);

    //     /**
    //     * Add students into the Ankanaad also 
    //     */

    //     // if ($request->hasFile('student_file')) {
    //     //     $file = $request->file('student_file');
    
    //     //     $response = Http::attach(
    //     //         'student_file',
    //     //         file_get_contents($file->getRealPath()),
    //     //         $file->getClientOriginalName()
    //     //     )->asMultipart()->post('http://adminmaapepic.loc/dashboard/Api/import_external_students', [
    //     //         ['name' => 'source', 'contents' => 'laravel'],
    //     //         ['name' => 'test', 'contents' => 'true'],
    //     //     ]);
    //     // } else {
    //     //     return response()->json(['error' => 'No file uploaded'], 400);
    //     // }

        
    //     Session::put('message', 'Student imported successfully!');
    //     return redirect()->back()->with('success');
    //     // return redirect(url("/admin/students"))->with('success');
    // }

    public function importStudents(Request $request)
    {
        $rows = (new StudentImport)->toCollection($request['student_file']);
        $newCounts = 0;
        $updateCount = 0;
        $rowsCount = 0;
        $usernameAlreadyExistInAdminMaapepicCount = 0;
        $studentsCreatedInAdminMaapepicCount = 0;
        foreach ($rows[0] as $row) {
            $user_nam = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
            $rowsCount++;
            $obj = User::where('user_name', $user_nam)->first();
            
            if(!$obj) 
            {
                //$adminMaapepicUrl = 'http://adminmaapepic.loc/dashboard/Api/check_username_already_exist_in_adminmaapepic';
                $adminMaapepicUrl = 'https://adminv2.maapepic.progfeel.co.in/dashboard/Api/check_username_already_exist_in_adminmaapepic';

                $ciResponse = Http::asForm()->post($adminMaapepicUrl, [
                    'user_name'     => $request->first_name.''.substr($request->middle_name,0,1).''.substr($request->last_name,0,1).''.$request->school_no,
                ]);

                if($ciResponse['status'] == 'error')
                {
                   $usernameAlreadyExistInAdminMaapepicCount++;
                   continue;
                }    

                //$password = Str::random(10);
                $password = "123456";
                $obj = new User();
                $obj->user_type = "4";
                $obj->email = trim($row['email']);
                $obj->user_name = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
                $obj->status = '1';
                $obj->password = bcrypt($password);
                $newCounts++;
                // send email
                $details['user_type'] = "4";
                $details['email'] = trim($row['email']);
                $details['user_name'] = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
                $details['password'] = $password;
                $details['full_name'] = $row['first_name']." ".$row['last_name'];
                $details['subject'] = "Ganitalay- Login Details";
                $details['from'] = "ganitalay@maapepic.com";
                dispatch(new \App\Jobs\SendEmailJob($details));


                /** Create student into the AdminMaapepic */

                $stateId = '';
                $cityId = '';
                $districtId = '';
                 
                if(isset($row['state'])){
                    $state = State::where('state_name', $row['state'])->first();
                    if(!empty($state)){
                            $stateId = $state->state_id;
                    }
                }
    
                if(isset($row['city'])){
                    $city = City::where('city_name', $row['city'])->first();
                    if(!empty($city)){
                            $cityId = $city->city_id;
                    }
                }
                if(isset($row['district'])){
                    $district = District::where('name', $row['district'])->first();
                    if(!empty($district)) {
                        $districtId = $district->id;
                    }
                }

                //$adminMaapepicUrl1 = 'http://adminmaapepic.loc/dashboard/Api/add_external_student';
                 $adminMaapepicUrl1 = 'https://adminv2.maapepic.progfeel.co.in/dashboard/Api/add_external_student';

                $ciResponse = Http::asForm()->post($adminMaapepicUrl1, [
                    'first_name'    => $row['first_name'],
                    'middle_name'   => $row['middle_name'],
                    'last_name'     => $row['last_name'],
                    'user_name'     => $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'],
                    'school_no'     => $row['school_no'],
                    'email'         => trim($row['email']),
                    'DOB'           => $row['dob'],
                    'address'       => $row['address'],
                    'city'          => $cityId,
                    'state'         => $stateId,
                    'district'      => $districtId,
                    'pincode'       => $row['pincode'],
                    'age'           => $row['age'],
                    'standard'      => $row['standard'],
                    'reference'     => '',
                    'mobile_no'     => '',
                    'user_type'     => 4,
                    'status'        => '1',
                    'view_status'   => '',
                    'profile_picture' => '',
                    'password' => 123456
                ]);

                if($ciResponse['status'] == 'success')
                {
                    $studentsCreatedInAdminMaapepicCount++;
                }
            } else {
                $updateCount++;
            }
            
            $obj->first_name = $row['first_name'];
            $obj->middle_name = $row['middle_name'];
            $obj->last_name = $row['last_name'];
            $obj->school_no = $row['school_no'];
            $obj->user_name = $row['first_name'].''.substr($row['middle_name'],0,1).''.substr($row['last_name'],0,1).''.$row['school_no'];
            $obj->DOB = $row['dob'];
            $dateTimeObject = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']);
            $obj->DOB = $dateTimeObject;
            $obj->standard = $row['standard'];
            $obj->age = $row['age'];
            $obj->address = $row['address'];
            if(isset($row['paid_user']) && $row['paid_user'] == 'yes') {
                $obj->paid_user = 1;
            } else {
                $obj->paid_user = 0;
            }
            if(isset($row['state'])){
                $state = State::where('state_name', $row['state'])->first();
                if(!empty($state)){
                        $obj->state = $state->state_id;
                }
            }

            if(isset($row['city'])){
                $city = City::where('city_name', $row['city'])->first();
                if(!empty($city)){
                        $obj->city = $city->city_id;
                }
            }
            if(isset($row['district'])){
                $district = District::where('name', $row['district'])->first();
                if(!empty($district)) {
                    $obj->district = $district->id;
                }
            }
            
            $obj->pincode = $row['pincode'];
            $obj->save();
        }

        $response =  array(
             'status' => 'success',
             'message' => 'Student imported successfully',
             'total' => $rowsCount,
             'new'   => $newCounts,
             'updated'   => $updateCount,
             'usernameAlreadyExistInAdminMaapepicCount'   => $usernameAlreadyExistInAdminMaapepicCount,
             'studentsCreatedInAdminMaapepicCount'   => $studentsCreatedInAdminMaapepicCount,
        );
        Session::put("import_response", $response);

        /**
        * Add students into the Ankanaad also 
        */

        // if ($request->hasFile('student_file')) {
        //     $file = $request->file('student_file');
    
        //     $response = Http::attach(
        //         'student_file',
        //         file_get_contents($file->getRealPath()),
        //         $file->getClientOriginalName()
        //     )->asMultipart()->post('http://adminmaapepic.loc/dashboard/Api/import_external_students', [
        //         ['name' => 'source', 'contents' => 'laravel'],
        //         ['name' => 'test', 'contents' => 'true'],
        //     ]);
        // } else {
        //     return response()->json(['error' => 'No file uploaded'], 400);
        // }

        return $response;
        
        Session::put('message', 'Student imported successfully!');
        return redirect()->back()->with('success');
        // return redirect(url("/admin/students"))->with('success');
    }

    public function importMentor(Request $request)
    {
    
        $rows = (new MentorImport)->toCollection($request['mentor_file']);
    
        $newCounts = 0;
        $updateCount = 0;
        $rowsCount = 0;
      
        foreach ($rows[0] as $row) {
            
            $rowsCount++;
             $obj = User::where('email', $row['email'])->first();

             if(!$obj)
             {
              $password = Str::random(10);
               $obj = new User();
               
               $obj->user_type = "3";
               $obj->email = $row['email'];
               $obj->status = '1';
               $obj->password = bcrypt($password);
               $newCounts++;
               //send email
            //    $details1['user_type'] = "3";
            //    $details1['email'] = $row['email'];
            //    $details1['password'] = $password;
            //    $details1['full_name'] = $row['first_name']." ".$row['last_name'];
            //    $details1['subject'] = "Ganitalay- Login Details";
            //    $details1['from'] = "info@ganitalay.in";
            //    dispatch(new \App\Jobs\SendEmailJob1($details1));
             }
             else
             {
                $updateCount++;
             }
                $obj->first_name = $row['first_name'];
                // $obj->middle_name = $row['middle_name'];
                $obj->last_name = $row['last_name'];
                // $obj->school_no = $row['school_no'];
                $obj->DOB = $row['dob'];
                $obj->standard = $row['standard'];
                $obj->age = $row['age'];
                $obj->address = $row['address'];
                $obj->view_status = 0 ;
                // if($row['mentor_type'] == 'local')
                if(isset($row['mentor_type']) && $row['mentor_type'] == 'local')
                {
                    $obj->mentor_type = 1;
            
                }
                if(isset($row['mentor_type']) && $row['mentor_type'] == 'academician')
                {
                    $obj->mentor_type = 2;
            
                }
                if(isset($row['mentor_type']) && $row['mentor_type'] == 'national/international')
                {
                    $obj->mentor_type = 3;
            
                }
                if(isset($row['mentor_type']) && $row['mentor_type'] == 'exclusive')
                {
                    $obj->mentor_type = 4;
            
                }
            
                else 
                {
                    $obj->mentor_type = 0;
                }
                
                // $obj->senior_mentor= $row['senior_mentor'];
                
                if(isset($row['senior_mentor']) && $row['senior_mentor'] == 'yes')
                {
                    $obj->senior_mentor = 1;
            
                }
                else 
                {
                    $obj->senior_mentor = 0;
                }
                
                if(isset($row['state'])){
                $state = State::where('state_name', $row['state'])->first();
                if(!empty($state)){
                     $obj->state = $state->state_id;
                }
                }

                if(isset($row['city'])){
                    $city = City::where('city_name', $row['city'])->first();
                    if(!empty($city)){
                         $obj->city = $city->city_id;
                    }
                }
                if(isset($row['district'])){
                    $district = District::where('name', $row['district'])->first();
                if(!empty($district)){
                     $obj->district = $district->id;
                }
                }
                
               
                $obj->pincode = $row['pincode'];
               
                $obj->save();

                // echo"<pre>";
                // Print_r($obj);die();

        }

        // $response =  array(
        //      'status'  => 'success',
        //      'message' => 'Mentor imported successfully',
        //      'total'   => $rowsCount,
        //      'new'     => $newCounts,
        //      'updated' => $updateCount,
        // );
       
        // Session::put("import_response", $response);
        // return redirect(url("/admin/mentors"));

        Session::put('message', 'Mentor imported successfully!');
        return redirect()->back()->with('success');
   
    }

    public function exportStudents()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }
    
    public function exportMentors()
    {
        return Excel::download(new MentorExport, 'mentors.xlsx');
    }

    public function exportModerators()
    {
        return Excel::download(new ModeratorExport, 'moderators.xlsx');
    }

    public function ajaxGetCity(Request $request){
        $cities = City::where('district_id', $request->district_id)->get();

        return view('pages.Admin.ajax-cities', ['cities' => $cities]);
    }

    public function ajaxGetDistrict(Request $request){
        $districts = District::where('state_id', $request->state_id)->get();
        return view('pages.Admin.ajax-districts', ['districts' => $districts]);
    }

    public function ajaxAddStudentGetCity(Request $request){
        $cities = City::where('district_id', $request->district_id)->get();
        return $cities;
    }

    public function ajaxAddStudentGetDistrict(Request $request){
        $districts = District::where('state_id', $request->state_id)->get();
        return view('pages.Admin.ajax-add-student-districts', ['districts' => $districts]);
    }

    public function mentorList()
    {
        $data = User::where('user_type', 3)->get();
        return view('pages.Admin.mentor', ['data' => $data]);
    }

    public function ajaxMentorData(Request $request)
    {
        $query = User::query();
        $data = User::where('user_type', 3)->get();

        if ($request->email) {
            $query->where('email', "like", "%" . $request->email . "%");
        }

        if (!is_null($request->status)) {
            $query->where('status', "" . $request->status);
        }

        if (!is_null($request->senior_status)) {
            $query->where('senior_mentor',$request->senior_status);
        }
        $data = $query->where('user_type', '3')->get();


        if ($request->name) {
            $name = $request->name;
            $data = $data->filter(function ($obj) use ($name) {
                $myString = $obj->first_name . " " . $obj->last_name;
                return  Str::contains(strtolower($myString), strtolower($name));
            });
        }

        return view('pages.Admin.ajax-mentors', ['data' => $data]);
    }

    public function ajaxModeratorData(Request $request)
    {

        $query = User::query();

        if ($request->email) {
            $query->where('email', "like", "%" . $request->email . "%");
        }

        if (!is_null($request->status)) {
            $query->where('status', "" . $request->status);
        }
        $data = $query->where('user_type', '2')->get();


        if ($request->name) {
            $name = $request->name;
            $data = $data->filter(function ($obj) use ($name) {
                $myString = $obj->first_name . " " . $obj->last_name;
                return  Str::contains(strtolower($myString), strtolower($name));
            });
        }

        return view('pages.Admin.ajax-moderator', ['data' => $data]);
    }

    // edit post function
    public function edit_comment(Request $request,$id)
    {
        // $data = Post::with('mentor')->first();
        $data = Post::find($id);
        $languages = Language::all();
        $standards = Standard::all();
        $topics = Topic::all();
        $categories = Category::all();
        return view('pages.Admin.edit-comment', compact('data', 'languages',
        'standards',
        'topics',
        'categories'));
    }
    public function update_comment(Request $request,$id)
    {
        $post = Post::find($id);
        
        $post->description = $request->Input('comment');
        if($post->content_type == 'post'){
            $post->language_id = $request->language_id;
            $post->topic_id = $request->topic_id;
            $post->standard_id = $request->standard_id;
            $post->category_id = $request->category_id;
            $post->video = $request->post_video."?rel=0";
            
            if ($request->has('post_file')) {
                $filenameWithExt = $request->file('post_file')->getClientOriginalName();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('post_file')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('post_file')->storeAs('images', $fileNameToStore);
                $post->photo = $fileNameToStore;
            }
        }
        
        if ($post->save()) {
            Session::put('message', "Comment updated Successfully.");
            return redirect('admin/content-approval');
        } else {
            Session::flash('error', "Something went wrong while updating profile.");
            return back();
        }
    }

    public function ajaxStudentData(Request $request)
    {

        $query = User::query();
        if ($request->age) {
            $query->where('age', "like", "%" . $request->age . "%");
        }
        if ($request->standard) {
            $query->where('standard', "like", "%" . $request->standard . "%");
        }
        if ($request->email) {
            $query->where('email', "like", "%" . $request->email . "%");
        }
        if ($request->state_id) {
            $query->where('state', "like", "%" . $request->state_id . "%");
        }
        if ($request->city_id) {
            $query->where('city', "like", "%" . $request->city_id . "%");
        }
        if ($request->district_id) {
            $query->where('district', "like", "%" . $request->district_id . "%");
        }

        if (!is_null($request->status)) {
            $query->where('status', "" . $request->status);
        }

        if (!is_null($request->paid_status)) {
            $query->where('paid_user',$request->paid_status);
        }

        $data = $query->where('user_type', '4')->get();


        if ($request->name) {
            $name = $request->name;
            $data = $data->filter(function ($obj) use ($name) {
                $myString = $obj->first_name . " " . $obj->last_name;
                return  Str::contains(strtolower($myString), strtolower($name));
            });
        }

        return view('pages.Admin.ajax-student', ['data' => $data]);
    }

    public function moderatorList()
    {
        $data = User::where('user_type', 2)->get();
        return view('pages.Admin.moderator', ['data' => $data]);
    }

    public function advertisment()
    {
        $data = Advertisment::all();
        return view('pages.Admin.advertisment', ['data' => $data]);
    }
  
    
    public function contentApprovalList($content_type = null, $status = null)
    {
        $mentors = User::where('user_type', 3)
            ->where('status', '1')
            ->get();

        $moderator = User::whereIn('user_type', [1, 2])
            ->where('status', '1')
            ->get();

        $query = Post::query();
        $data = $query->with('mentor')
            ->with('moderator')
            ->with('commentedBy')
            ->orderBy('id', 'DESC')
            ->get();

            $filterFlag = is_null($status)? false:true;

        return view('pages.Admin.content-approval2', ['filterFlag'=> $filterFlag, 'content_type'=>$content_type, 'status'=>$status,'data' => $data, 'mentors' => $mentors, 'moderators' => $moderator]);
    }

    public function MentorList2($content_type = null, $status = null)
    {
        $mentors = User::where('user_type', 3)
            ->where('status', '1')
            ->get();

        $moderator = User::whereIn('user_type', [1, 2])
            ->where('status', '1')
            ->get();

        $query = Post::query();
        $data = $query->with('mentor')
            ->with('moderator')
            ->with('commentedBy')
            ->orderBy('id', 'DESC')
            ->get();

            $filterFlag = is_null($status)? false:true;

        return view('pages.Admin.content-approval3', ['filterFlag'=> $filterFlag, 'content_type'=>$content_type, 'status'=>$status,'data' => $data, 'mentors' => $mentors, 'moderators' => $moderator]);
    }
    public function ajaxContentData(Request $request)
    {
        $content_type = $request['content_type'];


        switch($request['content_type'])
        {
            case "Post":
                $data = $this->getPosts($request);
                break;
                case "Q&A":
                $data = $this->getQnA($request);
                break;
                case "Comment":
                $data = $this->getComments($request);
                break;
        }

        return view('pages.Admin.ajax-content', ['data' => $data, 'content_type' => $content_type]);
    }

    public function ajaxContentData1(Request $request)
    {
        $content_type = $request['content_type'];


        switch($request['content_type'])
        {
            case "Post":
                $data = $this->getPosts($request);
                break;
                case "Q&A":
                $data = $this->getQnA($request);
                break;
                case "Comment":
                $data = $this->getComments($request);
                break;
        }

        return view('pages.Admin.ajax-content2', ['data' => $data, 'content_type' => $content_type]);
    }
    public function getQnA($request){
        $query = QuestionAnswer::query();
        if ($request->moderator_id) {
            $query->where('approved_by', $request->moderator_id);
        }

        if ($request->mentor_id) {
            $query->where('mentor_id', $request->mentor_id);
        }
        if (!is_null($request->status)) {
            $query->where('status', $request->status);
        }

        // print_r("echo"); die;    

       $data = $query->where('question_status', '0')
            ->with('mentor')
            ->with('moderator')
            ->orderBy('id', 'DESC')
            ->get();

            // echo 
            // print_r ($data);die();
            
            // $data = $query->select(['mentor','moderator'])->where('question_status', '1')->get();
            return $data;
    }

    public function getPosts($request){
        $query = Post::query();
        if ($request->moderator_id) {

            $query->where('approved_by', $request->moderator_id);
        }

        if ($request->mentor_id) {
            $query->where('mentor_id', $request->mentor_id);
        }

        if (!is_null($request->status)) {
            $query->where('status', $request->status);
        }

        $data = $query->with('mentor')
            ->with('moderator')
            ->with('commentedBy')
            ->orderBy('id', 'DESC')
            ->get();
            return $data;
    }

    public function getComments($request){

        $query = PostComment::query();

        if ($request->moderator_id) {
            $query->where('approved_by', $request->moderator_id);
        }

        if ($request->mentor_id) {
            $query->where('commented_by', $request->mentor_id);
        }

        if (!is_null($request->status)) {
            $query->where('status', $request->status);
        }

        $data = $query->with('mentor')
            ->with('moderator')
            ->with('user')
            ->orderBy('id', 'DESC')
            ->get();
            return $data;
    }

    public function contentApprovalDetail(Request $request, $id)
    {
        $data = Post::find($id);
        return view('pages.Admin.content-detail', ['data' => $data]);
    }

    public function contentApprovalQuestionDetail(Request $request, $id)
    {
        $data = QuestionAnswer::find($id);
        return view('pages.Admin.content-detail-question', ['data' => $data]);
    }

    public function contentApprove(Request $request)
    {
        $data = Post::find($request->post_id);
        $data->status = "1";
        $data->approved_by = Auth()->user()->id;
        $data->save();
        return "success";
    }

    public function contentApprovePost($id)
    {
        $data = Post::find($id);
        $data->status = "1";
        $data->approved_by = Auth()->user()->id;
        $data->save();
        Session::put('message', 'Post approved successfully!');
        return redirect(URL::previous());
    }

    public function contentDisapprovePost($id)
    {
        $data = Post::find($id);
        $data->status = "2";
        $data->approved_by = Auth()->user()->id;
        $data->save();
        Session::put('message', 'Post disapproved successfully!');
        return redirect(URL::previous());
    }

    public function contentApproveQuestion(Request $request)
    {
        $data = QuestionAnswer::find($request->question_id);
        $data->status = "1";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        return "success";
    }

    public function contentApproveComment(Request $request)
    {
        $data = PostComment::find($request->comment_id);
        $data->status = "1";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        return "success";
    }

    public function contentDisapproveComment(Request $request)
    {
        $data = PostComment::find($request->comment_id);
        $data->status = "2";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        return "success";
    }
    public function contentDisapprove(Request $request)
    {
        $data = Post::find($request->post_id);
        $data->status = "2";
        $data->approved_by = Auth()->user()->id;
        $data->save();
        return "success";
    }

    public function contentDisapproveQuestion(Request $request)
    {
        $data = QuestionAnswer::find($request->question_id);
        $data->status = "2";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        return "success";
    }
    public function contentDisapproveQuestion2($id)
    {
        $data = QuestionAnswer::find($id);
        $data->status = "2";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        Session::put('message', 'Content disapproved successfully!');
        return redirect(URL::previous());
    }

    public function contentApproveQuestion2($id)
    {
        $data = QuestionAnswer::find($id);
        $data->status = "1";
        $data->approved_by = Auth()->user()->id;
        $data->save();

        Session::put('message', 'Content approved successfully!');
        return redirect(URL::previous());
    }

    public function editStudent($id)
    {

        $data = User::find($id);
        $states = State::all();
        $districts = District::where('state_id', $data->state)->get();
        $cities =  City::where('district_id', $data->district)->get();;
        $standards = Standard::all();
        $data1 = User::find($id);
        return view('pages.Admin.edit-student', compact('standards','data', 'states', 'districts', 'cities','data1'));
    }

    public function editMentor($id)
    {

        $data = User::find($id);
        $states = State::all();
        $districts = District::where('state_id', $data->state)->get();
        $cities =  City::where('district_id', $data->district)->get();;
        return view('pages.Admin.edit-mentor', compact('data', 'states', 'districts', 'cities'));
    }

    public function editModerator($id)
    {

        $data = User::find($id);
        return view('pages.Admin.edit-moderator', ['data' => $data]);
    }

    public function editAdvertisment($id)
    {
        $data = Advertisment::find($id);
        return view('pages.Admin.edit-advertisment',['data' => $data]);
    }

    public function deleteStudent($id)
    {

        $data = User::find($id);
        $data->status = "4";
        $data->save();
        Session::put('message', 'Student deleted successfully!');
        return redirect(url('admin/students'));
    }

    public function deleteMentor($id)
    {

        $data = User::find($id);
        $data->status = "4";
        $data->save();
        Session::put('message', 'Mentor deleted successfully!');
        return redirect(url('admin/mentors'));
    }

    public function deleteModerator($id)
    {

        $data = User::find($id);
        $data->status = "4";
        $data->save();
        Session::put('message', 'Moderator deleted successfully!');
        return redirect(url('admin/moderators'));
    }

    public function deleteAdvertisment($id)
    {

        $data = Advertisment::find($id);
       $data->status = "4";
        $data->save();
        Session::put('message', 'Advertisment deleted successfully!');
        return redirect(url('admin/advertisment'));
    }
    public function viewStudent($id)
    {

        $data = User::find($id);
        return view('pages.Admin.view-student', ['data' => $data]);
    }

    public function viewMentor($id)
    {

        $data = User::find($id);
        return view('pages.Admin.view-mentor', ['data' => $data]);
    }

    public function viewModerator($id)
    {

        $data = User::find($id);
        return view('pages.Admin.view-moderator', ['data' => $data]);
    }
    public function update_user(Request $request, $user_id)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'    => 'required',
            'user_name'    => 'required',
            'email'    => 'required|email|unique:users,email,' . $user_id,
        ]);

        $user = User::find($user_id);
        $user->first_name = $request->Input('first_name');
        $user->last_name = $request->Input('last_name');
        $user->user_name = $request->Input('user_name');
        $user->email = $request->Input('email');
        if ($user->save()) {
            Session::flash('success', "Profile Updated Successfully.");
            return redirect('profile-detail');
        } else {
            Session::flash('error', "Something went wrong while updating profile.");
            return back();
        }
    }

    public function forgot_password(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email'
        ]);
        $email = $request->Input('email');
        $user_info = User::where('email', $email)->first();
        if (!empty($user_info)) {

            $token = md5(strtotime(date('Y-m-d H:i:s')) . md5($user_info->id));
            $reset_url = url('/set-password?token=') . $token;
            $data  = array(
                'reset_token' => $token
            );
            User::where('id', $user_info->id)->update($data);

            $html = $data = [
                'name' => $user_info['first_name'] . ' ' . $user_info['last_name'],
                'email' => $user_info['email'],
                'reset_link' => $reset_url
                // 'token'=>$token
            ];
            $email = $user_info['email'];
            $view = view('email.reset', compact('data', 'html'))->render();
            // echo $view;exit();
            // Mail::send('email.reset',['html' => $data], function($message) use ($email) {
            //         $message->to($email);
            //         $message->subject('Wandermonkey - Forgot Password');
            // });

            Session::flash('success', "We sent you an email with a token to reset your password.");
            return back();
        } else {
            Session::flash('error', "Email does not exists.");
            return back();
        }
    }

    function change_password()
    {
        return view('user.change_password');
    }

    function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            Session::flash('error', "Current password does not match!");
            return back();
        }

        $user->password = bcrypt($request->password);
        if ($user->save()) {
            Session::flash('success', "Password successfully changed!");
            return redirect('profile-detail');
        } else {
            Session::flash('error', "Something went wrong while updating password.");
            return back();
        }
    }

    function getReset(Request $request)
    {
        $token = $request->query('token');
        return view('registration.reset', compact('token'));
    }

    function reset_password(Request $request)
    {

        $password = $request->Input('password');
        $confirm_password = $request->Input('confirm_password');
        $token = $request->Input('token');

        if ($password != $confirm_password) {
            Session::flash('fails', ' Repeat password does not match');
            return back();
            exit;
        }

        $user_info = User::where('reset_token', $token)->first();
        if (empty($user_info)) {
            Session::flash('fails', ' Invalid token');
            return back();
            exit;
        }

        if (!empty($user_info)) {
            $data  = array(
                'reset_token' => "",
                'password' => bcrypt($password)
            );
            User::where('reset_token', $token)->update($data);
            Session::flash('success', "Password set successfully.");
            return back();
            exit;
        }
    }

    public function login2(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = trim($request->Input('email'));
        $pass = trim($request->Input('password'));

        if (Auth::attempt(['email' => $user, 'password' => $pass])) {
            $userID = \Session::getId();
            $cart_id = $userID . '_cart_items';
            $cart = DatabaseStorageModel::where('id', $cart_id)->first();
            if (!empty($cart)) {
                $userID = Auth::id();
                $cart_id = $userID . '_cart_items';
                DatabaseStorageModel::where('id', $cart_id)->update(['id' => $cart_id]);
            }
            return Redirect('/');
        } else {
            Session::flash('fails', ' Incorrect email or password..!');
            return back();
        }
    }


    public function checkDuplicateEmail(Request $request)
    {
        $data = User::where('email', $request->email)->first();

        if ($data) {
            return "false";
        }

        return "true";
    }

    public function editCheckDuplicateEmail(Request $request)
    {
        $data = User::where('id', '!=', $request->user_id)
            ->where('email', $request->email)->first();
        if ($data) {
            return "false";
        }
        return "true";
    }

    public function serniorMentor(Request $request)
    {
        $data = User::find($request->user_type);
        $data->senior_mentor = $request->senior_mentor;
        $data->save();

        return "success";
    }

    public function videolist()
    {
        
        return view('pages.Admin.vedio_list');
    }
    public function addVedioForm(Request $request)
    {
       // $abc = User::select('id','first_name','last_name')->where('user_type', 3)->get();
        //$stud = User::select('id','first_name','last_name')->where('user_type', 4)->get();
        $standards = Standard::all();
       // return view('pages.Admin.add-student', compact('states','standards'));
       return view('pages.Admin.add-vedio', compact('standards'));
    
    }
    public function save_vedio(Request $request)
    {
        //print_r($request->standard);die;
      $vedio = new Video_url();
      $vedio->url = $request->url;
      if($request->mentor_type!=""){
      $getnameReq = $request->mentor_id= $request->mentor_type;
      $mentor_idd = User::whereIn('mentor_type',$getnameReq)->get();
      foreach($mentor_idd as $id_ment){
       $abc[]= $id_ment->id;
      }
     
      $mentor_id= implode(',', $abc);
      $vedio->mentor_id=$mentor_id;
      }
      if($request->standard!=""){
       
      $getlastReq = $request->student_id= $request->standard;
      $student_idd = User::whereIn('standard',$getlastReq)->get();
      foreach($student_idd as $id_stud){
        $abcd[]= $vedio->student_id= $id_stud->id;
      }
      $student_id = implode(',', $abcd);
      $vedio->student_id=$student_id;
    }
      $vedio->save();
      Session::put('message', 'Vedio Url Added successfully!');
      return redirect('/admin/Video-Conference/list');
    }
    public function vedlistt()
    {
        $allvedio = Video_url::orderBy('id', 'desc')->get();
       // return $this->getTable()->orderBy('id', 'desc')->get()->all();
        return view('pages.Admin.vedio_list',compact('allvedio'));
    }
    public function VideoApprove(Request $request)
    {
     
        $data = Video_url::find($request->idetor_id);
        $data->status = "1";
        $data->save();
        return "success";
    }
    public function Videodisapprove(Request $request)
    {
        $data = Video_url::find($request->idetor_id);
        $data->status = "0";
        $data->save();

        return "success";
    }
    public function Videostudent(Request $request){
        if(Auth::check()){
            $stud_video=array();
            if(Auth::user()->user_type== 4)
            {
                $user_id = Auth::user()->id;
                $video=Video_url::where('status', 1)->get();
                
                foreach($video as $v){
                    $student_id = explode(',',$v->student_id);
                    if(in_array($user_id ,$student_id))
                    {
                        array_push($stud_video,$v->url);
                    }
                }    
                return view('pages.Admin.stud_video', compact('stud_video'));
            }
            if(Auth::user()->user_type== 3 )
            {
                $user_id = Auth::user()->id;
                $video_mentor=Video_url::where('status', 1)->get();
             
                    foreach($video_mentor as $u){
                        $mentor_id = explode(',',$u->mentor_id);
                            if(in_array($user_id ,$mentor_id))
                            {
                               array_push($stud_video,$u->url);
                            }
                    }    
                return view('pages.Admin.stud_video', compact('stud_video'));
            }
        }
    }
}
