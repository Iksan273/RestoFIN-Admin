<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return view('Employee.kategori', compact('categories'));

        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengambil data kategori: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('Employee.add_kategori');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        try {
            $category = new Category();
            $category->title = $request->title;
            $category->save();

            return redirect()->route('employee.kategori')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('Employee.edit_kategori', compact('category'));
        } catch (Exception $e) {
            return back()->with('error', 'Kategori tidak ditemukan: ' . $e->getMessage());
        }
    }

    // Memperbarui kategori di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->title = $request->title;
            $category->save();

            return redirect()->route('employee.kategori')->with('success', 'Kategori berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    // Menghapus kategori dari database
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('employee.kategori')->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
