<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Pages\Admin\ComplaintAcceptedList;
use App\Livewire\Pages\Admin\ComplaintAcceptedShow;
use App\Livewire\Pages\Admin\ComplaintArchiveList;
use App\Livewire\Pages\Admin\ComplaintCanceledList;
use App\Livewire\Pages\Admin\ComplaintCompletedList;
use App\Livewire\Pages\Admin\ComplaintCompletedShow;
use App\Livewire\Pages\Admin\ComplaintList;
use App\Livewire\Pages\Admin\ComplaintShow;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\ComplaintCreate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', ComplaintCreate::class)
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('complaints', ComplaintList::class)
        ->name('complaint.list');

    Route::get('complaints/{complaint}', ComplaintShow::class)
        ->name('complaint.show');

    Route::get('archives', ComplaintArchiveList::class)
        ->name('archive.list');

    Route::get('disposisi', ComplaintAcceptedList::class)
        ->name('accepted.list');

    Route::get('disposisi/{accepted_complaint}', ComplaintAcceptedShow::class)
        ->name('accepted.show');

    Route::get('completes', ComplaintCompletedList::class)
        ->name('completed.list');

    Route::get('completes/{accepted_complaint}', ComplaintCompletedShow::class)
        ->name('completed.show');

    Route::get(
        'canceled',
        ComplaintCanceledList::class
    )->name('canceled.list');
});



Route::middleware('auth')->post('logout', function (Logout $logout) {
    $logout();

    return redirect()->route('login');
})->name('logout');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
