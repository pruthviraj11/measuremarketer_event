<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventRegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegisterUsersController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MessageController;








use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;


/*
|--------------------------------------------------------------------------
| Web Routesf
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
Route::get('/admin', function () {
    return redirect('/login');
});

Route::get('/', function () {
    return view('users_login');
})->name('index');



// Route::get('/', function () {
//     return view('index');
// })->name('index');

// Route::get('/join_event', function () {
//     return view('join_event');
// })->name('join_event');

Route::get('/join_event', [EventRegisterController::class, 'showJoinEventForm'])->name('join_event');


Route::get('/users_welcome', function () {
    return view('users_welcome');
})->name('users_welcome');



// Route::get('/users_login', function () {
//     return view('users_login');
// })->name('users_login');


Route::get('/password_request', function () {
    return view('password_request');
})->name('password_request');


Route::get('/profile/edit', [EventRegisterController::class, 'editProfile'])->name('profile.edit');

// Handle the profile update

Route::get('/profile', [EventRegisterController::class, 'ProfileButton'])->name('profile.view');

Route::post('/profile/update', [EventRegisterController::class, 'updateProfile'])->name('profile.update');


Route::post('/send-message', [EventRegisterController::class, 'sendMessage'])->name('send_message');
// Show the form for adding guests
Route::get('/add-guests', [EventRegisterController::class, 'showFormGuests'])->name('add.guests');
Route::get('/list-guests', [EventRegisterController::class, 'listGuests'])->name('list.guests');
Route::delete('/guests/{id}/delete', [EventRegisterController::class, 'deleteGuest'])->name('guests.delete');
Route::get('/list-attending', [EventRegisterController::class, 'listEventAttending'])->name('list.attending');





// Store the guests
Route::post('/add-guests', [EventRegisterController::class, 'storeGuests'])->name('store.guests');

Route::post('event-registration', [EventRegisterController::class, 'store'])->name('event.register');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/users_login', [LoginController::class, 'checkLogin'])->name('users_login');
Route::post('/reset_password', [LoginController::class, 'resetPassword'])->name('users_reset_password');



Route::post('/login', [LoginController::class, 'login']);
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::any('/userlogout', [LoginController::class, 'userlogout'])->name('userlogout');

// Forgot Password routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/registered/event', [EventRegisterController::class, 'RegisterdEvent'])->name('registerd_event');


Route::get('/event/messages', [EventRegisterController::class, 'EventMessage'])->name('event_messages');



Route::post('/send-message', [EventRegisterController::class, 'sendMessage'])->name('sendMessage');

Route::get('/community/view/{encryptedId}', [EventRegisterController::class, 'view'])->name('community.view');
Route::get('/view-contact-person/{encryptedId}', [EventRegisterController::class, 'getContactPerson'])->name('get_contact_person');


// for QR code
Route::get('/get-qr-code/{encryptedId}', [EventRegisterController::class, 'userQrCode'])->name('get-qr-code');

Route::get('/messages/view/{encryptedId}', [EventRegisterController::class, 'eventViewMessages'])->name('event_messages.view');

// Reset Password routes
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::group(['prefix' => 'auth'], function () {
    Route::get('login-basic', [AuthenticationController::class, 'login_basic'])->name('auth-login-basic');
    Route::get('login-cover', [AuthenticationController::class, 'login_cover'])->name('auth-login-cover');
    Route::get('register-basic', [AuthenticationController::class, 'register_basic'])->name('auth-register-basic');
    Route::get('register-cover', [AuthenticationController::class, 'register_cover'])->name('auth-register-cover');
    Route::get('forgot-password-basic', [AuthenticationController::class, 'forgot_password_basic'])->name('auth-forgot-password-basic');
    Route::get('forgot-password-cover', [AuthenticationController::class, 'forgot_password_cover'])->name('auth-forgot-password-cover');
    Route::get('reset-password-basic', [AuthenticationController::class, 'reset_password_basic'])->name('auth-reset-password-basic');
    Route::get('reset-password-cover', [AuthenticationController::class, 'reset_password_cover'])->name('auth-reset-password-cover');
    Route::get('verify-email-basic', [AuthenticationController::class, 'verify_email_basic'])->name('auth-verify-email-basic');
    Route::get('verify-email-cover', [AuthenticationController::class, 'verify_email_cover'])->name('auth-verify-email-cover');
    Route::get('two-steps-basic', [AuthenticationController::class, 'two_steps_basic'])->name('auth-two-steps-basic');
    Route::get('two-steps-cover', [AuthenticationController::class, 'two_steps_cover'])->name('auth-two-steps-cover');
    Route::get('register-multisteps', [AuthenticationController::class, 'register_multi_steps'])->name('auth-register-multisteps');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
});




Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
    Route::get('permissions', [RoleController::class, 'permissions_list'])->name('app-permissions-list');
    Route::get('roles/list', [RoleController::class, 'index'])->name('app-roles-list');
    Route::get('send/mail', [MailController::class, 'sendMail'])->name('send-mail');


    Route::get('/profile/{encrypted_id}', [UsersController::class, 'profile'])->name('profile.show');
    Route::post('/profile/update/{encrypted_id}', [UsersController::class, 'updateProfile'])->name('profile-update');

    // =============================================================================================================================

    //   ROLE AND USER CONTROLLER

    // =============================================================================================================================

    // Roles Start
    Route::get('roles/list', [RoleController::class, 'index'])->name('app-roles-list');
    Route::get('roles/getAll', [RoleController::class, 'getAll'])->name('app-roles-get-all');
    Route::post('roles/store', [RoleController::class, 'store'])->name('app-roles-store');
    Route::get('roles/add', [RoleController::class, 'create'])->name('app-roles-add');
    Route::get('roles/edit/{encrypted_id}', [RoleController::class, 'edit'])->name('app-roles-edit');
    Route::put('roles/update/{encrypted_id}', [RoleController::class, 'update'])->name('app-roles-update');
    Route::get('roles/destroy/{encrypted_id}', [RoleController::class, 'destroy'])->name('app-roles-delete');
    /* Roles Routes End */

    //User start
    Route::get('users/list', [UsersController::class, 'index'])->name('app-users-list');
    Route::get('users/add', [UsersController::class, 'create'])->name('app-users-add');
    Route::post('users/store', [UsersController::class, 'store'])->name('app-users-store');
    Route::get('users/edit/{encrypted_id}', [UsersController::class, 'edit'])->name('app-users-edit');
    Route::put('users/update/{encrypted_id}', [UsersController::class, 'update'])->name('app-users-update');
    Route::get('users/destroy/{encrypted_id}', [UsersController::class, 'destroy'])->name('app-users-destroy');
    Route::get('users/getAll', [UsersController::class, 'getAll'])->name('app-users-get-all');
    //User End

    //Event start
    Route::get('event/list', [EventController::class, 'index'])->name('app-event-list');
    Route::get('event/getAll', [EventController::class, 'getAll'])->name('app-event-get-all');
    Route::get('event/destroy/{encrypted_id}', [EventController::class, 'destroy'])->name('app-event-destroy');

    Route::get('event/registered/{encrypted_id}', [RegisterUsersController::class, 'UserRegistered'])->name('app-event-registers-users');
    Route::get('event/registered/getAllRegistered/{encrypted_id}', action: [RegisterUsersController::class, 'getAllRegistered'])->name('app-event-all-registers-users-lists');
    Route::get('event/registered/views/{encrypted_id}', [RegisterUsersController::class, 'ViewRegisteredUser'])->name('app-event-user-registered-views');
    Route::get('event/registered/destroy/{encrypted_id}', [RegisterUsersController::class, 'RegisteredUserDestroy'])->name('app-event-user-registered-delete');



    Route::get('event/guests/{encrypted_id}', [GuestController::class, 'RegisteredGuests'])->name('app-event-registers-guests');
    Route::get('event/guests/getAllRegisteredGuests/{encrypted_id}', action: [GuestController::class, 'getAllRegisteredGuests'])->name('app-event-all-registers-guests-lists');



    Route::get('event/messages/{encrypted_id}', [MessageController::class, 'ViewUserMessages'])->name('app-event-user-views-messages');
    Route::get('event/registered/messages_all/{encrypted_id}', [MessageController::class, 'ViewAllUserMessages'])->name('app-event-user-views-all-messages');
    Route::get('event/registered/chat_details/{encryptedId}/{userId}', [MessageController::class, 'ViewUserChatMessages'])->name('app-event-user-chat-messages');





    // Route::get('event/registered/user_messages/{encrypted_id}', [EventController::class, 'SendMessagesUser'])->name('app-event-registers-guests');

    // Route::get('event/add', [EventController::class, 'create'])->name('app-event-add');

    // Route::post('event/store', [EventController::class, 'store'])->name('app-event-store');
    // Route::get('event/edit/{encrypted_id}', [EventController::class, 'edit'])->name('app-event-edit');
    // Route::put('event/update/{encrypted_id}', [EventController::class, 'update'])->name('app-event-update');
    // Route::get('event/destroy/{encrypted_id}', [EventController::class, 'destroy'])->name('app-event-destroy');

    //Event End





});
/* Route Apps */
