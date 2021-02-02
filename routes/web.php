<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard2Controller;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\ProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\Dashboard1Controller::class, 'index'])->name('home');
Route::get('/detailBerita', 'Dashboard1Controller@lihatBerita');
Route::get('/detailKegiatan/{id}', 'Dashboard1Controller@lihatKegiatan');
Route::post('/detailKegiatan', 'Dashboard1Controller@addKehadiran');
Route::delete('/detailKegiatan/{id}', 'Dashboard1Controller@deleteKehadiran');
Route::get('/detailPengumuman/{id}', 'Dashboard1Controller@lihatPengumuman');
Route::get('/lihatBerita/{id}', 'Dashboard1Controller@lihatBerita');
Route::get('profiles', [App\Http\Controllers\ProfileController::class, 'index'])->name('profiles');  
Route::put('profile/updateprofile/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile']);     
Route::put('profile/updatepassword/{id}', [App\Http\Controllers\ProfileController::class, 'updatePassword']);

Route::group(['middleware' => ['is_admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('home', [Dashboard2Controller::class, 'index'])->name('loginHome');
        Route::resource('account', 'AccountController');
        Route::get('/detailRealisasi/export_excel', 'DetailRealisasiController@export_excel');
        Route::get('/detailWifi/export_excel', 'DetailWifiController@export_excel');
        Route::get('/realisasiTarget/export_excel', 'RealisasiTargetController@export_excel');
        Route::resource('/detailRealisasi', 'DetailRealisasiController');
        Route::resource('/detailWifi', 'DetailWifiController');
        Route::resource('/realisasiTarget', 'RealisasiTargetController');
        Route::get('/realisasiTarget/{id}', 'RealisasiTargetController@show');
        // Route::resource('profile','ProfileController');
        Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');  
        Route::put('profile/updateprofile/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile']);     
        Route::put('profile/updatepassword/{id}', [App\Http\Controllers\ProfileController::class, 'updatePassword']);
        Route::resource('/maps','MapsController');
        Route::delete('/active/{id}', 'MapsController@active');
        Route::resource('/sekolah', 'SekolahController');
        Route::resource('/layanan', 'JenisLayananController');
        Route::resource('/fasilitas', 'JenisFasilitasController');
        Route::resource('/kabupaten','KabupatenController');
        Route::resource('/kelurahan','KelurahanController');
        Route::resource('/kecamatan','KecamatanController');
        Route::resource('/anggota','AnggotaController');
        Route::put('/anggotaSet/{id}','AnggotaController@anggotaSet');
        Route::put('/pengurusSet/{id}','AnggotaController@pengurusSet');
        Route::resource('/pengumuman','PengumumanController');
        Route::resource('/kegiatan','KegiatanController');
        Route::post('/addPengumuman', 'KegiatanController@storePengumuman');
        Route::put('/kegiatans/{id}', 'KegiatanController@updateKehadiran');
        Route::get('/kegiatans/{id}', 'KegiatanController@showEdit');
        Route::resource('/berita','BeritaController');
        Route::delete('/hapusGambar/{id}', 'KegiatanController@destroyGambarKegiatan');
        Route::put('/gantiDokumen/{id}', 'KegiatanController@gantiDokumen');
    });
});

Route::group(['middleware' => ['is_pengurus']], function () {
    Route::get('home2', [Dashboard2Controller::class, 'index'])->name('loginHome2');
    Route::resource('account', 'AccountController');
    Route::get('/detailRealisasi/export_excel', 'DetailRealisasiController@export_excel');
    Route::get('/detailWifi/export_excel', 'DetailWifiController@export_excel');
    Route::get('/realisasiTarget/export_excel', 'RealisasiTargetController@export_excel');
    Route::resource('/detailRealisasi', 'DetailRealisasiController');
    Route::resource('/detailWifi', 'DetailWifiController');
    Route::resource('/realisasiTarget', 'RealisasiTargetController');
    Route::get('/realisasiTarget/{id}', 'RealisasiTargetController@show');
    // Route::resource('profile','ProfileController');
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');  
    Route::put('profile/updateprofile/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile']);     
    Route::put('profile/updatepassword/{id}', [App\Http\Controllers\ProfileController::class, 'updatePassword']);
    Route::resource('/maps','MapsController');
    Route::delete('/active/{id}', 'MapsController@active');
    Route::resource('/sekolah', 'SekolahController');
    Route::resource('/layanan', 'JenisLayananController');
    Route::resource('/fasilitas', 'JenisFasilitasController');
    Route::resource('/kabupaten','KabupatenController');
    Route::resource('/kelurahan','KelurahanController');
    Route::resource('/kecamatan','KecamatanController');

    Route::resource('/pengumuman','PengumumanController');
    Route::resource('/kegiatan','KegiatanController');
    Route::post('/addPengumuman', 'KegiatanController@storePengumuman');
    Route::put('/kegiatans/{id}', 'KegiatanController@updateKehadiran');
    Route::get('/kegiatans/{id}', 'KegiatanController@showEdit');
    Route::resource('/berita','BeritaController');
    Route::delete('/hapusGambar/{id}', 'KegiatanController@destroyGambarKegiatan');
    Route::put('/gantiDokumen/{id}', 'KegiatanController@gantiDokumen');
    
});


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
