<?php

use App\Models\Follower;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\LogActivity;
use App\Models\User;

function getTotalPostLikes($post_id)
{
    return PostLike::where('post_id', $post_id)->count();
}

function getTotalPostComments($post_id)
{
    return PostComment::where('post_id', $post_id)
    ->where('status', '1')
    ->count();
}
function isLiked($post_id, $user_id)
{
    return PostLike::where('post_id', $post_id)
    ->where('liked_by', $user_id)
    ->first();
}

function getFollowersCount($mentor_id)
{
    return Follower::where('mentor_id', $mentor_id)->count();
}

function isFollowing($mentor_id, $student_id)
{
    return Follower::where('mentor_id', $mentor_id)
    ->where('student_id', $student_id)
    ->first();
}

function addToLogActivity($data){
   $log= new LogActivity();
   $log->activity_type=$data['type'];
   $log->text=$data['text'];
   $log->user_id=$data['user_id'];
   $log->save();
}

function getUserName($userId){
    $user=User::find($userId);
    if(!empty($user)){
        return $user->first_name.' '.$user->last_name;
    }else{
        return '';
    }
}

function getUserType($type){
    if($type==1){
        return 'Admin';
    }else if($type==2){
        return 'Moderator';
    }else if($type==3){
        return 'Mentor';
    }else if($type==4){
        return 'Student';
    }else{
        return "";
    }
}