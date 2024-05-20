<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Recommendation;
use Exception;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        try {
            $rekomendasi = Recommendation::orderBy('created_at', 'asc')->get(); // Mengurutkan berdasarkan 'created_at' secara ascending
            return view('Employee.rekomendasi', compact('rekomendasi'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat daftar menu: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        try {
            $menu = Menu::orderBy('created_at', 'asc')->get();
            return view('Employee.add_rekomendasi', compact('menu'));
        } catch (Exception $e) {
            return  back()->with('error', 'Gagal memuat form Tambah menu: ' . $e->getMessage());
        }
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'menu' => 'required',
                'description' => 'required',

            ]);

            $rekomendasi = new Recommendation();
            $rekomendasi->menus_id = $request->menu;
            $rekomendasi->description = $request->description;

            $rekomendasi->save();
            return redirect()->route('employee.rekomendasi')->with('success', 'Rekomendasi Menu berhasil ditambahkan');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambah Rekomendasi Menu: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $rekomendasi = Recommendation::findOrFail($id);
            return view('Employee.edit_rekomendasi', compact('rekomendasi'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat form edit Rekomendasi Menu: ' . $e->getMessage());
        }
    }

    // Memperbarui menu di database
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'description' => 'required',
            ]);

            $rekomendasi = Recommendation::findOrFail($id);
            $rekomendasi->description = $request->description;

            $rekomendasi->save();
            return redirect()->route('employee.rekomendasi')->with('success', 'Rekomendasi Menu berhasil diperbarui');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui Rekomendasi menu: ' . $e->getMessage());
        }
    }

    // Menghapus menu dari database
    public function destroy($id)
    {
        try {
            $rekomendasi = Recommendation::findOrFail($id);
            $rekomendasi->delete();
            return redirect()->route('employee.rekomendasi')->with('success', 'RekomendasiMenu berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus Rekomendasi: ' . $e->getMessage());
        }
    }
}
