<?php



Route::get('/','HomeController@getIndex');



Route::get('/{catchall?}', function () {
    return response()->view('home/index');
})->where('catchall', '(.*)');

