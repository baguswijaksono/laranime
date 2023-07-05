<p align="center">
    <a href="https://github.com/baguswijaksono">
      <img src="https://i.pinimg.com/originals/3e/d3/c3/3ed3c36536cc70f3f6e1347a9ea805fa.jpg" alt="Logo" width="150" height="150">
    </a>
</p>
    <h3 align="center">Laranime</h3>
  <p align="center">
    <samp>Web streaming anime bahasa inggris yang dibuat dengan Laravel 9 menggunakan data dari <a href="https://www1.gogoanime.cm/">Gogoanime</a> dan video dari 
        <a href="https://anikatsu.me/">Anikatsu
    </a></samp>
    <br />
    <a href="#routes"><strong>Lihat Dokumentasi »</strong></a>
    <br />

  </p>
  <p align="center">
    <a href="https://github.com/riimuru/gogoanime/actions/workflows/docker-build.yml">
      <img src="https://github.com/riimuru/gogoanime/actions/workflows/docker-build.yml/badge.svg" alt="stars">
    </a>
     <a href="https://github.com/riimuru/gogoanime/actions/workflows/codeql-analysis.yml">
      <img src="https://github.com/riimuru/gogoanime/actions/workflows/codeql-analysis.yml/badge.svg" alt="stars">
    </a>
    <a href="https://github.com/riimuru/gogoanime">
      <img src="https://img.shields.io/github/stars/riimuru/gogoanime" alt="stars">
    </a>
  </p>
</p>

## Deskripsi

 Aplikasi Laravel 9 sederhana untuk streaming dan menemukan anime yang menggunakan data dari Gogoanime dan Video Embed dari anikatsu.

## Disclaimer

Situs streaming ini dibuat semata-mata untuk tujuan menerapkan pengetahuan dan keterampilan dalam mengembangkan proyek Laravel. Penting untuk dicatat bahwa platform ini tidak mendukung atau mengambil bagian dalam bentuk pembajakan anime. Konten yang tersedia di situs web ini ditujukan hanya untuk tujuan informasi dan pendidikan.

Dengan menggunakan situs streaming ini, Anda mengakui bahwa tujuan pembuatannya semata-mata untuk tujuan pendidikan dan pengembangan terkait pengembangan web menggunakan framework Laravel, dan bahwa konten yang disediakan tidak dimaksudkan untuk mendukung atau mempromosikan pembajakan anime dengan cara apa pun.

Terima kasih atas pengertian anda dalam menjaga pendekatan yang bertanggung jawab terhadap konsumsi konten.

## Feature
### User
- [x]  Popular Anime Page
- [x]  Top Airing Anime Page
- [x]  Genre Page
- [x]  Search Anime
- [x]  Anime History Feature fro Normal User
- [x]  Watchlist Feature for Normal User
- [x]  Multi-Theme Support
    - [x]  Dark theme
    - [x]  Light theme
### Admin
- [x]  Anime Blacklist Feature for Admin
- [x]  Min Age Requirements Feature for Admin
- [x]  Multi-Theme Support
    - [x]  Dark theme
    - [x]  Light theme
### Super Admin
- [x]  User Manage Feature
- [x]  Multi-Theme Support
    - [x]  Dark theme
    - [x]  Light theme

## Instalasi

1. Open a terminal or command prompt and navigate to the project's root directory. Run the following command to install the required dependencies:
   ```sh
   composer install
   ```
2. Rename the provided .env.example file to .env. You can do this by running the following command:
   ```sh
   cp .env.example .env
   ```
3. Generate the application key by running the following command:
   ```sh
   php artisan key:generate
   ```
4. Create a new database and configure its details in the .env file. After configuring the database, run the following command to migrate the database tables:
   ```sh
   php artisan migrate
   ```
5. Jalankan Seeder the Laravel development server:
   ```sh
   php artisan serve
   ```
5. Start the Laravel development server:
   ```sh
   php artisan serve
   ```
   > **Note:** Now the server is running on http://127.0.0.1:8000/

# Routes
Dibawah contoh penggunaan ORM eloquent dan bagaimana mencetak data di views.

### Get Recent Episodes
| Parameter    | Deskripsi |
| ------------ | ------------------------------------------------------------------------------------ |
| `page` (int) | **limit halaman bervariasi (tergantung sejauh apa pempopulasian database): [1-331].**|

Route
```php
Route::get('/en/recent-release/{page}', [ApiController::class, 'GetRecentEpisodes'])->name('userRecent');
```
Controller Function

```php
public function GetRecentEpisodes(Request $request, $page)
{
    $data = Recent::where('page', $page)->get();    
    return view('en.recent-release', [
        'data' => $data 
    ]);
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->episodeId}}
{{$item->animeTitle}}
{{$item->animeImg}}
{{$item->episodeNum}}
@endforeach
```

### Get Popular Anime

| Parameter    | Description         |
| ------------ | ------------------- |
| `page` (int) | page limit: [1-504] |

Route
```php
Route::get('/en/popular/{page}', [ApiController::class, 'GetPopularAnime'])->name('userPopular');
```
Controller Function

```php
public function GetPopularAnime(Request $request, $page)
{
    $data = Popular::where('page', $page)->get();     
    return view('en.popular', [
        'data' => $data 
    ]);
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->page}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->animeImg}}
{{$item->releasedDate}}
@endforeach
```

