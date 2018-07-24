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
    /*Crawler::create()
        ->setCrawlObserver((new \App\Crawler\SimpleCrawlerObserver))
        ->startCrawling('https://php.earth/');*/

    Storage::disk('local')->put('file.txt', 'Привет!');
    $content = Storage::disk('local')->get('file.txt');
    //Storage::disk('local')->delete('file.txt');
    return $content;
});