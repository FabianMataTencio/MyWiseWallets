<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EconomicGoalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\ReviewsAdminController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/review', [ReviewController::class, 'index'])->name('reviews.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
    Route::get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
    Route::get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
    Route::get('/incomes/{income}', [IncomeController::class, 'show'])->name('incomes.show');


    Route::get('/outcomes', [OutcomeController::class, 'index'])->name('outcomes.index');
    Route::get('/outcomes/create', [OutcomeController::class, 'create'])->name('outcomes.create');
    Route::get('/outcomes/{outcome}/edit', [OutcomeController::class, 'edit'])->name('outcomes.edit');
    Route::get('/outcomes/{outcome}', [OutcomeController::class, 'show'])->name('outcomes.show');


    Route::get('/economicgoals', [EconomicGoalController::class, 'index'])->name('economicgoals.index');
    Route::get('/economicgoals/create', [EconomicGoalController::class, 'create'])->name('economicgoals.create');
    Route::get('/economicgoals/{economic_goal}/edit', [EconomicGoalController::class, 'edit'])->name('economicgoals.edit');
    Route::get('/economicgoals/{economic_goal}', [EconomicGoalController::class, 'show'])->name('economicgoals.show');
    Route::get('/economicgoals/{economic_goal_id}', [EconomicGoalController::class, 'shownotifications'])->name('economicgoals.shownotifications');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/reviews-admin', [ReviewsAdminController::class, 'index'])->middleware('rol.admin')->name('reviews_admin.index');
    Route::get('/users-admin', [UserAdminController::class, 'index'])->middleware('rol.admin')->name('users_admin.index');
});

Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);

require __DIR__.'/auth.php';
