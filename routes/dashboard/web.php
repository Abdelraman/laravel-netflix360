<?php

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'role:super_admin|admin'])
    ->group(function () {

        //welcome route
        Route::get('/', 'WelcomeController@index')->name('welcome');

        //category routes
        Route::resource('categories', 'CategoryController')->except(['show']);

        //movie routes
        Route::resource('movies', 'MovieController');

        //role routes
        Route::resource('roles', 'RoleController')->except(['show']);

        //user routes
        Route::resource('users', 'UserController');

        Route::get('/settings/social_login', 'SettingController@social_login')->name('settings.social_login');
        Route::get('/settings/social_links', 'SettingController@social_links')->name('settings.social_links');
        Route::post('/settings', 'SettingController@store')->name('settings.store');
    });
