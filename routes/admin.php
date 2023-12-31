<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminShuhoController;

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
// グループ退出機能(管理者)
Route::get('shuhos/evictAdmin/{id}', [AdminShuhoController::class, 'evictAdmin'])
    ->name('shuhos.evictAdmin');

// グループ退出機能(メンバー)
Route::get('shuhos/evictMember/{id}', [AdminShuhoController::class, 'evictMember'])
    ->name('shuhos.evictMember');

// ナビゲーションよりmember押下時
Route::get('shuhos/memberList', [AdminShuhoController::class, 'memberList'])
    ->name('shuhos.memberList');

// ナビゲーションよりinvite押下時
Route::get('shuhos/invite', [AdminShuhoController::class, 'invite'])
    ->name('shuhos.invite');

// グループ招待ボタン押下時
Route::post('shuhos/inviterun', [AdminShuhoController::class, 'inviteRun'])
    ->name('shuhos.inviterun');

// ナビゲーションよりgroup押下時
Route::get('shuhos/group', [AdminShuhoController::class, 'group'])
    ->name('shuhos.group');

// グループ作成ボタン押下時
Route::post('shuhos/groupcreation', [AdminShuhoController::class, 'groupcreation'])
    ->name('shuhos.groupcreation');

Route::resource('shuhos', AdminShuhoController::class);

Route::get('/', function () {
    return view('admin.welcome');
});

// 管理者用 承認機能ルート
// 詳細画面からのアクション
Route::get('shuhos/check/{id}', [AdminShuhoController::class, 'checkShuho'])
    ->name('shuhos.check');
// メイン画面からの簡易アクション
Route::post('shuhos/checkSub/{id}', [AdminShuhoController::class, 'checkShuhoSub'])
    ->name('shuhos.checkSub');

// 管理者用 コメント機能ON
Route::get('shuhos/comment/{id}', [AdminShuhoController::class, 'comment'])
    ->name('shuhos.comment');
// 管理者用 コメント入力更新
Route::put('shuhos/commentUpdate/{id}', [AdminShuhoController::class, 'commentUpdate'])
    ->name('shuhos.commentUpdate');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admins'])->name('dashboard');


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth:admins')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

