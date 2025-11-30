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
use App\Models\QuestionAnswer;
use App\Models\Standard;
use App\Models\State;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\URL;
use Session;
use Mail;
class MentorController extends Controller
{
    //
    public function home()
    {
        $user_id = Auth::user()->id;
        $posts = Post::where('status', '1')
            ->orderBy('id', 'Desc')
            ->limit(3)
            ->offset(0  * 3)
            ->get();

        // echo count($posts);exit();
        // print_r($posts);exit;

        $all_contents = $this->getAllContents($user_id);
        $pending_contents = $this->getPendingContents($user_id);
        $approved_contents = $this->getApprovedContents($user_id);
        $disapproved_contents = $this->getDisapprovedContents($user_id);
        $followers = Follower::where('mentor_id', $user_id)->get();
        $photos = Photo::where('user_id', $user_id)->get();
        $languages = Language::all();
        $standards = Standard::all();
        $topics = Topic::all();
        $categories = Category::all();
       
        return view('pages.mentor.post', compact(
            'all_contents',
            'languages',
            'standards',
            'topics',
            'categories',
            'pending_contents',
            'approved_contents',
            'disapproved_contents',
            'followers',
            'posts',
            'photos',
          
        ));
    }
  

    public function ajaxLoadMorePostMentor(Request $request)
    {
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
        /**
         * Commenting as per new requirement to show all posts on mentor home page
         * Updated By : Priyanka Kumbhar
         * Updated On : 2024-01-03
         */
        // $posts = $query->where('mentor_id', $request->mentor_id)
        $posts = $query->where('status', '1')
            ->orderBy('id', 'Desc')
            ->limit(3)
            ->offset(($request['page'] - 1)  * 3)
            ->get();

        return view('pages.student.ajax-post', compact('posts'));
    }

    public function getAllContents($user_id)
    {
        $posts = Post::where("mentor_id", $user_id)->get();
        $question_answers = QuestionAnswer::where("mentor_id", $user_id)->get();
        $post_comments = PostComment::where("commented_by", $user_id)->get();

        foreach ($question_answers as $question) {
            $posts->push($question);
        }

        foreach ($post_comments as $comment) {
            $posts->push($comment);
        }

        $all_contents = $posts->sortByDesc(function ($post) {
            return $post['created_at'];
        });

        return $all_contents;
    }

    public function getApprovedContents($user_id)
    {
        $posts = Post::where("mentor_id", $user_id)
            ->where('status', '1')
            ->get();
        $question_answers = QuestionAnswer::where("mentor_id", $user_id)
            ->where('status', '1')
            ->get();

        $post_comments = PostComment::where("commented_by", $user_id)
            ->where('status', '1')
            ->get();
        foreach ($question_answers as $question) {
            $posts->push($question);
        }

        foreach ($post_comments as $comment) {
            $posts->push($comment);
        }
        $all_contents = $posts->sortByDesc(function ($post) {
            return $post['created_at'];
        });

        return $all_contents;
    }

    public function getDisapprovedContents($user_id)
    {
        $posts = Post::where("mentor_id", $user_id)
            ->where('status', '2')
            ->get();
        $question_answers = QuestionAnswer::where("mentor_id", $user_id)
            ->where('status', '2')
            ->get();

        $post_comments = PostComment::where("commented_by", $user_id)
            ->where('status', '2')
            ->get();

        foreach ($post_comments as $comment) {
            $posts->push($comment);
        }

        foreach ($question_answers as $question) {
            $posts->push($question);
        }

        $all_contents = $posts->sortByDesc(function ($post) {
            return $post['created_at'];
        });

        return $all_contents;
    }

    public function getPendingContents($user_id)
    {
        $posts = Post::where("mentor_id", $user_id)
            ->where('status', '0')
            ->get();
        $question_answers = QuestionAnswer::where("mentor_id", $user_id)
            ->where('status', '0')
            ->get();

        $post_comments = PostComment::where("commented_by", $user_id)
            ->where('status', '0')
            ->get();

        foreach ($question_answers as $question) {
            $posts->push($question);
        }

        foreach ($post_comments as $comment) {
            $posts->push($comment);
        }

        $all_contents = $posts->sortByDesc(function ($post) {
            return $post['created_at'];
        });

        return $all_contents;
    }
    public function getPendingQuestion()
    {
        $pending_questions = QuestionAnswer::where('question_status', '0')
            ->where('mentor_id', Auth::user()->id)
            ->with('student')
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.mentor.ajax-pending-questions', compact('pending_questions'));
    }

    public function getAnsweredQuestion()
    {
        $answered_questions = QuestionAnswer::where('question_status', '1')
            ->where('mentor_id', Auth::user()->id)
            ->with('student')
            ->orderBy('id', 'DESC')
            ->get();
            // print_r($answered_questions);
            // echo $answered_questions[0]->student->profile_picture;
            // exit;
        return view('pages.mentor.ajax-answered-questions', compact('answered_questions'));
    }

