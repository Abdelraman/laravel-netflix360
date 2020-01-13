<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Movie;
use App\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $users_count = User::whereRole('user')->count();
        $categories_count = Category::count();
        $movies_count = Movie::where('percent', 100)->count();

        return view('dashboard.welcome', compact('users_count', 'categories_count', 'movies_count'));

    }// end of index

}//end of controller
