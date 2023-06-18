<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MinAgeController;
use App\Http\Controllers\WatchListController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GenreListController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function(){
    
Route::get('/', function () {
    return redirect('/en');
});

    Route::get('/en', [HomeController::class, 'index'])->name('home');
    Route::get('/id', [HomeController::class, 'indexId'])->name('homeId');

    Route::get('/setting', function () {
        return view('setting');
    });

    Route::post('/setting/update', [UserController::class, 'updateUser'])->name('updateUser');

    Route::get('/dark', [HomeController::class, 'dark'])->name('dark');
    Route::get('/light', [HomeController::class, 'light'])->name('light');

    Route::get('/en/all-anime', [HomeController::class, 'allAnime'])->name('all');

    Route::get('/en/season-anime', [HomeController::class, 'seasonAnime'])->name('season');
    Route::get('/en/season/{specify}', [HomeController::class, 'specifyseasonAnime']);

    
    // anime bahasa inggris
    Route::get('/en/recent-release/{page}', [ApiController::class, 'GetRecentEpisodes']);
    Route::get('/en/popular/{page}', [ApiController::class, 'GetPopularAnime'])->name('userPopular');
    Route::get('/en/search/{keyw}', [ApiController::class, 'GetAnimeSearch']);
    Route::get('/en/anime-movies/{page}', [ApiController::class, 'GetAnimeMovies'])->name('userMovie');
    Route::get('/en/top-airing/{page}', [ApiController::class, 'getTopAiring'])->name('userTopair');
    Route::get('/en/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenres'])->name('userGenre');
    Route::get('/en/anime-details/{anime}', [ApiController::class, 'GetAnimeDetails']);
    Route::get('/en/watch/{episodeId}', [ApiController::class, 'GetStreamingURLs']);
    Route::get('/en/thread/{episodeId}', [ApiController::class, 'GetEpisodeThread']);

    // anime bahasa indonesia
    Route::get('/id/ongoing-anime/{page}', [ApiController::class, 'GetOngoingAnimeId']);
    Route::get('/id/complete-anime/{page}', [ApiController::class, 'GetCompleteAnimeId']);
    Route::get('/id/search/{keyw}', [ApiController::class, 'GetAnimeSearchId']);
    Route::get('/id/anime/{anime}', [ApiController::class, 'GetAnimeDetailsid']);
    Route::get('/id/watch/{anime}/{episodeId}', [ApiController::class, 'GetStreamingURLsid']);

    // CRUD watchlist
    Route::get('/en-watchlist', [WatchListController::class, 'index'])->name('watchlist');
    Route::post('/adding-watchlist', [WatchListController::class, 'store']);
    Route::post('/del-watchlist', [WatchListController::class, 'destroy'])->name('watchlist.destroy');

    // CRUD History
    Route::get('/en-history', [HistoryController::class, 'index'])->name('history');
    Route::post('/adding-history', [HistoryController::class, 'store']);
    Route::post('/del-history', [HistoryController::class, 'destroy'])->name('history.destroy');

    // CRUD Comment
    Route::post('/add-comment', [CommentsController::class, 'store']);//Done Sepenuhnya
    Route::get('/del-comment', [CommentsController::class, 'destroy']);//Done Sepenuhnya
    Route::get('/edit-comment', [CommentsController::class, 'update']);//Done Sepenuhnya


});

