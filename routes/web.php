<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::livewire('/', 'pages::posts.index')->name('posts.index');
Route::livewire('/create', 'pages::posts.create')->name('posts.create');
Route::livewire('/edit/{id}', 'pages::posts.edit')->name('posts.edit');
