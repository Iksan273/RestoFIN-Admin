<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Exception;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan daftar promo
    public function index()
    {
        $promos = Promo::all();
        return view('Employee.promo', compact('promos'));
    }

    // Menampilkan form untuk membuat promo baru
    public function create()
    {
        return view('Employee.add_promo');
    }

    // Menyimpan promo baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'point_gunakan' => 'required|numeric',
                'point_dibutuhkan' => 'required|numeric',
                'foto' => 'image|required|max:100824'
            ]);

            $promo = new Promo();
            $promo->title = $request->title;
            $promo->description = $request->description;
            $promo->start_date = $request->start_date;
            $promo->end_date = $request->end_date;
            $promo->point_digunakan = $request->point_gunakan;
            $promo->point_dibutuhkan = $request->point_dibutuhkan;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('promo/images'), $filename);
                $promo->image_url = $filename;
            }
            $promo->save();

            return redirect()->route('employee.promo')->with('success', 'Promo berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambahkan promo: ' . $e->getMessage());
        }
    }

    // Menampilkan form untuk mengedit promo
    public function edit($id)
    {
        try {
            $promos = Promo::findOrFail($id);
            return view('Employee.edit_promo', compact('promos'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat form edit: ' . $e->getMessage());
        }
    }

    // Memperbarui promo di database
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'point_gunakan' => 'required|numeric',
                'point_dibutuhkan' => 'required|numeric',
                'foto' => 'image|max:100824'
            ]);

            $promo = Promo::findOrFail($id);
            $promo->title = $request->title;
            $promo->description = $request->description;
            $promo->start_date = $request->start_date;
            $promo->end_date = $request->end_date;
            $promo->point_digunakan = $request->point_gunakan;
            $promo->point_dibutuhkan = $request->point_dibutuhkan;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('promo/images'), $filename);
                $promo->image_url = $filename;
            }
            $promo->save();

            return redirect()->route('employee.promo')->with('success', 'Promo berhasil diupdate.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal update promo: ' . $e->getMessage());
        }
    }

    // Menghapus promo dari database
    public function destroy($id)
    {
        try {
            $promo=Promo::findOrFail($id);
            $promo->delete();
            return redirect()->route('employee.promo')->with('success', 'Promo berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus promo: ' . $e->getMessage());
        }
    }
}
