<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DownloadCategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPictureController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PromkesController;
use App\Http\Controllers\RequestOnlineInformationController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Visitor\BerandaController;
use App\Models\Bed;
use App\Models\Event;
use App\Models\Post;
use App\Models\Promkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Beranda Route
// Route::get('/', function () {
//     return view('visitor.beranda.beranda');
// });

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Tentang Kami Route
Route::get('/profil', function () {
    return view('visitor.tentang-kami.profil');
});
Route::get('/sejarah', function () {
    return view('visitor.tentang-kami.sejarah');
});
Route::get('/mantan-direktur', function () {
    return view('visitor.tentang-kami.mantan-direktur');
});
Route::get('/visi-misi', function () {
    return view('visitor.tentang-kami.visi-misi');
});
Route::get('/struktur-organisasi', function () {
    return view('visitor.tentang-kami.struktur-organisasi');
});
Route::get('/direksi-manajemen', function () {
    // return view('visitor.tentang-kami.direksi-manajemen');
    return view('visitor.tentang-kami.direksi-manajemen');
});
Route::get('/manajer-ruangan-instalasi', function () {
    return view('visitor.tentang-kami.manajer-ruangan-instalasi');
});
Route::get('/gambaran-umum', function () {
    // return view('visitor.tentang-kami.gambaran-umum');
    return view('visitor.maintenance.under-construction');
});


//Fasilitas dan Pelayanan Route
Route::get('/rawat-jalan', function () {
    return view('visitor.fasilitas.rawat-jalan');
});
Route::get('/jadwal-poliklinik', function () {
    return view('visitor.fasilitas.jadwal-poliklinik');
});
Route::get('/rawat-inap', function () {
    return view('visitor.maintenance.under-construction');
});
Route::get('/alur-pelayanan', function () {
    return view('visitor.fasilitas.alur-pelayanan');
});
Route::get('/pelayanan-penunjang', function () {
    return view('visitor.maintenance.under-construction');
});
Route::get('/medical-check-up', function () {
    return view('visitor.maintenance.under-construction');
});
Route::get('/ketersediaan-tempat-tidur', [BedController::class, 'indexBed']);
Route::get('/tarif-pelayanan', [TreatmentController::class, 'indexTreatment']);
Route::get('/tarif-pelayanan/{id}', [TreatmentController::class, 'showTreatment']);

Route::get('/promosi-kesehatan', [PromkesController::class, 'indexPromkes']);
Route::get('/tata-tertib', function () {
    return view('visitor.fasilitas.tata-tertib');
});
Route::get('/dokter-spesialis', function () {
    return view('visitor.fasilitas.dokter-spesialis');
});
Route::get('/dokter-umum', function () {
    return view('visitor.fasilitas.dokter-umum');
});

// Informasi Route
// Informasi Artikel Route
Route::get('/artikel', [ArticleController::class, 'indexArtikel'])->name('artikel');
Route::get('/artikel/autocomplete', [ArticleController::class, 'autocompleteSearch'])->name('artikel.autocomplete');
Route::get('/artikel/{slug}', [ArticleController::class, 'showArtikel']);

// Tag Routes untuk Content Discovery
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

// Category Routes untuk Article Browsing
Route::get('/kategori/{category:slug}', [CategoryController::class, 'showPublic'])->name('visitor.categories.show');
// Informasi Berita Route
Route::get('/berita', [NewsController::class, 'index']);
Route::get('/berita/autocomplete', [NewsController::class, 'autocompleteSearch'])->name('berita.autocomplete');
Route::get('/berita/{slug}', [NewsController::class, 'show']);
// Informasi Galeri Kegiatan Route
Route::get('/galeri', [EventController::class, 'indexGaleri']);
Route::get('/galeri/{slug}', [EventController::class, 'showGaleri']);
// Informasi Download Route
Route::get('/unduh', [DownloadController::class, 'indexDownload']);
Route::get('/unduh/pnpk', [DownloadController::class, 'showPNPKCategories']);
Route::get('/unduh/{id}', [DownloadController::class, 'showDownload']);

Route::get('/sertifikat-zoominar', function () {
    return view('visitor.informasi.sertifikat-zoominar');
});

// Kontak Kami Route
Route::get('/kontak', function () {
    return view('visitor.kontak.kontak');
});

Route::get('/sp4n-lapor!', function () {
    return view('visitor.kontak.sp4n-lapor!');
});

Route::get('/sippn', function () {
    return view('visitor.kontak.sippn');
});

Route::get('/survei-kepuasaan-masyarakat', function () {
    return view('visitor.kontak.survei-kepuasan-masyarakat');
});
Route::get('/unit-layanan-pengaduan', function () {
    return view('visitor.kontak.unit-layanan-pengaduan');
});
// Kritik dan Saran Route
Route::get('/kritik-saran', function () {
    return view('visitor.kontak.kritik-saran');
});
Route::post('/kritik-saran', [SuggestionController::class, 'create']);

// Permintaan Informasi Online Route
Route::get('/permintaan-informasi-online', function () {
    return view('visitor.kontak.permintaan-informasi-online');
});
Route::post('/permintaan-informasi-online', [RequestOnlineInformationController::class, 'create']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('prevent.back.history');
    Route::post('/login', [AuthController::class, 'auth'])->name('login')->middleware('prevent.back.history');
});

