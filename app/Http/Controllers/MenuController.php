<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        try {
            $menus = Menu::orderBy('created_at', 'asc')->get(); // Mengurutkan berdasarkan 'created_at' secara ascending
            return view('Employee.menu', compact('menus'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat daftar menu: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        try {
            $categories = Category::all();
            return view('Employee.add_menu', compact('categories'));
        } catch (Exception $e) {
            return  back()->with('error', 'Gagal memuat form Tambah menu: ' . $e->getMessage());
        }
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'kategori' => 'required',
                'foto' => 'image|required|max:100824'
            ]);

            $menu = new Menu();
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->categories_id = $request->kategori;


            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('menu/images'), $filename);
                $menu->imageUrl = $filename;
            }

            $menu->save();
            return redirect()->route('employee.menu')->with('success', 'Menu berhasil ditambahkan');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambah menu: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk mengedit menu
    public function edit($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            return view('Employee.edit_menu', compact('menu'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat form edit: ' . $e->getMessage());
        }
    }

    // Memperbarui menu di database
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'foto' => 'image|max:100824'
            ]);


            $menu = Menu::findOrFail($id);


            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('menu/images'), $filename);
                $menu->imageUrl = $filename;
            }
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->save();
            return redirect()->route('employee.menu')->with('success', 'Menu berhasil diperbarui');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui menu: ' . $e->getMessage());
        }
    }

    // Menghapus menu dari database
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect()->route('employee.menu')->with('success', 'Menu berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }
}
