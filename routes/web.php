<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/id', [HomeController::class, 'indexId'])->name('homeId');

    Route::get('/setting', function () {
        return view('setting');
    });
    
    // anime bahasa inggris
    Route::get('/en/recent-release/{page}', [ApiController::class, 'GetRecentEpisodes']);
    Route::get('/en/popular/{page}', [ApiController::class, 'GetPopularAnime']);
    Route::get('/en/search/{keyw}', [ApiController::class, 'GetAnimeSearch']);
    Route::get('/en/anime-movies/{page}', [ApiController::class, 'GetAnimeMovies']);
    Route::get('/en/top-airing/{page}', [ApiController::class, 'getTopAiring']);
    Route::get('/en/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenres']);
    Route::get('/en/anime-details/{anime}', [ApiController::class, 'GetAnimeDetails']);
    Route::get('/en/watch/{episodeId}', [ApiController::class, 'GetStreamingURLs']);
    Route::get('/en/thread/{episodeId}', [ApiController::class, 'GetEpisodeThread']);

    // anime bahasa indonesia
    Route::get('/id/ongoing-anime/{page}', [ApiController::class, 'GetOngoingAnimeId']);
    Route::get('/id/complete-anime/{page}', [ApiController::class, 'GetCompleteAnimeId']);
    Route::get('/id/search/{page}', [ApiController::class, 'GetAnimeSearchId']);
    Route::get('/id/anime-details/{anime}', [ApiController::class, 'GetAnimeDetailsid']);
    Route::get('/id/watch/{anime}/{episodeId}', [ApiController::class, 'GetStreamingURLsid']);

});

// admin
Route::middleware('admin')->group(function () {

    // en
    Route::get('/admin/en/recent-release/{page}', [AdminController::class, 'GetRecentEpisodes']);
    Route::get('/admin/en/popular/{page}', [AdminController::class, 'GetPopularAnime']);
    Route::get('/admin/en/search/{keyw}', [AdminController::class, 'GetAnimeSearch']);
    Route::get('/admin/en/anime-movies/{page}', [AdminController::class, 'GetAnimeMovies']);
    Route::get('/admin/en/top-airing/{page}', [AdminController::class, 'getTopAiring']);
    Route::get('/admin/en/genre/{genre}/{page}', [AdminController::class, 'GetAnimeGenres']);
    Route::get('/admin/en/anime-details/{anime}', [AdminController::class, 'GetAnimeDetails']);
    Route::get('/admin/en/watch/{episodeId}', [AdminController::class, 'GetStreamingURLs']);
    Route::get('/admin/en/thread/{episodeId}', [AdminController::class, 'GetEpisodeThread']);

    // anime bahasa indonesia
    Route::get('/admin/id/recent-release/{page}', [ApiController::class, 'GetRecentEpisodesid']);
    Route::get('/admin/id/search/{keyw}/{page}', [ApiController::class, 'GetAnimeSearchid']);
    Route::get('/admin/id/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenresid']);
    Route::get('/admin/id/anime-details/{anime}', [ApiController::class, 'GetAnimeDetailsid']);
    Route::get('/admin/id/watch/{anime}/{episodeId}', [ApiController::class, 'GetStreamingURLsid']);

    // CRUD blacklist
    Route::post('/adding-blacklist', [BlacklistController::class, 'store']);
    Route::post('/del-blacklist', [BlacklistController::class, 'destroy'])->name('blacklist.destroy');
    Route::post('/edit-blacklist', [BlacklistController::class, 'show'])->name('blacklist.destroy');

    
});



Route::get('/underage', function () {
    return view('underage');
});

Auth::routes();


