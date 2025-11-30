<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [UserController::class, 'postLogin']);

Route::middleware('auth')->group(function () {  
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);
    Route::get('/admin/activity-logs', [AdminController::class, 'activity_logs']);
    Route::get('/admin/activity-logs-data', [AdminController::class, 'activity_logs_data']);
    Route::get('/logout', [UserController::class, 'logout']);
    // Route::get('/mail', [UserController::class, 'logout']);
  
     Route::get('/admin/get-user-by-type', [UserController::class, 'get_user_by_type']);
    Route::get('/admin/profile', [AdminController::class, 'adminprofile']);
    Route::post('/admin/profile', [AdminController::class, 'updateAdminProfile']);
    Route::get('/admin-check-duplicate-email', [AdminController::class, 'checkDuplicateEmail']);
    Route::get('/admin-edit-check-duplicate-email', [AdminController::class, 'editCheckDuplicateEmail']);

    Route::get('/search', [AdminController::class, 'search']);
    // admin students routes starts here
    
    Route::get('/admin/add-student', [AdminController::class, 'addStudentForm']);
    Route::post('/admin/add-student', [AdminController::class, 'addStudent']);
    Route::post('/admin/student/import-students', [AdminController::class, 'importStudents']);
    Route::get('/admin/student/send_login_details_to_all_students', [AdminController::class, 'sendEmailAndPasswordToStudent']);
    Route::get('/admin/student/export-students', [AdminController::class, 'exportStudents']);
    Route::get('/admin/student/export-mentors', [AdminController::class, 'exportMentors']);
    // Route::post('/admin/mentor/import-mentor', [AdminController::class, 'mentorImport']);
    Route::post('/admin/mentor/import-mentor', [AdminController::class, 'importMentor']);
   
    Route::get('/admin/student/export-moderators', [AdminController::class, 'exportModerators']);
    Route::get('/admin/edit-student/{id}', [AdminController::class, 'editStudent']);
    Route::get('/admin/delete-student/{id}', [AdminController::class, 'deleteStudent']);
    Route::get('/admin/view-student/{id}', [AdminController::class, 'viewStudent']);
    Route::post('/admin/edit-student/{id}', [AdminController::class, 'updateStudent']);
    Route::get('/admin/students', [AdminController::class, 'studentList']);
    Route::get('admin/edit/comment/{id}', [AdminController::class, 'edit_comment']);
    Route::post('admin/update/comment/{id}', [AdminController::class, 'update_comment']);
    Route::get('/admin/ajax-student-data', [AdminController::class, 'ajaxStudentData']);
    Route::get('/admin/ajax-get-city-data', [AdminController::class, 'ajaxGetCity']);
    Route::get('/student-list', [AdminController::class, 'StudentData']);    

    Route::get('/admin/ajax-get-district-data', [AdminController::class, 'ajaxGetDistrict']);
    Route::get('/admin/ajax-add-student-get-city-data', [AdminController::class, 'ajaxAddStudentGetCity']);
    Route::get('/admin/ajax-add-student-get-district-data', [AdminController::class, 'ajaxAddStudentGetDistrict']);

    // admin mentor routes starts here
    Route::get('/admin/add-mentor', [AdminController::class, 'addMentorForm']);
    Route::post('/admin/add-mentor', [AdminController::class, 'addMentor']);
    Route::get('/admin/edit-mentor/{id}', [AdminController::class, 'editMentor']);
    Route::get('/admin/delete-mentor/{id}', [AdminController::class, 'deleteMentor']);
    Route::get('/admin/view-mentor/{id}', [AdminController::class, 'viewMentor']);
    Route::post('/admin/edit-mentor/{id}', [AdminController::class, 'updateMentor']);
    Route::get('/admin/mentors', [AdminController::class, 'mentorList']);
    Route::get('/admin/ajax-mentor-data', [AdminController::class, 'ajaxMentorData']);

    // admin moderator routes starts here
    Route::get('admin/add-moderator', function () {
        return view('pages.Admin.add-moderator');
    });
    Route::get('admin/add-advertisment', function () {
        return view('pages.Admin.add-advertisment');
    });
    Route::post('/admin/add-advertisment', [AdminController::class, 'addAdvertisment']);
    Route::post('/admin/add-moderator', [AdminController::class, 'addModerator']);
    Route::get('/admin/edit-moderator/{id}', [AdminController::class, 'editModerator']);
    Route::get('/admin/delete-moderator/{id}', [AdminController::class, 'deleteModerator']);
    Route::get('/admin/view-moderator/{id}', [AdminController::class, 'viewModerator']);
    Route::post('/admin/edit-moderator/{id}', [AdminController::class, 'updateModerator']);
    Route::get('/admin/moderators', [AdminController::class, 'moderatorList']);
    Route::get('/admin/ajax-moderator-data', [AdminController::class, 'ajaxModeratorData']);
    Route::get('/admin/advertisment', [AdminController::class, 'advertisment']);
    Route::get('/admin/edit-moderator/{id}', [AdminController::class, 'editModerator']);
   
    Route::get('/admin/edit-advertisment/{id}', [AdminController::class, 'editAdvertisment']);
    Route::post('/admin/edit-advertisment/{id}', [AdminController::class, 'updateAdvertisment']);
    Route::get('/admin/delete-advertisment/{id}', [AdminController::class, 'deleteAdvertisment']);
  
    // Route::get('/admin/advertisment', [AdminController::class, 'advertismentList']);

    //admin content approval routes
    Route::get('/admin/content-approval/{content_type?}/{status?}', [AdminController::class, 'contentApprovalList']);
    Route::get('/admin/content-approval1/detail/{id}', [AdminController::class, 'contentApprovalDetail']);
    Route::get('/admin/content-approval1/question-detail/{id}', [AdminController::class, 'contentApprovalQuestionDetail']);
    Route::get('/admin/content-approval1/approve/{id}', [AdminController::class, 'contentApprovePost']);
    Route::get('/admin/content-approval1/approve', [AdminController::class, 'contentApprove']);
    Route::get('/admin/content-approval1/disapprove/{id}', [AdminController::class, 'contentDisapprovePost']);
    Route::get('/admin/content-approval1/disapprove', [AdminController::class, 'contentDisapprove']);
    Route::get('/admin/content-approval1/approve-question', [AdminController::class, 'contentApproveQuestion']);
    Route::get('/admin/content-approval1/approve-question/{id}', [AdminController::class, 'contentApproveQuestion2']);
    Route::get('/admin/content-approval1/disapprove-question', [AdminController::class, 'contentDisapproveQuestion']);
    Route::get('/admin/content-approval1/disapprove-question/{id}', [AdminController::class, 'contentDisapproveQuestion2']);
    Route::get('/admin/content-approval1/approve-comment', [AdminController::class, 'contentApproveComment']);
    Route::get('/admin/content-approval1/disapprove-comment', [AdminController::class, 'contentDisapproveComment']);
    Route::get('/admin/ajax-content-data', [AdminController::class, 'ajaxContentData']);
    Route::get('/admin/ajax-content-data1', [AdminController::class, 'ajaxContentData1']);
  
    Route::get('/admin/content-approval1/delete', [AdminController::class, 'deletePost']);
    Route::get('/admin/content-approval1/delete-question', [AdminController::class, 'deleteQuestion']);
    Route::get('/admin/content-approval1/delete-comment', [AdminController::class, 'deleteComment']);
    Route::get('/admin/serniormentor', [AdminController::class, 'serniorMentor']); 
   
    Route::get('/mentor/post/{content_type?}/{status?}', [AdminController::class, 'MentorList2']);
   
    //student routes
    Route::get('/student/home', [StudentController::class, 'home']);
    Route::get('/student/profile', [StudentController::class, 'profile']);
    Route::post('/student/profile', [StudentController::class, 'updateprofile']);
    Route::get('/student/mentors', [StudentController::class, 'studentMentors']);
    Route::get('/student/question-answers', [StudentController::class, 'getQuestionAnswer']);
    Route::get('/student/mentor/post/{id}', [StudentController::class, 'mentorPost']);
    Route::get('/student/mentor/follow/{id}', [StudentController::class, 'mentorFollow']);
    Route::get('/student/mentor/unfollow/{id}', [StudentController::class, 'mentorUnfollow']);
    Route::post('/student/submit-question', [StudentController::class, 'submitQuestion']);
    Route::post('/student/ajax-load-more-post', [StudentController::class, 'ajaxLoadMorePost']);

    Route::post('/student/ajax-load-more-post-mentor', [StudentController::class, 'ajaxLoadMorePostMentor']);
    Route::post('/student/ajax-like-post', [StudentController::class, 'ajaxLikePost']);
    Route::post('/student/ajax-load-post-comments', [StudentController::class, 'ajaxLoadPostComments']);
    Route::post('/student/ajax-submit-comment', [StudentController::class, 'ajaxSubmitComment']);


    //mentors routes starts here
    // Route::get('/mentor/home/{content_type?}/{status?}', [MentorController::class, 'home2']);
   
    Route::get('/mentor/home', [MentorController::class, 'home']);
    Route::post('/mentor/ajax-load-more-post', [MentorController::class, 'ajaxLoadMentorMorePost']);
    Route::post('/mentor/ajax-load-more-post-mentor', [MentorController::class, 'ajaxLoadMorePostMentor']);
    Route::get('/mentor/profile', [MentorController::class, 'profile']);
    Route::post('/mentor/profile', [MentorController::class, 'updateprofile']);
    Route::post('/mentor/publish-post', [MentorController::class, 'publishPost']);
    Route::post('/mentor/get-pending-questions', [MentorController::class, 'getPendingQuestion']);
    Route::post('/mentor/get-answered-questions', [MentorController::class, 'getAnsweredQuestion']);
    Route::post('/mentor/submit-answer', [MentorController::class, 'submitAnswer']);
    Route::post('/mentor/upload-photo', [MentorController::class, 'uploadPhoto']);

    Route::get('/check-duplicate-email', [UserController::class, 'checkDuplicateEmail']);
    Route::get('/check-current-password', [UserController::class, 'checkCurrentPassword']);
});

