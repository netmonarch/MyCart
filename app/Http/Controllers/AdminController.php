<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Inventory;

class AdminController extends Controller
{
    function index ()
    {
		$cats = Category::all();
		$users = User::all();
		$items = Inventory::paginate(5);
        return view ('admin', ['cats' => $cats, 'users' => $users, 'inventory' => $items]);
    }
}