    public function submitAnswer(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
       
        $answered_questions = QuestionAnswer::find($request->id);
        $answered_questions->answer = $request->answer;
        $answered_questions->question_status = '1';
        $answered_questions->save();

        $email = Auth::user()->email;
        $data = array('email'=>$email);
  
        $email = QuestionAnswer::where('id', $request->id)->first();
        $user['to']= $email->email;
         
        Mail::send('emails.mail11',$data, function($message) use ($user) 
        {
          $message->to( $user['to']);
          $message->subject('Answer Notifications');
          $message->from('info@ganitalay.in', 'ganitalay');
        });
        
    
        addToLogActivity([
            'type'=>11,
            'text'=>'Answer given by mentor "'.substr($request->answer, 0, 15).'" to question "'.substr($answered_questions->question, 0, 15).'"',
            'user_id'=>Auth::user()->id
        ]);

        return "success";
    }

    public function profile()
    {
        $states = State::all();
        $districts = District::where('state_id', Auth::user()->state)->get();
        $cities =  City::where('district_id', Auth::user()->district)->get();;
        $data = Auth::user();

        return view('pages.mentor.profile', ['data' => $data], compact('states', 'districts', 'cities'));
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
        $user->short_bio = $request->short_bio;
        $user->mobile_no = $request->mobile_no;
        $user->current_work_profile = $request->current_work_profile;
        $user->other_details = $request->other_details;
        $user->mentor_type = $request->mentor_type;

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
            $path = $request->file('profile_picture')->storeAs('/images', $fileNameToStore);
            $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        Session::put('message', 'Profile updated successfully!');
        return redirect(url('mentor/profile'));
    }

    public function publishPost(Request $request)
    {


        $post =  new Post();
        $post->language_id = $request->language_id;
        $post->topic_id = $request->topic_id;
        $post->standard_id = $request->standard_id;
        $post->category_id = $request->category_id;
        $post->description = $request->description;
        $video = $post->video = $request->post_video."?rel=0";

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

        if(Auth::user()->senior_mentor==1 ){
            $post->status = "1";
        }else{
            $post->status = "0";
        }
        if(Auth::user()->mentor_type==4){
            $post->status = "1";
        }else{
            $post->status = "0";
        }
        
        $post->mentor_id = Auth::user()->id;
      
        $post->save();

        $email = Auth::user()->email;
        $data = array('email'=>$email);
        $user['to']= Auth::user()->email;
        $student_email = User::where('user_type', 4)->get();
        $mentor_email = User::where('user_type', 3)->get();
      
        Mail::send('emails.mail6',$data, function($message) use ($user) 
        {
          $message->to($user['to']);
          $message->subject('Post Notifications');
          $message->from('info@ganitalay.in', 'ganitalay');
      });


        //  foreach ($student_email as  $student_email) 
        //  {
        //       Mail::send('emails.mail7',$data, function($message) use ($student_email) 
        //      {
        //        $message->to($student_email->email);
        //        $message->subject('Post Notifications');
        //        $message->from('info@ganitalay.in', 'ganitalay');
        //     });
        //   }
        //   foreach ($mentor_email as  $mentor_email) 
        //   {
        //        Mail::send('emails.mail7',$data, function($message) use ($mentor_email) 
        //       {
        //         $message->to($mentor_email->email);
        //         $message->subject('Post Notifications');
        //         $message->from('info@ganitalay.in', 'ganitalay');
        //      });
        //    }
 
        addToLogActivity([
            'type'=>10,
            'text'=>'Post added "'.substr($request->description, 0, 15).'"',
            'user_id'=>Auth::user()->id
        ]);
       
        if(Auth::user()->senior_mentor==1 || Auth::user()->mentor_type==4){
            return ["message" => "Post created successfully."];
        }else{
            return ["message" => "Post created successfully. It will be published after admin approval."];
        }
       
      
    }

    public function uploadPhoto(Request $request)
    {
        $obj = new Photo();
        if ($request->has('description')) {
            $obj->description = $request->description;
        }
        if ($request->has('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('photo')->storeAs('images', $fileNameToStore);
            $obj->photo = $fileNameToStore;
        }
        $obj->user_id = Auth::user()->id;

        $obj->save();

        Session::put('message', 'Photo uploaded successfully!');
        return redirect(URL::previous());
    }

    public function ajaxLoadMentorMorePost(Request $request)
    {
        $languages = Language::all();
        $standards = Standard::all();
        $topics = Topic::all();
        $categories = Category::all();

        $user_id = Auth::user()->id;

        $query = Post::query();
        
        $sel_language_id=$request->language_id;
        $sel_topic_id=$request->topic_id;
        $sel_category_id=$request->category_id;
        $sel_standard_id=$request->standard_id;
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

        return view('pages.mentor.ajax-post', compact('posts','languages','standards','topics','categories','sel_language_id','sel_topic_id','sel_category_id','sel_standard_id'));
    }
}