Route::post('/api/register', [UserController::class, 'register']);
Route::get('/set-password', [UserController::class, 'setPassword']);

Route::post('/set-password', [UserController::class, 'resetPassword']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
// Route::get('/', function () {
//     return view('pages.home');
// });
Route::get('/', [HomeController::class, 'home']);

Route::get('/forgot-password', function () {
    return view('pages.forgot-password');
});

Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/dashboard', function () {
    return view('pages.student.dashboard');
});
Route::get('/home', function () {
    return view('pages.student.home');
});
Route::get('/student-profile', function () {
    return view('pages.student.student-profile');
});
Route::get('/admin', function () {
    return view('pages.Admin.login');
}); 

Route::get('admin/content-approval1', function () {
    return view('pages.Admin.content-approval');
});

Route::get('mentor/contact', function () {
    return view('pages.mentor.contact_info');
});
Route::get('mentor/post', function () {
    return view('pages.mentor.post');
});

Route::get('mentor/login', function () {
    return view('pages.mentor.login');
});
Route::get('mentor/gallery-photos', function () {
    return view('pages.mentor.gallery-photos');
});
Route::get('mentor/followers', function () {
    return view('pages.mentor.followers');
});
Route::get('mentor/feedback', function () {
    return view('pages.mentor.questionanswer');
});