Route::middleware(['auth'])->group(function () {
    // Notification Routes - Available for roles with access to suggestions and online information requests
    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications'])->name('notifications.unread');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');

    Route::middleware('super.admin')->group(function () {
        //Account Route
        Route::get('account', [AccountController::class, 'index'])->name('account.index');
        Route::post('account', [AccountController::class, 'create']);
        Route::patch('/account/{id}', [AccountController::class, 'update']);
        Route::patch('/account-password/{id}', [AccountController::class, 'updatePassword']);
    });

    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('prevent.back.history')->name('admin.dashboard');

        // Visual Effects Settings
        Route::get('/settings/visual-effects', [App\Http\Controllers\Admin\VisualEffectsController::class, 'index'])->name('visual-effects.index');
        Route::post('/settings/visual-effects', [App\Http\Controllers\Admin\VisualEffectsController::class, 'update'])->name('visual-effects.update');

        // Download Route
        // File Route
        Route::get('/download', [DownloadController::class, 'index'])->name('download.index');
        Route::post('/download', [DownloadController::class, 'store']);
        Route::patch('/download/{id}', [DownloadController::class, 'update']);
        Route::delete('/download/{id}', [DownloadController::class, 'destroy']);
        // Download Category Route
        Route::get('/download-category', [DownloadCategoryController::class, 'index'])->name('download-category.index');
        Route::post('/download-category', [DownloadCategoryController::class, 'store']);
        Route::patch('/download-category/{id}', [DownloadCategoryController::class, 'update']);
        Route::delete('/download-category/{id}', [DownloadCategoryController::class, 'destroy']);

        // Promkes Route
        Route::get('/promkes', [PromkesController::class, 'index'])->name('promkes.index');
        Route::post('/promkes', [PromkesController::class, 'store']);
        Route::patch('/promkes/{id}', [PromkesController::class, 'update']);
        Route::delete('/promkes/{id}', [PromkesController::class, 'destroy']);



        // Tarif Route
        // Room Route
        Route::get('/room', [RoomController::class, 'index'])->name('room.index');
        Route::post('/room', [RoomController::class, 'store']);
        Route::patch('/room/{id}', [RoomController::class, 'update']);

        // Treatment Route
        Route::get('/treatment', [TreatmentController::class, 'index'])->name('treatment.index');
        Route::post('/treatment', [TreatmentController::class, 'store']);
        Route::patch('/treatment/{id}', [TreatmentController::class, 'update']);
        Route::delete('/treatment/{id}', [TreatmentController::class, 'destroy']);
    });

    Route::middleware('admin.event')->group(function () {
        Route::get('/event', [EventController::class, 'index'])->name('event.index');
        Route::post('/event', [EventController::class, 'create']);
        Route::patch('/event/{id}', [EventController::class, 'update']);
        Route::delete('/event/{id}', [EventController::class, 'destroy']);
        Route::get('/event/{id}', [EventController::class, 'show'])->name('event.detail');
        Route::post('/event-picture/{id}', [EventPictureController::class, 'store']);
        Route::delete('/event-picture/{id}', [EventPictureController::class, 'destroy']);
    });

    // Iklan Management Routes - Super Admin & Admin only
    Route::middleware('admin.iklan')->group(function () {
        Route::resource('iklan', IklanController::class)->except(['show']);
        Route::patch('iklan/{iklan}/toggle-status', [IklanController::class, 'toggleStatus'])->name('iklan.toggle-status');
    });

    Route::middleware('admin.bed')->group(function () {
        //Bed Route
        Route::get('/bed', [BedController::class, 'index'])->name('beds.index');
        Route::post('/bed', [BedController::class, 'store']);
        Route::patch('/bed/{id}', [BedController::class, 'update']);
        Route::delete('/bed/{id}', [BedController::class, 'destroy']);

        //Note Route
        Route::patch('/note', [NoteController::class, 'update']);
    });

    Route::middleware('admin.article')->group(function () {
        //Article Route
        Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/article-add', [ArticleController::class, 'create']);
        Route::post('/article', [ArticleController::class, 'store']);
        Route::get('/article/{id}', [ArticleController::class, 'show']);
        Route::get('/article-edit/{id}', [ArticleController::class, 'edit']);
        Route::patch('/article/{id}', [ArticleController::class, 'update']);
        Route::delete('/article/{id}', [ArticleController::class, 'destroy']);

        //Category Route
        Route::resource('/categories', CategoryController::class);

        //Tags API Route for autocomplete
        Route::get('/tags/search', [ArticleController::class, 'searchTags'])->name('tags.search');
    });

    Route::middleware('admin.news')->group(function () {
        //News Route
        Route::get('/news', function (Request $request) {
            $request->merge(['admin' => true]);
            return app(NewsController::class)->index($request);
        })->name('news.index');
        Route::get('/news-add', [NewsController::class, 'create']);
        Route::post('/news', [NewsController::class, 'store']);
        Route::get('/news/{id}', [NewsController::class, 'show']);
        Route::get('/news-edit/{id}', [NewsController::class, 'edit']);
        Route::patch('/news/{id}', [NewsController::class, 'update']);
        Route::delete('/news/{id}', [NewsController::class, 'destroy']);
    });

    Route::middleware('admin.pengaduan')->group(function () {
        // Suggestion Route
        Route::get('/suggestion', [SuggestionController::class, 'index'])->name('suggestion.index');
        Route::get('/suggestion/{id}', [SuggestionController::class, 'show'])->name('admin.suggestions.show');

        // Request Online Information Route
        Route::get('/request-online-information', [RequestOnlineInformationController::class, 'index'])->name('admin.request-online-information.index');
        Route::get('/request-online-information/{id}', [RequestOnlineInformationController::class, 'show'])->name('admin.request-online-information.show');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->middleware('prevent.back.history');
});
