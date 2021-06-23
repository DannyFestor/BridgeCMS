<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\MenuStoreRequest;
use App\Http\Requests\Menu\MenuUpdateRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus.index', ['menus' => Menu::orderBy('title')->get()]);
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create($request->validated());

        return redirect()->route('admin.menus.index')->with('success', "Menu {$menu->title} has been created.");
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $menu->update($request->validated());

        return redirect()->route('admin.menus.index')->with('success', "Menu {$menu->title} has been updated.");
    }

    public function destroy(Menu $menu) {
        $menuDeleted = $menu->delete();
        if(!$menuDeleted) {
            return response()->json(['success' => FALSE], 300);
        }

        Session::flash('success', 'Menu ' . $menu->title . ' has been deleted.');
        return response()->json(['success' => TRUE], 200);
    }
}
