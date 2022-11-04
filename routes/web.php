<?php

use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome', ['title' => 'Praktikum']);
// });

// Route::get('/', function () {
//     return view('home', [ 
//         'title' => 'Praktikum',
//         "prodis" => [
//             [
//                 "logo" => "bi-emoji-smile-upside-down",
//                 "nama" => "Informatika",
//                 "fakultas" => "Teknik"
//             ],
//             [
//                 "logo" => "bi-emoji-smile",
//                 "nama" => "Akuntansi",
//                 "fakultas" => "Ekonomi Dan Bisnis"
//             ],
//             [
//                 "logo" => "bi-emoji-sunglasses",
//                 "nama" => "Fisika",
//                 "fakultas" => "Matematika dan Ilmu Pengetahuan Alam"
//             ]
//         ]
//     ]);
// });

Route::get('/', function () {
    return view('home', [
        'title' => 'Praktikum',
        'prodis' => Prodi::all(),
        'mahasiswas' => Mahasiswa::all()
    ]);
})->middleware(['auth']);

Route::get('/login', function () {  return 'Halaman Login'; })->name('login');

Route::get('/user/{nama}', function ($name) {
    return view('user', ['name' => $name]);
});

Route::get('/register', function () { 
    return view('register'); 
})->name('register');

Route::POST('/action-register', 
    [AuthController::class, 'actionRegister']
);

Route::get('/login', [AuthController::class, 'loginView'])->name("login");

Route::POST('/action-login', 
    [AuthController::class, 'actionLogin']
);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store')->middleware('auth');
Route::get('/mahasiswa/show/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show')->middleware('auth');
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit')->middleware('auth');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update')->middleware('auth');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete')->middleware('auth');
