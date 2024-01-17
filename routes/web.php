<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


$router->get('/', function () {
    return view('home.home');
});

$router->get('/contact', function () {
    return view('contact.contact');
});

$router->post('/send-email', 'App\Http\Controllers\ContactController@sendEmail');

$router->get('/success', function () {
    return view('email.success');
});

$router->get('/projects', [ProjectController::class, 'index'])->name('projects.index');

$router->get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');


/* Section Admin */

$router->get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
$router->post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
$router->post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

$router->middleware(['auth:admin'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Page d'index pour voir tous les projets
    
    // Formulaire de création d'un nouveau projet
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('projects.create');

    // Enregistrer un nouveau projet
    Route::post('/admin/projects', [ProjectController::class, 'store'])->name('projects.store');


    Route::put('/admin/projects/{project}/edit/title', [ProjectController::class, 'editTitle'])->name('projects.edit.title');
    Route::put('/admin/projects/{project}/edit/mainPicture', [ProjectController::class, 'editMainPicture'])->name('projects.edit.mainPicture');
    Route::put('/admin/projects/{project}/edit/mainDescription', [ProjectController::class, 'editMainDescription'])->name('projects.edit.mainDescription');
    Route::put('/admin/projects/{project}/edit/secondDescription', [ProjectController::class, 'editSecondDescription'])->name('projects.edit.secondDescription');
    Route::put('/admin/projects/edit/picture', [ProjectController::class, 'editPicture'])->name('projects.edit.picture');
    Route::delete('/admin/projects/{picture}/delete', [ProjectController::class, 'destroyPicture'])->name('projects.destroy.picture');





    Route::post('/admin/projects/{project}/add/githubLink', [ProjectController::class, 'addGithubLink'])->name('projects.add.github');
    Route::post('/admin/projects/{project}/add/picture', [ProjectController::class, 'addPicture'])->name('projects.add.picture');




    // Supprimer un projet
    Route::delete('/admin/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
});


/* Section Admin */