### Get Anime Search

| Parameter       | Description         |
| --------------- | ------------------- |
| `keyw` (string) | judul anime dalam bahasa jepang, nama lain atau lokalisasi bahasa inggrisnya         |

Route
```php
Route::get('/en/search/{keyw}', [ApiController::class, 'GetAnimeSearch'])->name('userSearch');
```
Controller Function

```php
public function GetAnimeSearch(Request $request, $keyw)
{
    $keyw = str_replace("%20", "", $keyw);
    $data = EnDetails::where(function ($query) use ($keyw) {
        $query->where('animeId', 'LIKE', '%' . $keyw . '%')
            ->orWhere('otherNames', 'LIKE', '%' . $keyw . '%');
    })->get();
    return view('en.search', [
        'data' => $data 
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->type}}
{{$item->releasedDate}}
{{$item->status}}
{{$item->genres}}
{{$item->otherNames}}
{{$item->synopsis}}
{{$item->animeImg}}
{{$item->totalEpisodes}}
@endforeach
```

### Get Anime Movies

| Parameter      | Description                                                                                                                    |
| -------------- | ------------------------------------------------------------------------------------------------------------------------------ |
| `page` (int)   | page limit may vary                                                                                                            |

Route
```php
 Route::get('/en/anime-movies/{page}', [ApiController::class, 'GetAnimeMovies'])->name('userMovie');
```
Controller Function

```php
public function GetAnimeMovies(Request $request, $page)
{
    $data = Movies::where('page', $page)->get();    
    return view('en.anime-movies', [
        'data' => $data
    ]);
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->page}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->releasedDate}}
{{$item->animeImg}}
@endforeach
```

### Get Top Airing

| Parameter    | Description                                                                                                 |
| ------------ | ----------------------------------------------------------------------------------------------------------- |
| `page` (int) | page limit [1-26]. ***-1** to fetch all the pages avaliable **Warning: Waiting time will be much longer.*** |

Route
```php
 Route::get('/en/top-airing/{page}', [ApiController::class, 'getTopAiring'])->name('userTopair');
```
Controller Function

```php
public function GetTopAiring(Request $request,$page)
{
    $data = TopAir::where('page', $page)->get();    
    return view('en.top-airing', [
        'data' => $data
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->page}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->animeImg}}
{{$item->latestEp}}
@endforeach
```

### Get Anime Genres

| Parameter         | Description                           |
| ----------------- | ------------------------------------- |
| `:genre` (string) | [Genres are avaliable below](#genres) |
| `page` (int)      | The page limit varies by genre.       |

#### Genres
<details>
<summary>Genres list</summary>

| Genre           |
| --------------- |
| `action`        |
| `adventure`     |
| `cars `         |
| `comedy`        |
| `crime`         |
| `dementia`      |
| `demons`        |
| `drama`         |
| `dub`           |
| `ecchi`         |
| `family`        |
| `fantasy`       |
| `game`          |
| `gourmet`       |
| `harem`         |
| `historical`    |
| `horror`        |
| `josei`         |
| `kids`          |
| `magic`         |
| `martial-arts`  |
| `mecha`         |
| `military`      |
| `Mmusic`        |
| `mystery`       |
| `parody`        |
| `police`        |
| `psychological` |
| `romance`       |
| `samurai`       |
| `school`        |
| `sci-fi`        |
| `seinen`        |
| `shoujo`        |
| `shoujo-ai`     |
| `shounen`       |
| `shounen-ai`    |
| `slice-of-Life` |
| `space`         |
| `sports`        |
| `super-power`   |
| `supernatural`  |
| `suspense`      |
| `thriller`      |
| `vampire`       |
| `yaoi`          |
| `yuri`          |
</details>
&nbsp;

Route
```php
Route::get('/en/genre/{genre}/{page}', [ApiController::class, 'GetAnimeGenres'])->name('userGenre');
```
Controller Function

```php
public function GetAnimeGenres(Request $request, $genre, $page)
{
    $data = GenreEn::where('page', $page)
    ->where('genre', $genre)->get();  
    return view('en.genre', [
        'data' => $data, 
        ]);
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->page}}
{{$item->genre}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->animeImg}}
{{$item->releasedDate}}
@endforeach
```

### Get Anime Details

| Parameter      | Description                                                                          |
| -------------- | ------------------------------------------------------------------------------------ |
| `:id` (string) | **animeId can be found in every response body as can be seen in the above examples** |

Route
```php
Route::get('/en/anime-details/{anime}', [ApiController::class, 'GetAnimeDetails'])->name('userAnimeDtls');
```
Controller Function

```php
public function GetAnimeDetails(Request $request,$anime)
{
    $data = EnDetails::where('animeId', $anime)->get();
    $episode = epsList::where('animeId', $anime)->get();
    return view('en.anime-details', [
        'data' => $data , 'episode' => $episode]);
}
```

Print Data di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->animeId}}
{{$item->animeTitle}}
{{$item->type}}
{{$item->releasedDate}}
{{$item->status}}
{{$item->genres}}
{{$item->otherNames}}
{{$item->synopsis}}
{{$item->animeImg}}
{{$item->totalEpisodes}}
@endforeach
```
Print Episode di view

```blade
@foreach($data as $item)
{{$item->id}}
{{$item->animeId}}
{{$item->episodeId}}
{{$item->episodeNum}}
@endforeach
```
