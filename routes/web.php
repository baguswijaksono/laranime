<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PopularController;
use App\Http\Controllers\RecentController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TopAiringController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\AnimeController;
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
    
    Route::get('/', function () { return redirect('/en');})->name('home');// Done Sepenuhnya

    Route::get('/en', [HomeController::class, 'index']);// Done Sepenuhnya
    Route::get('/en/all-anime', [HomeController::class, 'allAnime'])->name('all');// Done Sepenuhnya
    Route::get('/en/season-anime', [HomeController::class, 'seasonAnime'])->name('season');// Done Sepenuhnya
    Route::get('/en/season/{specify}', [HomeController::class, 'specifyseasonAnime']);// Done Sepenuhnya

    Route::get('/setting', function () {return view('user.setting');});// Done Sepenuhnya
    Route::post('/setting/update', [UserController::class, 'updateUser'])->name('updateUser');// Done Sepenuhnya

    Route::get('change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('change-password-save', [UserController::class, 'savechangePassword'])->name('saveChangePassword');

    Route::get('/dark', [HomeController::class, 'dark'])->name('dark');// Done Sepenuhnya
    Route::get('/light', [HomeController::class, 'light'])->name('light');// Done Sepenuhnya

    // Bahasa inggris
    Route::get('/en/recent-release/{page}', [RecentController::class, 'GetRecentEpisodes'])->name('userRecent');// Done Sepenuhnya
    Route::get('/en/popular/{page}', [PopularController::class, 'GetPopularAnime'])->name('userPopular');// Done Sepenuhnya
    Route::get('/en/search/{keyw}', [AnimeController::class, 'GetAnimeSearch'])->name('userSearch');// Done Sepenuhnya
    Route::get('/en/anime-movies/{page}', [MovieController::class, 'GetAnimeMovies'])->name('userMovie');// Done Sepenuhnya
    Route::get('/en/top-airing/{page}', [TopAiringController::class, 'getTopAiring'])->name('userTopair');// Done Sepenuhnya
    Route::get('/en/genre/{genre}/{page}', [GenresController::class, 'GetAnimeGenres'])->name('userGenre');// Done Sepenuhnya
    Route::get('/en/anime-details/{anime}', [AnimeController::class, 'GetAnimeDetails'])->name('userAnimeDtls');// Done Sepenuhnya
    Route::get('/en/watch/{episodeId}', [AnimeController::class, 'GetStreamingURLs']);// Done Sepenuhnya

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
    // CRUD User
    Route::get('/user', [SuperAdminController::class, 'viewUser'])->name('user');//Done Sepenuhnya
    Route::post('/user/promote', [SuperAdminController::class, 'promoteToAdmin'])->name('adminPromote');//Done Sepenuhnya
    Route::post('/user/demote', [SuperAdminController::class, 'demoteToUser'])->name('adminDemote');//Done Sepenuhnya
    Route::post('/user/delete', [SuperAdminController::class, 'delete'])->name('delUser');//Done Sepenuhnya

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
    Route::get('/pre-populate-popular', [PopularController::class, 'prepopulatePopular'])->name('prepopulatePopular'); //Done Sepenuhnya
    Route::get('/populate-popular', [PopularController::class, 'populatePopular'])->name('populatePopular'); //Done Sepenuhnya

    //Populate Movie Anime
    Route::get('/pre-populate-movie', [MovieController::class, 'prepopulateMovie'])->name('prepopulateMovie'); //Done Sepenuhnya
    Route::get('/populate-movie', [MovieController::class, 'populateMovie'])->name('populateMovie'); //Done Sepenuhnya

    //Populate Anime Details
    Route::get('/pre-populate-anime', [AnimeController::class, 'prepopulateAnime'])->name('prepopulateAnime');
    Route::get('/populate-anime', [AnimeController::class, 'populateAnime'])->name('populateAnime');

    //Populate Top Airing Anime
    Route::get('/pre-populate-top-airing', [TopAiringController::class, 'prepopulateTopAir'])->name('prepopulateTopAir');//Done Sepenuhnya
    Route::get('/populate-top-airing', [TopAiringController::class, 'populateTopAir'])->name('populateTopAir');//Done Sepenuhnya

    //Populate Recent Episode
    Route::get('/pre-populate-recent-release', [RecentController::class, 'prepopulateRecent'])->name('prepopulateRecent');//Done Sepenuhnya
    Route::get('/populate-recent-release', [RecentController::class, 'populateRecent'])->name('populateRecent');//Done Sepenuhnya

    Route::get('/pre-populate-genre', [GenresController::class, 'prepopulateGenre'])->name('prepopulateGenre');//Done Sepenuhnya
    Route::get('/populate-genre', [GenresController::class, 'populateGenre'])->name('populateGenre');//Done Sepenuhnya

    Route::get('/en-genre-list', [GenreListController::class, 'index'])->name('genre');//Done Sepenuhnya
    Route::post('/edit-genre', [GenreListController::class, 'update'])->name('genre.edit');//Done Sepenuhnya
    Route::post('/add-genre', [GenreListController::class, 'store'])->name('genre.add');//Done Sepenuhnya
    Route::post('/delete-genre', [GenreListController::class, 'destroy'])->name('genre.del');//Done Sepenuhnya

    // CRUD Popular
    Route::get('/en-db-popular', [PopularController::class, 'enpopular'])->name('admin-popular-manage');// Done Sepenuhnya
    Route::get('/en-db-popular/insert', function () {return view('admin.popular.insert');})->name('popularPreInsert');// Done Sepenuhnya
    Route::post('/en-db-popular/insert/save', [PopularController::class, 'enpopularIns'])->name('popular.ins');// Done Sepenuhnya
    Route::get('/en-db-popular/{animeId}/edit', [PopularController::class, 'enpopularEdit']); //Done Sepenuhnya
    Route::post('/en-db-popular/save-edit', [PopularController::class, 'enpopularEditsave']);//Done Sepenuhnya
    Route::post('/en-db-popular/delete', [PopularController::class, 'enpopularDel'])->name('popular.del');// Done Sepenuhnya

    // CRUD Movies
    Route::get('/en-db-movies', [MovieController::class, 'enmovie'])->name('admin-movie-manage');// Done Sepenuhnya
    Route::get('/en-db-movies/insert', function () {return view('admin.movie.insert');})->name('moviePreInsert');// Done Sepenuhnya
    Route::post('/en-db-movies/insert/save', [MovieController::class, 'enmovieIns'])->name('movie.ins');// Done Sepenuhnya
    Route::get('/en-db-movie/{animeId}/edit', [MovieController::class, 'enmovieEdit']);// Done Sepenuhnya
    Route::post('/en-db-movie/save-edit', [MovieController::class, 'enmovieEditsave']);//Done Sepenuhnya
    Route::post('/en-db-movie/delete', [MovieController::class, 'enmovieDel'])->name('movie.del');//Done Sepenuhnya

    //CRUD Top Airing
    Route::get('/en-db-topair', [TopAiringController::class, 'entopair'])->name('admin-topAir-manage');// Done Sepenuhnya
    Route::get('/en-db-topair/insert', function () {return view('admin.topair.insert');})->name('topairPreInsert');// Done Sepenuhnya
    Route::post('/en-db-topair/insert/save', [TopAiringController::class, 'entopairIns'])->name('entopair.ins');// Done Sepenuhnya
    Route::get('/en-db-topair/{animeId}/edit', [TopAiringController::class, 'entopairEdit']);// Done Sepenuhnya
    Route::post('/en-db-topair/save-edit', [TopAiringController::class, 'entopairEditsave']);//Done Sepenuhnya
    Route::post('/en-db-topair/delete', [TopAiringController::class, 'entopairDel'])->name('topair.del');// Done Sepenuhnya

    //CRUD Recent
    Route::get('/en-db-recent', [RecentController::class, 'enrecent'])->name('admin-recent-manage');// Done Sepenuhnya
    Route::get('/en-db-recent/insert', function () {return view('admin.recent.insert');})->name('recentPreInsert');// Done Sepenuhnya
    Route::post('/en-db-recent/insert/save', [RecentController::class, 'enrecentIns'])->name('recent.ins');// Done Sepenuhnya
    Route::get('/en-db-recent/{animeId}/edit', [RecentController::class, 'enrecentEdit']);// Done Sepenuhnya
    Route::post('/en-db-recent/save-edit', [RecentController::class, 'enrecentEditsave']);//Done Sepenuhnya
    Route::post('/en-db-recent/delete', [RecentController::class, 'enrecentDel'])->name('recent.del');// Done Sepenuhnya

    //CRUD Genre
    Route::get('/en-db-genre', [GenresController::class, 'engenre'])->name('admin-genre-manage');// Done Sepenuhnya
    Route::get('/en-db-genre/insert', function () {return view('admin.genre.insert');})->name('genrePreInsert');
    Route::post('/en-db-genre/insert/save', [GenresController::class, 'engenreIns'])->name('genre.ins');
    Route::get('/en-db-genre/{animeId}/edit', [GenresController::class, 'engenreEdit']);// Done Sepenuhnya
    Route::post('/en-db-genre/save-edit', [GenresController::class, 'engenreEditsave']);//Done Sepenuhnya
    Route::post('/en-db-genre/delete', [GenresController::class, 'engenreDel'])->name('engenre.del');// Done Sepenuhnya

    //CRUD Anime
    Route::get('/en-db-anime', [AnimeController::class, 'enanime'])->name('admin-anime-manage');// Done Sepenuhnya
    Route::get('/en-db-anime/insert', function () {return view('admin.anime.insert_anime');})->name('animePreInsert');// Done Sepenuhnya
    Route::post('/en-db-anime/insert/save', [AnimeController::class, 'enanimeIns'])->name('anime.ins');// Done Sepenuhnya
    Route::get('/en-db-anime/{id}/edit', [AnimeController::class, 'preenanimupdate'])->name('preenanimupdate');// Done Sepenuhnya
    Route::post('/en-db-anime/edit/save', [AnimeController::class, 'enanimupdate'])->name('enanimupdate');// Done Sepenuhnya
    Route::post('/en-db-anime/del', [AnimeController::class, 'enanimeDel'])->name('enanimdel');// Done Sepenuhnya

    //CRUD Episode
    Route::get('/en-db-anime/eps/{animeId}', [EpisodeController::class, 'enanimeEps'])->name('admin-epslist-manage');// Done Sepenuhnya
    Route::post('/en-db-anime/eps/update', [EpisodeController::class, 'enEpsupdate'])->name('enepslistedit');// Done Sepenuhnya
    Route::post('/en-db-anime/ep/del', [EpisodeController::class, 'enepDel'])->name('ep.del');// Done Sepenuhnya
    Route::get('/en-db-anime/ep/insert', function () {return view('admin.anime.episode.insert');})->name('epPreInsert');// Done Sepenuhnya
    Route::post('/en-db-anime/ep/insert/save', [EpisodeController::class, 'enepIns'])->name('ep.ins');// Done Sepenuhnya

});

Auth::routes();
