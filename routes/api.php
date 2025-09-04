<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserImageController;

Route::get('user-image/{user_id}/{type}', [UserImageController::class, 'show']);



