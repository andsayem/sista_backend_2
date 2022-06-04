<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);


    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
        Route::post('user', [App\Http\Controllers\AuthController::class, 'user']);
       
        Route::post('change-password', [App\Http\Controllers\AuthController::class, 'change_password']);
       
    });
});
Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
Route::get('users_search/{key}', [App\Http\Controllers\API\UserAPIController::class,'users_search']);
Route::group([
    'middleware' => 'auth:api'
], function () {


    Route::get('user_profile/{id}', [App\Http\Controllers\API\UserAPIController::class, 'user_profile']);
    Route::post('change-profile-image', [App\Http\Controllers\API\UserAPIController::class, 'change_profile_image']);

    Route::resource('post_datas', App\Http\Controllers\API\PostDataAPIController::class);
    Route::get('singelpost/{id}', [App\Http\Controllers\API\PostDataAPIController::class,'singelpost']);

    Route::resource('files_paths', App\Http\Controllers\API\FilesPathAPIController::class);

    Route::resource('all_comments', App\Http\Controllers\API\AllCommentAPIController::class);

    Route::resource('all_likes', App\Http\Controllers\API\AllLikeAPIController::class);

    Route::get('postlike/{id}', [App\Http\Controllers\API\AllLikeAPIController::class, 'postlike']);
    Route::get('commentlike/{id}', [App\Http\Controllers\API\AllLikeAPIController::class, 'commentlike']);

    Route::get('user_info', [App\Http\Controllers\API\UserAPIController::class, 'userInfo']);
    
    Route::get('conversation_list', [App\Http\Controllers\API\ConversationAPIController::class, 'conversation_list']);
    Route::post('new_conversation', [App\Http\Controllers\API\ConversationAPIController::class, 'newConversation']);

    Route::resource('conversations', App\Http\Controllers\API\ConversationAPIController::class); 
    Route::get('user_conversations', [App\Http\Controllers\API\ConversationAPIController::class,'user_conversations']); 
    Route::resource('events', App\Http\Controllers\API\EventAPIController::class); 
    Route::resource('journals', App\Http\Controllers\API\JournalAPIController::class);
    Route::resource('followings', App\Http\Controllers\API\FollowingAPIController::class);
    Route::get('following/{id}', [App\Http\Controllers\API\FollowingAPIController::class,'following']);
    Route::resource('supports', App\Http\Controllers\API\SupportAPIController::class); 
    Route::resource('post_reports', App\Http\Controllers\API\PostReportAPIController::class); 
    Route::resource('post_not_interesteds', App\Http\Controllers\API\PostNotInterestedAPIController::class);  
    Route::resource('event_register', App\Http\Controllers\API\EventRegisterAPIController::class);

});

//Route::get('commentlike/{id}', [App\Http\Controllers\API\AllLikeAPIController::class, 'commentlike']);
Route::resource('post_categories', App\Http\Controllers\API\PostCategoryAPIController::class);
Route::resource('postdatas', App\Http\Controllers\API\PostDataAPIController::class);

Route::resource('tests', App\Http\Controllers\API\TestAPIController::class);

Route::post('forgot-password', [App\Http\Controllers\AuthController::class, 'forgot_password']);
Route::post('varify-password-otp', [App\Http\Controllers\AuthController::class, 'varifyPasswordOtp']);
Route::post('password-reset', [App\Http\Controllers\AuthController::class, 'resetPassword']);

Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'email']);
Route::post('password/email_verifier', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'email_verifier']);
//Route::post('video-upload', [App\Http\Controllers\API\PostDataAPIController::class, 'videoUpload']);
Route::post('video-upload', [App\Http\Controllers\API\PostDataAPIController::class, 'videoStore']);





Route::resource('product_categories', App\Http\Controllers\API\ProductCategoryAPIController::class);


Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);


Route::resource('product_files', App\Http\Controllers\API\ProductFileAPIController::class);

//Route::post('test', App\Http\Controllers\API\ProductFileAPIController::class);

Route::get('test_message', [App\Http\Controllers\API\ConversationAPIController::class, 'test_message']);

Route::get('testPusher', [App\Http\Controllers\API\PostDataAPIController::class, 'testPusher']);
Route::get('test_chart', [App\Http\Controllers\API\ConversationAPIController::class, 'test_chart']);
Route::resource('support_types', App\Http\Controllers\API\SupportTypeAPIController::class);
 
//Route::resource('supports', App\Http\Controllers\API\SupportAPIController::class);




Route::resource('notifications', App\Http\Controllers\API\NotificationAPIController::class);