Route::get('/admin/add-vedio', [AdminController::class, 'addVedioForm']);
  Route::get('/admin/Video-Conference/list', [AdminController::class, 'vedlistt']);
 Route::post('admin/save_vedio',[AdminController::Class,'save_vedio']);
// Route::get('/status-update/{id}',[AdminController::Class,'status_update']);
Route::post('/admin/Video-Conference/list',[AdminController::class, 'vedlistt']);
Route::get('/admin/Video-Conference/approve', [AdminController::class, 'VideoApprove']);
Route::get('/admin/Video-Conference/disapprove', [AdminController::class, 'Videodisapprove']);
Route::get('/admin/Video-Con/list', [AdminController::class, 'Videostudent']);

// Route::get('/create-custom-log', function () {
  
//     Log::channel('itsolution')->info('This is testing for ItSolutionStuff.com!');
//     dd('done');
     
// });

/**
* Created route for single user functionality
* Created on 2024-09-21
* Created by Ganesh 
*/

Route::get('checkUserAvailable', [UserController::class, 'checkUserAvailable']);
Route::post('validateUser', [UserController::class, 'validateUser']);
Route::post('createUser', [UserController::class, 'createUser']);
Route::post('validateOrCreateUser', [UserController::class, 'validateOrCreateUser']);
