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
    
    Route::get('/', function () { return redirect('/en');});// Done Sepenuhnya

    Route::get('/en', [HomeController::class, 'index'])->name('home');// Done Sepenuhnya

    Route::get('/setting', function () {return view('setting');});// Done Sepenuhnya

    Route::post('/setting/update', [UserController::class, 'updateUser'])->name('updateUser');// Done Sepenuhnya

    Route::get('/dark', [HomeController::class, 'dark'])->name('dark');// Done Sepenuhnya
    Route::get('/light', [HomeController::class, 'light'])->name('light');// Done Sepenuhnya

    Route::get('/en/all-anime', [HomeController::class, 'allAnime'])->name('all');// Done Sepenuhnya

    Route::get('/en/season-anime', [HomeController::class, 'seasonAnime'])->name('season');// Done Sepenuhnya
    Route::get('/en/season/{specify}', [HomeController::class, 'specifyseasonAnime']);// Done Sepenuhnya
    
    // bahasa inggris
    Route::get('/en/recent-release/{page}', [ApiController::class, 'GetRecentEpisodes'])->name('userRecent');// Done Sepenuhnya
    Route::get('/en/popular/{page}', [ApiController::class, 'GetPopularAnime'])->name('userPopular');// Done Sepenuhnya
    Route::get('/en/search/{keyw}', [ApiController::class, 'GetAnimeSearch']);// Done Sepenuhnya
    Route::get('/en/anime-movies/{page}', [ApiController::class, 'GetAnimeMovies'])->name('userMovie');// Done Sepenuhnya
    Route::get('/en/top-airing/{page}', [ApiController::class, 'getTopAiring'])->name('userTopair');// Done Sepenuhnya
    Route::get('/en/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenres'])->name('userGenre');// Done Sepenuhnya
    Route::get('/en/anime-details/{anime}', [ApiController::class, 'GetAnimeDetails'])->name('userAnimeDtls');// Done Sepenuhnya
    Route::get('/en/watch/{episodeId}', [ApiController::class, 'GetStreamingURLs']);// Done Sepenuhnya

    // CRUD watchlist
    Route::get('/en-watchlist', [WatchListController::class, 'index'])->name('watchlist');// Done Sepenuhnya
    Route::post('/adding-watchlist', [WatchListController::class, 'store']);//Done Sepenuhnya
    Route::post('/del-watchlist', [WatchListController::class, 'destroy'])->name('watchlist.destroy');//Done Sepenuhnya

    // CRUD History
    Route::get('/en-history', [HistoryController::class, 'index'])->name('history');
    Route::post('/del-history', [HistoryController::class, 'destroy'])->name('history.destroy');//Done Sepenuhnya

    // CRUD Comment
    Route::post('/add-comment', [CommentsController::class, 'store']);//Done Sepenuhnya
    Route::get('/del-comment', [CommentsController::class, 'destroy']);//Done Sepenuhnya
    Route::get('/edit-comment', [CommentsController::class, 'update']);//Done Sepenuhnya

});

// super
Route::middleware('superadmin')->group(function () {

    Route::get('/user', [AdminController::class, 'viewUser'])->name('user');//Done Sepenuhnya
    Route::post('/user/promote', [AdminController::class, 'promoteToAdmin'])->name('adminPromote');//Done Sepenuhnya
    Route::post('/user/delete', [AdminController::class, 'delete'])->name('delUser');//Done Sepenuhnya

});

