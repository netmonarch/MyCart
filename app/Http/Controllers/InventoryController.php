<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Category;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$valid = $request->validate ([
		'name' => 'required|max:255',
		'category' => 'required',
		'price' => 'required',
        'info' => 'nullable'
		]);
        
        $request->picture->getClientOriginalName();

        $request->file('picture')->storeAs('cartimages', $request->picture->getClientOriginalName());
        $inv = Inventory::create($valid);
        $inv->picture = $request->file('picture')->storeAs('cartimages', $request->picture->getClientOriginalName());
        $inv->save();

		return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats = Category::all();
        $inv = Inventory::find ($id);
        return view ("angular.editInv", ["cats" => $cats, "inv" => $inv]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Inventory::find($id);
        $item->name = $request->name;
        $item->info = $request->info;
        $item->price = $request->price;
        $item->category = $request->category;

        $item->picture = $request->file('picture')->storeAs ('cartimages', $request->picture->getClientOriginalName());

        $item->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::destroy($id);
        return back();
    }
}
