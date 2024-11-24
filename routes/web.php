<?php

use App\Livewire\Frontend\Home\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home.index');
Route::get('/about', \App\Livewire\Frontend\About\Index::class)->name('about.index');
Route::get('/profile', \App\Livewire\Frontend\Profile\Index::class)->name('profile.index');
Route::get('/digital-library', \App\Livewire\Frontend\DigitalLibrary\Index::class)->name('digital-library.index');
Route::get('/future-skills', \App\Livewire\Frontend\FutureSkills\Index::class)->name('future-skills.index');
Route::get('/media-center', \App\Livewire\Frontend\MediaCenter\Index::class)->name('media-center.index');
Route::get('/social-window', \App\Livewire\Frontend\SocialWindow\Index::class)->name('social-window.index');
Route::get('/jobs', \App\Livewire\Frontend\Jobs\Index::class)->name('jobs.index');
Route::get('/contact', \App\Livewire\Frontend\Contact\Index::class)->name('contact.index');
