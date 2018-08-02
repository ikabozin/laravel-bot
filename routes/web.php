<?php

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


use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Crawler\Crawler;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

Route::get('/pdf', function () {
    return PDF::loadFile('http://www.github.com')->inline('github.pdf');
});

Route::get('/crawler', function () {
    $browsershot = (new \Spatie\Browsershot\Browsershot())
        ->setNodeBinary('/usr/bin/nodejs')
        ->setNpmBinary('/usr/bin/npm');

    Crawler::create()
        ->setCrawlObserver((new \App\Crawler\SimpleCrawlerObserver))
        ->setBrowsershot($browsershot)
        ->executeJavaScript()
        ->ignoreRobots()
        ->setMaximumCrawlCount(20)
        ->startCrawling('http://psyjournal.ru');
});

Route::get('/disk', function () {
    Storage::disk()->put('disk.txt', 'Привет!');
    $content = Storage::disk()->get('disk.txt');
    Storage::disk()->delete('disk.txt');

    return $content;
});

Route::get('/excel', function () {
    return Excel::download(new \App\Excel\UsersExport(), 'users.xlsx');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/task', 'TaskController');