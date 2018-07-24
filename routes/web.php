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
    Crawler::create()
        ->setCrawlObserver((new \App\Crawler\SimpleCrawlerObserver))
        ->doNotExecuteJavaScript()
        ->ignoreRobots()
        ->setMaximumCrawlCount(2)
        ->startCrawling('http://psyjournal.ru/articles/po-tu-storonu-supruzheskoy-izmeny-na-materiale-filma-stenli-kubrika-shiroko-zakrytye-glaza');
});

Route::get('/disk', function () {
    Storage::disk()->put('disk.txt', 'Привет!');
    $content = Storage::disk()->get('disk.txt');
    Storage::disk()->delete('disk.txt');

    return $content;
});