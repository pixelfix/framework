<?php

use App\Controllers\BookController;
use App\Controllers\HomeController;

return [
	['GET', '/', [HomeController::class, 'index']],
	['GET', '/books/{id:\d+}', [BookController::class, 'show']],
	['GET', '/books/create', [BookController::class, 'create']],
	['POST', '/books', [BookController::class, 'store']],
];
