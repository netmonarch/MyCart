<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\User;
use App\Inventory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Inventory::all();
        $categories = Category::all();
        
        return view('home', ['items' => $items, 'categories' => $categories]);
    }
}
