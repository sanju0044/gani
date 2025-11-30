<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DatabaseStorageModel;
use Session;
use Auth;
use Hash;
use Mail;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

class UserController extends Controller
{
    public function register(Request $request)
    {


        $user = User::where('email',$request->email )->first();
        if($user)
        {
            return ['message'=>'error', 'data'=>"Email already exist."];
        }
        // print_r($request->all());exit();
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->city_id;
        $user->state = $request->state_id;
        $user->pincode = $request->pincode;
        $user->age = $request->age;
        $user->standard = $request->standard;
        $user->reference = $request->reference;
        $user->user_type = 4;
        $user->status = '1';
        $user->password = bcrypt($request->password);

        if ($request->has('profile_picture') && $request->file('profile_picture')) {
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

        return ['message'=>'success', 'data'=>$user];
    }

    public function registerUser(Request $request)
    {
        // dd(FacadesSession::all());

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
        $email = $request->email;
        $data = array('email'=>$email);
        $user['to']= $request->email;
        $user_name = $request->user_name;
        $data = array('user_name'=>$user_name);
         if ((Auth::attempt(['email' => $request->user_name, 'password' => $request->password])) || (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password]))) {
            $user['to']=(Auth::user()->email);
            if (Auth::user()->status == "1") {
                if (Auth::user()->user_type == 1) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail4',$data, function($message) use ($user) 
                        //     {
                        //         $message->to($user['to']);
                        //         $message->subject('Login Notifications');
                        //         $message->from('info@ganitalay.in', 'ganitalay');
                        //     });
                    }    
                    return redirect('admin/dashboard');
                
                } else if (Auth::user()->user_type == 2) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail5',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('admin/dashboard');
              
                } else if (Auth::user()->user_type == 3) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail2',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('mentor/home');
                  
                } else if (Auth::user()->user_type == 4) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail3',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('student/home');
                   
                    /*if(Auth::user()->paid_user==1){
                        addToLogActivity([
                            'type'=>1,
                            'text'=>'Logged in',
                            'user_id'=>Auth::user()->id
                        ]);
                        return redirect('student/home');
                    }else{
                        Auth::logout();
                        Session::put('message', "Sorry! You do not have access.");
                        return redirect('/login');
                    }*/
                }
            }elseif (Auth::user()->status == "4") {
                Session::put('message', 'Your account is deleted.');
            }elseif (Auth::user()->status == "0") {
                Session::put('message', 'Your account is inactive. Please contact admin.');
            }
        }
        // elseif ((Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) && (Auth::attempt(['email' => $request->email, 'password' => $request->password]))) {
        //     $user['to']=(Auth::user()->email);
        //     if (Auth::user()->status == "1") {
        //         if (Auth::user()->user_type == 1) {
        //             if(!empty($user['to'])){
        //                 Mail::send('emails.mail4',$data, function($message) use ($user) 
        //                 {
        //                     $message->to($user['to']);
        //                     $message->subject('Login Notifications');
        //                     $message->from('info@ganitalay.in', 'ganitalay');
        //                });
        //             }
        //             return redirect('admin/dashboard');
                
        //         } else if (Auth::user()->user_type == 2) {
        //             if(!empty($user['to'])){
        //                 Mail::send('emails.mail5',$data, function($message) use ($user) 
        //                 {
        //                     $message->to($user['to']);
        //                     $message->subject('Login Notifications');
        //                     $message->from('info@ganitalay.in', 'ganitalay');
        //                 });
        //             }
        //             return redirect('admin/dashboard');
              
        //         } else if (Auth::user()->user_type == 3) {
        //             addToLogActivity([
        //                 'type'=>1,
        //                 'text'=>'Logged in',
        //                 'user_id'=>Auth::user()->id
        //             ]);
        //             if(!empty($user['to'])){
        //                 Mail::send('emails.mail2',$data, function($message) use ($user) 
        //                 {
        //                     $message->to($user['to']);
        //                     $message->subject('Login Notifications');
        //                     $message->from('info@ganitalay.in', 'ganitalay');
        //                 });
        //             }
        //             return redirect('mentor/home');
                  
        //         } else if (Auth::user()->user_type == 4) {
        //             addToLogActivity([
        //                 'type'=>1,
        //                 'text'=>'Logged in',
        //                 'user_id'=>Auth::user()->id
        //             ]);
        //             if(!empty($user['to'])){
        //                 Mail::send('emails.mail3',$data, function($message) use ($user) 
        //                 {
        //                     $message->to($user['to']);
        //                     $message->subject('Login Notifications');
        //                     $message->from('info@ganitalay.in', 'ganitalay');
        //                 });
        //             }    
        //             return redirect('student/home');
                   
        //             /*if(Auth::user()->paid_user==1){
        //                 addToLogActivity([
        //                     'type'=>1,
        //                     'text'=>'Logged in',
        //                     'user_id'=>Auth::user()->id
        //                 ]);
        //                 return redirect('student/home');
        //             }else{
        //                 Auth::logout();
        //                 Session::put('message', "Sorry! You do not have access.");
        //                 return redirect('/login');
        //             }*/
        //         }
        //     }elseif (Auth::user()->status == "4") {
        //         Session::put('message', 'Your account is deleted.');
        //     }elseif (Auth::user()->status == "0") {
        //         Session::put('message', 'Your account is inactive. Please contact admin.');
        //     }
        // } 
        else {
            Session::put('message', 'Inavlid login credentials.');
        }
        return redirect('/login');
    }

    public function sign_in_form()
    {
        return view('registration.signin');
    }

    public function logout()
    {
        // print_r('abcd');
        
         $user['to']= Auth::user()->email;
         $user_name = Auth::user()->user_name;
         $data = array('user_name'=>$user_name);

        if(Auth::user()->user_type == 3 || Auth::user()->user_type == 4){
            addToLogActivity([
                'type'=>2,
                'text'=>'Logged out',
                'user_id'=>Auth::user()->id
            ]);

        }
        Auth::logout();
        if(!empty($user['to'])){
            // Mail::send('emails.mail',$data, function($message) use ($user) 
            // {
            //     $message->to($user['to']);
            //     $message->subject('Logout Notifications');
            //     $message->from('info@ganitalay.in', 'ganitalay');
            // });
        }
        return redirect("/");
    }

    public function profile()
    {
        return redirect(url('/'));
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
            // echo $view;exit();

            // Mail::send('email.welcome',['html' => $data], function($message) use ($email) {
            //         $message->to($email);
            //         $message->subject('Welcome to Autodukan');
            // });
            
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

    public function profile_detail()
    {
        $auth_id = Auth::id();
        $user = User::where('id', $auth_id)->first();
        return view('user.profile', compact('user'));
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

    public function forgotPassword(Request $request)
    {

        $email = $request->email;
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

            // Mail::send('emails.reset',['data' => $data], function($message) use ($email) {
            //         $message->to($email);
            //         $message->subject('IBIT - Forgot Password');
            // });




            Session::flash('msg_success', "We sent you an email with a token to reset your password.");
            return back();
        } else {
            Session::flash('msg_error', "Email does not exists.");
            return back();
        }
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

    function setPassword(Request $request)
    {
        $token = $request->query('token');


        return view('pages.reset-password', compact('token'));
    }

    function resetPassword(Request $request)
    {
        $password = $request->Input('password');
        $confirm_password = $request->Input('confirm_password');
        $token = $request->Input('token');

        Session::put('msg_type', 'error');
        if ($password != $confirm_password) {
            Session::put('message', 'Repeat password does not match.');
            return back();
            exit;
        }

        $user_info = User::where('reset_token', $token)->first();
        if (empty($user_info)) {
            Session::put('message', 'Invalid token.');
            return back();
            exit;
        }

        if (!empty($user_info)) {
            $data  = array(
                'reset_token' => "",
                'password' => bcrypt($password)
            );
            User::where('reset_token', $token)->update($data);
            Session::put('msg_type', 'success');
            Session::put('message', 'Password set successfully.');
            return back();
            exit;
        }
    }

    public function checkDuplicateEmail(Request $request){
        $data = User::where('id','!=', Auth::user()->id)
            ->where('email',$request->email)->first();

        if($data)
        {
            return "false";
        }

        return "true";
    }

    public function checkCurrentPassword(Request $request){
        $data = User::where('id', Auth::user()->id)->first();


        if (Hash::check($request->current_password, $data->password)) {

            return "true";
        }

        return "false";
    }

    public function get_user_by_type(Request $request){
        $user_type=$request->user_type??0;
        $query = User::query();
        if($user_type > 0){
            $query->where('user_type', $user_type);
        }else{
            $query->where('user_type', 4)->orWhere('user_type',3);
        }
        $data=$query->get();

        $all_users='<option value="0">Select User</option>';
        if(count($data) > 0){
            foreach ($data as $key => $user) {
               $all_users.='<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
            }
        }
        return response()->json([
            'users_list'=>$all_users
        ],200);
    }

    public function checkUserAvailable()
    {
        $email = "shree894@yopmail.com";

        if (!$email) {
            return response()->json(['error' => 'Email is required'], 400);
        }

        // Find user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Log the user in using their ID
            Auth::loginUsingId($user->id);

            $user['to']=(Auth::user()->email);
        
            if (Auth::user()->status == "1") {
                if (Auth::user()->user_type == 1) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail4',$data, function($message) use ($user) 
                        //     {
                        //         $message->to($user['to']);
                        //         $message->subject('Login Notifications');
                        //         $message->from('info@ganitalay.in', 'ganitalay');
                        //     });
                    }    
                    return redirect('admin/dashboard');
                
                } else if (Auth::user()->user_type == 2) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail5',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('admin/dashboard');
            
                } else if (Auth::user()->user_type == 3) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail2',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('mentor/home');
                
                } else if (Auth::user()->user_type == 4) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail3',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('student/home');
                
                    /*if(Auth::user()->paid_user==1){
                        addToLogActivity([
                            'type'=>1,
                            'text'=>'Logged in',
                            'user_id'=>Auth::user()->id
                        ]);
                        return redirect('student/home');
                    }else{
                        Auth::logout();
                        Session::put('message', "Sorry! You do not have access.");
                        return redirect('/login');
                    }*/
                }
            }elseif (Auth::user()->status == "4") {
                Session::put('message', 'Your account is deleted.');
            }elseif (Auth::user()->status == "0") {
                Session::put('message', 'Your account is inactive. Please contact admin.');
            }
        } else 
        {
            $user = new User();
            $user->first_name = "Ganesh";
            $user->email = $email;
            $user->mobile_no = "8888349264";
            $user->user_type = 4;
            $user->status = '1';
            $user->save();

            // Find user by email
            $userDetails = User::where('email', $email)->first();

            // Log the user in using their ID
            Auth::loginUsingId($user->id);

            $user['to']=(Auth::user()->email);
        
            if (Auth::user()->status == "1") {
                if (Auth::user()->user_type == 1) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail4',$data, function($message) use ($user) 
                        //     {
                        //         $message->to($user['to']);
                        //         $message->subject('Login Notifications');
                        //         $message->from('info@ganitalay.in', 'ganitalay');
                        //     });
                    }    
                    return redirect('admin/dashboard');
                
                } else if (Auth::user()->user_type == 2) {
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail5',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('admin/dashboard');
            
                } else if (Auth::user()->user_type == 3) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail2',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('mentor/home');
                
                } else if (Auth::user()->user_type == 4) {
                    addToLogActivity([
                        'type'=>1,
                        'text'=>'Logged in',
                        'user_id'=>Auth::user()->id
                    ]);
                    if(!empty($user['to'])){
                        // Mail::send('emails.mail3',$data, function($message) use ($user) 
                        // {
                        //     $message->to($user['to']);
                        //     $message->subject('Login Notifications');
                        //     $message->from('info@ganitalay.in', 'ganitalay');
                        // });
                    }
                    return redirect('student/home');
                
                    /*if(Auth::user()->paid_user==1){
                        addToLogActivity([
                            'type'=>1,
                            'text'=>'Logged in',
                            'user_id'=>Auth::user()->id
                        ]);
                        return redirect('student/home');
                    }else{
                        Auth::logout();
                        Session::put('message', "Sorry! You do not have access.");
                        return redirect('/login');
                    }*/
                }
            }elseif (Auth::user()->status == "4") {
                Session::put('message', 'Your account is deleted.');
            }elseif (Auth::user()->status == "0") {
                Session::put('message', 'Your account is inactive. Please contact admin.');
            }
        }
    }

    public function validateUser(Request $request)
    {
        $email = $request->input('email');
        
        if (!$email) {
            return response()->json(['error' => 'Email is required'], 400);
        }

        // Find user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::loginUsingId($user->id);

            $user['to'] = (Auth::user()->email);

            if (Auth::user()->status == "1") {
                return response()->json([
                    'status' => 'success',
                    'user_exists' => true,
                    'message' => 'User is valid.'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User is inactive.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'user_exists' => false,
                'message' => 'User does not exist.'
            ]);
        }
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|string|max:15',
            'user_type' => 'required|integer',
            'status' => 'required|integer',
            'user_name' => 'required',
            'password' => 'required|string|min:6' // Validate password
        ]);

        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->email = $validatedData['email'];
        $user->mobile_no = $validatedData['mobile_no'];
        $user->user_type = $validatedData['user_type'];
        $user->status = $validatedData['status'];
        $user->user_name = $validatedData['user_name'];
        $user->password = bcrypt($validatedData['password']); // Hash the password


        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to create user.'
            ], 500);
        }
    }

    public function validateOrCreateUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'email' => 'required',
                'mobile_no' => 'required|string|max:15',
                'user_type' => 'required',
                'status' => 'required',
                'user_name' => 'required',
                'password' => 'required' // Validate password
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::debug('Validation failed: ' . json_encode($e->errors()));
            return response()->json([
                'status' => 'failed',
                'errors' => $e->errors()
            ], 422);
        }
     
        // Check if the user exists by email
        $user = User::where('email', $validatedData['email'])->first();
      
        if ($user) {
            // User exists, return success with user_exists true
            return response()->json([
                'status' => 'success',
                'user_exists' => true,
            ], 200);
        } else {
            $user = new User();
            $user->first_name = $validatedData['first_name'];
            $user->email = $validatedData['email'];
            $user->mobile_no = $validatedData['mobile_no'];
            $user->user_type = $validatedData['user_type'];
            $user->status = $validatedData['status'];
            $user->user_name = $validatedData['user_name'];
            $user->password = bcrypt($validatedData['password']); // Hash the password


            if ($user->save()) {
                return response()->json([
                    'status' => 'success',
                    'user_exists' => false,
                    'message' => 'User created successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'user_exists' => false,
                    'message' => 'Failed to create user.'
                ], 500);
            }
        }
    }

    public function externalRegister(Request $request)
    {
        $user = User::where('user_name',$request->user_name )->first();

        if($user)
        {
            return ['message'=>'error', 'data'=>"Username already exist."];
        }
        
        // print_r($request->all());exit();
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->city_id;
        $user->state = $request->state_id;
        $user->pincode = $request->pincode;
        $user->age = $request->age;
        $user->standard = $request->standard;
        $user->reference = $request->reference;
        $user->user_type = 4;
        $user->status = '1';
        $user->password = bcrypt($request->password);
        $user->user_name = $request->user_name;

        if ($request->has('profile_picture') && $request->file('profile_picture')) {
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

        return ['message'=>'success', 'data'=>$user];
    }

    function externalPasswordUpdate(Request $request)
    {
        $user = User::where('user_name', $request->user_name)->first();

        $user->password = bcrypt($request->new_password);

        if ($user->save()) {
            return ['message'=>'success'];
        } else {
             return ['message'=>'error'];
        }
    }

    public function checkUserNameExistInGanitalay(Request $request)
    {
        $user = User::where('user_name',$request->user_username)->first();
     
        if(!empty($user))
        {
            return ['message'=>'error', 'data'=>"Username already exist in Ganitalay"];
        }
        else
        {
            return ['message'=>'success', 'data'=>"You can add new student in ganitalay"];
        }
    }    
}
