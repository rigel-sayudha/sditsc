
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TestScheduleController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/timezone', function(){
    return config('app.timezone');
});
// Login routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');
// Admin routes with auth middleware
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Kotak Saran Admin
    Route::get('/kotak-saran', [\App\Http\Controllers\Admin\KotakSaranAdminController::class, 'index'])->name('admin.kotak-saran');
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Hapus/komentar dashboard
    Route::get('/', [AdminController::class, 'articles'])->name('admin.home'); // Default ke berita

    // Article Management Routes
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class, [
        'as' => 'admin'
    ]);

    // Ekstrakurikuler Management Routes
    Route::resource('ekstrakurikuler', \App\Http\Controllers\EkstrakurikulerController::class, [
        'as' => 'admin'
    ]);

    Route::get('/announcements', [AdminController::class, 'announcements'])->name('admin.announcements');
    Route::get('/registrations', [AdminController::class, 'registrations'])->name('admin.registrations');
    Route::get('/organization', [AdminController::class, 'organization'])->name('admin.organization');
    Route::put('/organization', [AdminController::class, 'updateOrganization'])->name('admin.organization.update');
    Route::get('/leaderboard', [AdminController::class, 'leaderboard'])->name('admin.leaderboard');
    // Edit nilai tes siswa (harus di dalam group agar prefix 'admin.' aktif)
    Route::get('/registrations/{id}/edit-tes', [AdminController::class, 'editTes'])->name('admin.editTes');
    Route::put('/registrations/{id}/update-tes', [AdminController::class, 'updateTes'])->name('admin.updateTes');
    Route::get('/print-registration/{id}', [AdminController::class, 'printRegistration'])->name('admin.printRegistration');
    Route::get('/leaderboard/export', [AdminController::class, 'exportAcceptedRegistrations'])->name('admin.leaderboard.export');
    Route::post('/loloskan/{id}', [AdminController::class, 'loloskanSiswa'])->name('admin.loloskan');
    Route::post('/belumloloskan/{id}', [AdminController::class, 'belumLoloskanSiswa'])->name('admin.belumloloskan');

    // Profil Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Sambutan Kepala Sekolah (Admin)
    Route::resource('sambutan', \App\Http\Controllers\SambutanController::class, [
        'as' => 'admin'
    ]);

    // Pendaftaran Admin Routes
    // Pendaftaran Admin Routes
    Route::resource('pendaftaran', \App\Http\Controllers\PendaftaranController::class, [
        'as' => 'admin'
    ]);

    // Poster Pop-up CRUD
    Route::resource('poster', \App\Http\Controllers\Admin\PosterController::class, [
        'as' => 'admin'
    ]);

    // Poster activate/deactivate
    Route::post('poster/{poster}/activate', [\App\Http\Controllers\Admin\PosterController::class, 'activate'])->name('admin.poster.activate');
    Route::post('poster/{poster}/deactivate', [\App\Http\Controllers\Admin\PosterController::class, 'deactivate'])->name('admin.poster.deactivate');

    // Galeri Admin CRUD
    Route::resource('galeri', \App\Http\Controllers\Admin\GaleriController::class, [
        'as' => 'admin'
    ]);

    // Test Schedule Management Routes
    Route::resource('test-schedules', \App\Http\Controllers\Admin\TestScheduleController::class, [
        'as' => 'admin'
    ]);
    Route::get('test-schedules-calendar', [\App\Http\Controllers\Admin\TestScheduleController::class, 'calendar'])->name('admin.test-schedules.calendar');
    Route::patch('test-schedules/{testSchedule}/toggle-status', [\App\Http\Controllers\Admin\TestScheduleController::class, 'toggleStatus'])->name('admin.test-schedules.toggle-status');

    Route::get('/print-accepted-registrations', [App\Http\Controllers\AdminController::class, 'printAcceptedRegistrations'])->name('admin.printAcceptedRegistrations');

    // Hapus satu data siswa
    Route::delete('/registrations/{id}', [App\Http\Controllers\AdminController::class, 'deleteRegistration'])->name('admin.registrations.destroy');
    // Hapus semua data siswa
    Route::delete('/registrations', [App\Http\Controllers\AdminController::class, 'deleteAllRegistrations'])->name('admin.registrations.deleteAll');
});

// Registration route
// Auth routes (removed problematic register route)
Route::post('/kotak-saran', [App\Http\Controllers\KotakSaranController::class, 'store'])->name('kotak-saran.store');

// Struktur Organisasi route
Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi');

// Pendaftaran routes
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// Debug route
Route::post('/test-submit', function(\Illuminate\Http\Request $request) {
    return response()->json([
        'message' => 'Form data received',
        'step' => $request->query('step'),
        'data' => $request->all()
    ]);
});

Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])->name('pendaftaran.success');

// Demo Weekend Logic
Route::get('/demo-weekend', function() {
    return view('demo-weekend');
})->name('demo-weekend');

Route::get('/hasil-seleksi', [PendaftaranController::class, 'selectionResults'])->name('hasil-seleksi');

Route::get('/soal-test', [PendaftaranController::class, 'index'])->name('soal-test');

Route::post('/api/chat', [ChatController::class, 'chat'])->name('api.chat');

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

// Artikel Management Routes (Public)
Route::resource('artikel', ArticleController::class, [
    'names' => [
        'index' => 'artikel.index',
        'show' => 'artikel.detail',
        'create' => 'artikel.create',
        'store' => 'artikel.store',
        'edit' => 'artikel.edit',
        'update' => 'artikel.update',
        'destroy' => 'artikel.destroy'
    ]
]);

Route::get('/jadwal-tes', [App\Http\Controllers\TestSchedulePublicController::class, 'index'])->name('jadwal-tes.index');
Route::get('/api/available-schedules', [App\Http\Controllers\TestSchedulePublicController::class, 'getAvailableSchedules'])->name('api.available-schedules');

Route::get('/test-images-debug', function() {
    $articles = App\Models\Article::select('id', 'judul', 'gambar')->get();
    return view('test-images-debug', compact('articles'));
});

// Galeri Route
Route::get('/galeri', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.index');

// Galeri Publik
Route::get('/galeri', [\App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.index');

