<?php

use App\Livewire\Frontend\Home\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('home.index');
Route::get('/about', \App\Livewire\Frontend\About\Index::class)->name('about.index');
Route::get('/profile/{profile:username}', \App\Livewire\Frontend\Profile\Index::class)->name('profile.index');
Route::get('/digital-library', \App\Livewire\Frontend\DigitalLibrary\Index::class)->name('digital-library.index');
Route::get('/future-skills', \App\Livewire\Frontend\FutureSkills\Index::class)->name('future-skills.index');
Route::get('/media-center', \App\Livewire\Frontend\MediaCenter\Index::class)->name('media-center.index');
Route::get('/social-window', \App\Livewire\Frontend\SocialWindow\Index::class)->name('social-window.index');
Route::get('/jobs', \App\Livewire\Frontend\Jobs\Index::class)->name('jobs.index');
Route::get('/contact', \App\Livewire\Frontend\Contact\Index::class)->name('contact.index');


Route::get('/digital-library/{category:slug}', \App\Livewire\Frontend\DigitalLibrary\Category::class)->name('digital-library.category');
Route::get('/digital-library/{category:slug}/{post:slug}', \App\Livewire\Frontend\DigitalLibrary\Post::class)->name('digital-library.post');


Route::get('/media-center/{post:slug}', \App\Livewire\Frontend\MediaCenter\Post::class)->name('media-center.post');


Route::get('/work', \App\Livewire\Frontend\Work\Index::class)->name('works.index');
Route::get('/work/{work:slug}', \App\Livewire\Frontend\Work\Show::class)->name('works.show');
Route::get('/work/category/{category:slug}', \App\Livewire\Frontend\Work\Category::class)->name('works.category');
Route::get('/work/tag/{tag}', \App\Livewire\Frontend\Work\Tag::class)->name('works.tag');
Route::get('/work/skill/{skill}', \App\Livewire\Frontend\Work\Skill::class)->name('works.skill');
Route::get('/work/tool/{tool}', \App\Livewire\Frontend\Work\Tool::class)->name('works.tool');


Route::get('/social-window/experts', \App\Livewire\Frontend\SocialWindow\Experts::class)->name('social-window.experts');
Route::get('/social-window/{category:slug}', \App\Livewire\Frontend\SocialWindow\Category::class)->name('social-window.category');
Route::get('/social-window/{tool}', \App\Livewire\Frontend\SocialWindow\Skill::class)->name('social-window.skill');
Route::get('/social-window/{skill}', \App\Livewire\Frontend\SocialWindow\Tool::class)->name('social-window.tool');
