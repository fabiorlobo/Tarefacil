<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	public function show($page)
	{
		$viewPath = resource_path("views/{$page}.blade.php");

		if (file_exists($viewPath)) {
			return view($page);
		} else {
			abort(404, 'Page not found');
		}
	}
}