// admin
Route::middleware('admin')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');//Done Sepenuhnya

    // CRUD blacklist
    Route::get('/en-blacklist', [BlacklistController::class, 'index'])->name('blacklist');//Done Sepenuhnya
    Route::post('/adding-blacklist', [BlacklistController::class, 'store'])->name('blacklist.add');// Done Sepenuhnya
    Route::post('/del-blacklist', [BlacklistController::class, 'destroy'])->name('blacklist.destroy');// Done Sepenuhnya
    Route::post('/edit-blacklist', [BlacklistController::class, 'update'])->name('blacklist.edit');// Done Sepenuhnya

    // CRUD minage
    Route::get('/en-minage', [MinAgeController::class, 'index'])->name('minage');//Done Sepenuhnya
    Route::post('/adding-minage', [MinAgeController::class, 'store'])->name('minage.add');// Done Sepenuhnya
    Route::post('/del-minage', [MinAgeController::class, 'destroy'])->name('minage.destroy');// Done Sepenuhnya
    Route::post('/edit-minage', [MinAgeController::class, 'update'])->name('minage.edit');// Done Sepenuhnya

    //Populate Popular Anime
    Route::get('/pre-populate-popular', [AdminController::class, 'prepopulatePopular'])->name('prepopulatePopular'); //Done Sepenuhnya
    Route::get('/populate-popular', [AdminController::class, 'populatePopular'])->name('populatePopular'); //Done Sepenuhnya

    //Populate Movie Anime
    Route::get('/pre-populate-movie', [AdminController::class, 'prepopulateMovie'])->name('prepopulateMovie'); //Done Sepenuhnya
    Route::get('/populate-movie', [AdminController::class, 'populateMovie'])->name('populateMovie'); //Done Sepenuhnya

    //Populate Anime Details
    Route::get('/pre-populate-anime', [AdminController::class, 'prepopulateAnime'])->name('prepopulateAnime');
    Route::get('/populate-anime', [AdminController::class, 'populateAnime'])->name('populateAnime');

    //Populate Top Airing Anime
    Route::get('/pre-populate-top-airing', [AdminController::class, 'prepopulateTopAir'])->name('prepopulateTopAir');//Done Sepenuhnya
    Route::get('/populate-top-airing', [AdminController::class, 'populateTopAir'])->name('populateTopAir');//Done Sepenuhnya

    //Populate Recent Episode
    Route::get('/pre-populate-recent-release', [AdminController::class, 'prepopulateRecent'])->name('prepopulateRecent');//Done Sepenuhnya
    Route::get('/populate-recent-release', [AdminController::class, 'populateRecent'])->name('populateRecent');//Done Sepenuhnya

    Route::get('/pre-populate-genre', [AdminController::class, 'prepopulateGenre'])->name('prepopulateGenre');//Done Sepenuhnya
    Route::get('/populate-genre', [AdminController::class, 'populateGenre'])->name('populateGenre');//Done Sepenuhnya

    Route::get('/en-genre-list', [GenreListController::class, 'index'])->name('genre');//Done Sepenuhnya
    Route::post('/edit-genre', [GenreListController::class, 'update'])->name('genre.edit');//Done Sepenuhnya
    Route::post('/add-genre', [GenreListController::class, 'store'])->name('genre.add');//Done Sepenuhnya
    Route::post('/delete-genre', [GenreListController::class, 'destroy'])->name('genre.del');//Done Sepenuhnya

    // CRUD Popular
    Route::get('/en-db-popular', [AdminController::class, 'enpopular'])->name('admin-popular-manage');// Done Sepenuhnya
    Route::get('/en-db-popular/insert', function () {return view('insert.popular');})->name('popularPreInsert');// Done Sepenuhnya
    Route::post('/en-db-popular/insert/save', [AdminController::class, 'enpopularIns'])->name('popular.ins');// Done Sepenuhnya
    Route::get('/en-db-popular/{animeId}/edit', [AdminController::class, 'enpopularEdit']); //Done Sepenuhnya
    Route::post('/en-db-popular/save-edit', [AdminController::class, 'enpopularEditsave']);//Done Sepenuhnya
    Route::post('/en-db-popular/delete', [AdminController::class, 'enpopularDel'])->name('popular.del');// Done Sepenuhnya

    // CRUD Movies
    Route::get('/en-db-movies', [AdminController::class, 'enmovie'])->name('admin-movie-manage');// Done Sepenuhnya
    Route::get('/en-db-movies/insert', function () {return view('insert.movies');})->name('moviePreInsert');// Done Sepenuhnya
    Route::post('/en-db-movies/insert/save', [AdminController::class, 'enmovieIns'])->name('movie.ins');// Done Sepenuhnya
    Route::get('/en-db-movie/{animeId}/edit', [AdminController::class, 'enmovieEdit']);// Done Sepenuhnya
    Route::post('/en-db-movie/save-edit', [AdminController::class, 'enmovieEditsave']);//Done Sepenuhnya
    Route::post('/en-db-movie/delete', [AdminController::class, 'enmovieDel'])->name('movie.del');//Done Sepenuhnya

    //CRUD Top Airing
    Route::get('/en-db-topair', [AdminController::class, 'entopair'])->name('admin-topAir-manage');// Done Sepenuhnya
    Route::get('/en-db-topair/insert', function () {return view('insert.topair');})->name('topairPreInsert');// Done Sepenuhnya
    Route::post('/en-db-topair/insert/save', [AdminController::class, 'entopairIns'])->name('entopair.ins');// Done Sepenuhnya
    Route::get('/en-db-topair/{animeId}/edit', [AdminController::class, 'entopairEdit']);// Done Sepenuhnya
    Route::post('/en-db-topair/save-edit', [AdminController::class, 'entopairEditsave']);//Done Sepenuhnya
    Route::post('/en-db-topair/delete', [AdminController::class, 'entopairDel'])->name('topair.del');// Done Sepenuhnya

    //CRUD Recent
    Route::get('/en-db-recent', [AdminController::class, 'enrecent'])->name('admin-recent-manage');// Done Sepenuhnya
    Route::get('/en-db-recent/{animeId}/edit', [AdminController::class, 'enrecentEdit']);// Done Sepenuhnya
    Route::post('/en-db-recent/save-edit', [AdminController::class, 'enrecentEditsave']);//Done Sepenuhnya
    Route::post('/en-db-recent/delete', [AdminController::class, 'enrecentDel'])->name('recent.del');// Done Sepenuhnya

    //CRUD Genre
    Route::get('/en-db-genre', [AdminController::class, 'engenre'])->name('admin-genre-manage');// Done Sepenuhnya
    Route::get('/en-db-genre/{animeId}/edit', [AdminController::class, 'engenreEdit']);// Done Sepenuhnya
    Route::post('/en-db-genre/save-edit', [AdminController::class, 'engenreEditsave']);//Done Sepenuhnya
    Route::post('/en-db-genre/delete', [AdminController::class, 'engenreDel'])->name('engenre.del');// Done Sepenuhnya

    //CRUD Anime
    Route::get('/en-db-anime', [AdminController::class, 'enanime'])->name('admin-anime-manage');


    //CRUD Episode
    Route::get('/en-db-anime/eps/{animeId}', [AdminController::class, 'enanimeEps'])->name('admin-epslist-manage');

});

Auth::routes();
