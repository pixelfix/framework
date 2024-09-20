<?php

namespace App\Controllers;

use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Http\Response;

class HomeController extends AbstractController
{
	public function index(): Response
	{
		return $this->render('home.html.twig');
	}
}