// admin
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [AdminController::class, 'viewUser'])->name('user');

    // en
    Route::get('/admin/en/recent-release/{page}', [AdminController::class, 'GetRecentEpisodes']); // done blacklist
    Route::get('/admin/en/popular/{page}', [AdminController::class, 'GetPopularAnime']); // done blacklist
    Route::get('/admin/en/search/{keyw}', [AdminController::class, 'GetAnimeSearch']); // done blacklist
    Route::get('/admin/en/anime-movies/{page}', [AdminController::class, 'GetAnimeMovies']); // done blacklist
    Route::get('/admin/en/top-airing/{page}', [AdminController::class, 'getTopAiring']);// done blacklist
    Route::get('/admin/en/genre/{genre}/{page}', [AdminController::class, 'GetAnimeGenres']);// done blacklist

    // anime bahasa indonesia
    Route::get('/admin/id/recent-release/{page}', [ApiController::class, 'GetRecentEpisodesid']);
    Route::get('/admin/id/search/{keyw}/{page}', [ApiController::class, 'GetAnimeSearchid']);
    Route::get('/admin/id/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenresid']);
    Route::get('/admin/id/anime-details/{anime}', [ApiController::class, 'GetAnimeDetailsid']);
    Route::get('/admin/id/watch/{anime}/{episodeId}', [ApiController::class, 'GetStreamingURLsid']);

    // CRUD blacklist
    Route::get('/en-blacklist', [BlacklistController::class, 'index'])->name('blacklist');
    Route::post('/adding-blacklist', [BlacklistController::class, 'store'])->name('blacklist.add');
    Route::post('/del-blacklist', [BlacklistController::class, 'destroy'])->name('blacklist.destroy');
    Route::post('/edit-blacklist', [BlacklistController::class, 'show'])->name('blacklist.edit');

    // CRUD minage
    Route::get('/en-minage', [MinAgeController::class, 'index'])->name('minage');
    Route::post('/adding-minage', [MinAgeController::class, 'store'])->name('minage.add');
    Route::post('/del-minage', [MinAgeController::class, 'destroy'])->name('minage.destroy');
    Route::post('/edit-minage', [MinAgeController::class, 'show'])->name('minage.edit');

    //Databases Popular Anime
    Route::get('/pre-populate-popular', [AdminController::class, 'prepopulatePopular'])->name('prepopulatePopular'); //Done Sepenuhnya
    Route::get('/populate-popular', [AdminController::class, 'populatePopular'])->name('populatePopular'); //Done Sepenuhnya

    //Databases Anime Anime
    Route::get('/pre-populate-movie', [AdminController::class, 'prepopulateMovie'])->name('prepopulateMovie'); //Done Sepenuhnya
    Route::get('/populate-movie', [AdminController::class, 'populateMovie'])->name('populateMovie'); //Done Sepenuhnya

    //Databases Anime Anime
    Route::get('/pre-populate-anime', [AdminController::class, 'prepopulateAnime'])->name('prepopulateAnime');
    Route::get('/populate-anime', [AdminController::class, 'populateAnime'])->name('populateAnime');

    Route::get('/pre-populate-top-airing', [AdminController::class, 'prepopulateTopAir'])->name('prepopulateTopAir');//Done Sepenuhnya
    Route::get('/populate-top-airing', [AdminController::class, 'populateTopAir'])->name('populateTopAir');//Done Sepenuhnya

    Route::get('/pre-populate-recent-release', [AdminController::class, 'prepopulateRecent'])->name('prepopulateRecent');//Done Sepenuhnya
    Route::get('/populate-recent-release', [AdminController::class, 'populateRecent'])->name('populateRecent');//Done Sepenuhnya

    Route::get('/pre-populate-genre', [AdminController::class, 'prepopulateGenre'])->name('prepopulateGenre');//Done Sepenuhnya
    Route::get('/populate-genre', [AdminController::class, 'populateGenre'])->name('populateGenre');//Done Sepenuhnya

    Route::get('/en-genre-list', [GenreListController::class, 'index'])->name('genre');
    Route::post('/add-genre', [GenreListController::class, 'store'])->name('genre.add');
    Route::post('/delete-genre', [GenreListController::class, 'destroy'])->name('genre.del');

    // CRUD Popular
    Route::get('/en-db-popular', [AdminController::class, 'enpopular'])->name('admin-popular-manage');// Done Sepenuhnya
    Route::get('/en-db-popular/{animeId}/edit', [AdminController::class, 'enpopularEdit']); //Done Sepenuhnya
    Route::post('/en-db-popular/save-edit', [AdminController::class, 'enpopularEditsave']);//Done Sepenuhnya
    Route::post('/en-db-popular/delete', [AdminController::class, 'enpopularDel'])->name('popular.del');// Done Sepenuhnya

    // CRUD Movies
    Route::get('/en-db-movies', [AdminController::class, 'enmovie'])->name('admin-movie-manage');
    Route::get('/en-db-movies/{page}/info', [AdminController::class, 'enmovieInfo']);
    Route::get('/en-db-movies/{page}/edit', [AdminController::class, 'enmovieEdit']);
    Route::post('/en-db-movies/delete', [AdminController::class, 'enmovieDel'])->name('admin-popular-manage')->name('movie.del');

    //CRUD Top Airing
    Route::get('/en-db-topair', [AdminController::class, 'entopair'])->name('admin-topAir-manage');

    //CRUD Recent
    Route::get('/en-db-recent', [AdminController::class, 'enrecent'])->name('admin-recent-manage');

    //CRUD Genre
    Route::get('/en-db-genre', [AdminController::class, 'engenre'])->name('admin-genre-manage');

    //CRUD Anime
    Route::get('/en-db-anime', [AdminController::class, 'enanime'])->name('admin-anime-manage');
    Route::get('/en-db-anime/eps/{animeId}', [AdminController::class, 'enanimeEps'])->name('admin-epslist-manage');

});



Route::get('/underage', function () {
    return view('underage');
});

Auth::routes();


