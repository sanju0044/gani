<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Follower;
use App\Models\Language;
use App\Models\Photo;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\QuestionAnswer;
use App\Models\Standard;
use App\Models\State;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\URL;
use Session;
use App\Models\Advertisment;
use Mail;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    public function home()
    {
        $user_id = Auth::user()->id;
        // $mentors = Follower::where('student_id',$user_id )
        // ->select('mentor_id')
        // ->get()->pluck('mentor_id')->toArray();
        // $posts = Post::whereIn('mentor_id', $mentors)

        $posts = Post::where('status', '1')
        ->orderBy('id','Desc')
        ->limit(3)
        ->offset(0  * 3)
        ->get();

        $languages = Language::all();
        $standards = Standard::all();
        $topics = Topic::all();
        $categories = Category::all();
      
        // $data = Advertisment::all();
        $data = Advertisment::where('status', '0')
        ->orderBy('id','Desc')
        ->get();

        return view('pages.student.home', compact('posts', 'languages', 'standards', 'topics', 'categories','data'));
    }

    public function home2()
    {
        $user_id = Auth::user()->id;
        $mentors = Follower::where('student_id',$user_id )
        ->select('mentor_id')
        ->get()->pluck('mentor_id')->toArray();

        $posts = Post::whereIn('mentor_id', $mentors)
        ->where('status', '1')
        ->orderBy('id','Desc')
        ->limit(3)
        ->offset(0  * 3)
        ->get();

        return view('pages.student.home2', compact('posts'));
    }

    public function ajaxLoadMorePost(Request $request)
    {
        $user_id = Auth::user()->id;
        // $mentors = Follower::where('student_id',$user_id )
        // ->select('mentor_id')
        // ->get()->pluck('mentor_id')->toArray();

        $query = Post::query();
        if($request->language_id)
        {
            $query->where("language_id", $request->language_id);
        }
        if($request->topic_id)
        {
            $query->where("topic_id", $request->topic_id);
        }
        if($request->category_id)
        {
            $query->where("category_id", $request->category_id);
        }

        if($request->standard_id)
        {
            $query->where("standard_id", $request->standard_id);
        }
        $posts = $query->where('status', '1')
        ->orderBy('id','Desc')
        ->limit(3)
        ->offset(($request['page'] - 1)  * 3)
        ->get();

        return view('pages.student.ajax-post', compact('posts'));
    }

    public function ajaxLoadMorePostMentor(Request $request)
    {

        $posts = Post::where('mentor_id', $request->mentor_id)
            ->where('status', '1')
            ->orderBy('id','Desc')
            ->limit(3)
            ->offset(($request['page'] - 1)  * 3)
            ->get();

        return view('pages.student.ajax-post', compact('posts'));
    }

    public function ajaxLikePost(Request $request)
    {
        $post=Post::find($request->post_id);
        if($request->type=="like")
        {
            $obj = new PostLike();
            $obj->post_id = $request->post_id;
            $obj->liked_by = Auth::user()->id;
            $obj->save();

            addToLogActivity([
                'type'=>7,
                'text'=>'Liked Post "'.substr($post->description, 0, 15).'"',
                'user_id'=>Auth::user()->id
            ]);
            return "like success";
        }else{
            $obj = PostLike::where('post_id',$request->post_id )
            ->where('liked_by',Auth::user()->id)
            ->delete();

            addToLogActivity([
                'type'=>8,
                'text'=>'Uniked Post "'.substr($post->description, 0, 15).'"',
                'user_id'=>Auth::user()->id
            ]);

            return "unlike success";
        }
    }

    public function ajaxLoadPostComments(Request $request)
    {
            $comments = PostComment::where('status','1')
            ->where('post_id', $request->post_id)
            ->orderBy('id','DESC')
            ->get();
            return view('pages.student.ajax-load-comments', ['post_id' => $request->post_id, 'comments' => $comments]);
    }

    public function ajaxSubmitComment(Request $request)
    {
        $obj = new PostComment();
        $obj->commented_by = Auth::user()->id;
        $obj->post_id = $request->post_id;
        $obj->comment = $request->comment;
        $obj->status = "0";
        $obj->save();

        $post=Post::find($request->post_id);
        addToLogActivity([
            'type'=>5,
            'text'=>'Comment "'.substr($request->comment, 0, 15).'" added on post "'.substr($post->description, 0, 15).'"',
            'user_id'=>Auth::user()->id
        ]);
        return "success";
    }

    public function profile()
    {
        $standards = Standard::all();
        $states = State::all();
        $districts = District::where('state_id', Auth::user()->state)->get();
        $cities =  City::where('district_id', Auth::user()->district)->get();
        
        return view('pages.student.profile' ,compact('standards','states', 'districts', 'cities'));
    }

    public function updateprofile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->DOB = $request->DOB;
        $user->address = $request->address;
        $user->city = $request->city_id;
        $user->state = $request->state_id;
        $user->district = $request->district_id;
        $user->pincode = $request->pincode;
        $user->age = $request->age;
        $user->mobile_no = $request->mobile_no;
        $user->standard = $request->standard;
        $user->reference = $request->reference;
        
        if ($request->has('password') && $request->password != "") {
            $user->password = bcrypt($request->password);

            //$adminMaapepicUrl = 'http://adminmaapepic.loc/dashboard/Api/update-password';
            // $adminMaapepicUrl = 'https://admin.maapepic.progfeel.co.in/dashboard/Api/update-password';
            $adminMaapepicUrl = 'https://admin.maapepic.com/dashboard/Api/update-password';

            $ciResponse = Http::asForm()->post($adminMaapepicUrl, [
                'user_name'     => $user->user_name,
                'new_password'     => $request->password,
            ]);
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

        Session::put('message', 'Profile updated successfully!');
        return redirect(url('student/profile'));
    }

    public function studentMentors()
    {
        $data = User::where('user_type', '3')
            ->where('status', '1')
            ->get();
        return view('pages.student.mentors', compact('data'));
    }

    public function mentorPost($mentor_id,Request $request)
    {
        $user_id = base64_decode($mentor_id);
        $followers = Follower::where('mentor_id', $user_id)->get();
        $photos = Photo::where('user_id',$user_id )->get();
        $posts = Post::where('mentor_id', $user_id)
            ->where('status', '1')
            ->orderBy('id','Desc')
            ->limit(3)
            ->offset(0  * 3)
            ->get();

        // echo "<pre>";
        // print_r($posts);
        // die;

        $user = User::find($user_id);

        if(!$request->ajax()){
            addToLogActivity([
                'type'=>9,
                'text'=>'Visited profile of mentor "'.getUserName(base64_decode($mentor_id)).'"',
                'user_id'=>Auth::user()->id
            ]);
        }
        return view('pages.student.mentor-post', compact('followers', 'posts', 'photos', 'user'));
    }

    public function mentorFollow($mentor_id)
    {
        $obj = new Follower();

        $obj->student_id = Auth::user()->id;
        $obj->mentor_id = base64_decode($mentor_id);
        $obj->save();

        addToLogActivity([
            'type'=>3,
            'text'=>'Satrted to follow mentor "'.getUserName(base64_decode($mentor_id)).'"',
            'user_id'=>Auth::user()->id
        ]);
        Session::put('message', 'Mentor followed successfully!');
        return redirect(URL::previous());
    }

    public function mentorUnfollow($mentor_id)
    {
        Follower::where('mentor_id', base64_decode($mentor_id))
            ->where('student_id', Auth::user()->id)
            ->delete();

        addToLogActivity([
            'type'=>4,
            'text'=>'Satrted to unfollow mentor "'.getUserName(base64_decode($mentor_id)).'"',
            'user_id'=>Auth::user()->id
        ]);

        Session::put('message', 'Mentor unfollowed successfully!');
        return redirect(URL::previous());
    }

    public function submitQuestion(Request $request)
    {
        $obj = new QuestionAnswer();
        $obj->mentor_id = $request->mentor_id;
        $obj->student_id = Auth::user()->id;
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->question = $request->question;
        $obj->question_status = '0';
        $obj->status = '0';
        $obj->save();

        addToLogActivity([
            'type'=>6,
            'text'=>'Question asked "'.substr($request->question, 0, 15).'" to mentor "'.getUserName($request->mentor_id).'"',
            'user_id'=>Auth::user()->id
        ]);

        $email = $request->email;
        $data = array('email'=>$email);
        $user['to']= $request->email;
        $student_email['to'] = User::where('user_type', 4)->get();
        $mentor_email = User::where('user_type', 3)->get();
      
        Mail::send('emails.mail8',$data, function($message) use ($user) 
        {
          $message->to($user['to']);
          $message->subject('Question Notifications');
          $message->from('info@ganitalay.in', 'ganitalay');
      });

        //  foreach ($student_email as  $student_email) 
        //  {
        //       Mail::send('emails.mail9',$data, function($message) use ($student_email) 
        //      {
        //        $message->to($student_email->email);
        //        $message->subject('Question Notifications');
        //        $message->from('info@ganitalay.in', 'ganitalay');
        //     });
        //   }
        //   foreach ($mentor_email as  $mentor_email) 
        //   {
        //        Mail::send('emails.mail10',$data, function($message) use ($mentor_email) 
        //       {
        //         $message->to($mentor_email->email);
        //         $message->subject('Question Notifications');
        //         $message->from('info@ganitalay.in', 'ganitalay');
        //      });
        //    }

        Session::put('message', 'Question submitted successfully!');
        return redirect(URL::previous());
    }

    public function getQuestionAnswer(){

        $data = QuestionAnswer::where('status', '1')
        // ->where('student_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.student.question-answers', compact('data'));
    }
}
