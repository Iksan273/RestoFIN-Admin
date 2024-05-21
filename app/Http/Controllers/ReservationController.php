<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        try {
            $reservation = Reservation::orderBy('created_at', 'asc')->get(); // Mengurutkan berdasarkan 'created_at' secara ascending
            return view('Employee.reservasi', compact('reservation'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat daftar menu: ' . $e->getMessage());
        }
    }


    public function create()
    {
        try {
            return view('Employee.add_reservasi');
        } catch (Exception $e) {
            return  back()->with('error', 'Gagal memuat form Tambah reservasi: ' . $e->getMessage());
        }
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'reservation_date' => 'required|date_format:Y-m-d\TH:i',
                'nama'=>'required|string',
                'person' => 'required|integer',
                'phone' => 'required|string',

                'keterangan' => 'string'
            ]);

            $reservasi= new Reservation();
            $reservasi->nama=$request->nama;
            $reservasi->reservation_date = $request->reservation_date;
            $reservasi->person = $request->person;
            $reservasi->status = "Pending";
            $reservasi->phone = $request->phone;
            $reservasi->email = $request->email ?? null;
            $reservasi->keterangan = $request->keterangan ?? null; // Menggunakan null jika keterangan tidak disediakan

            $reservasi->save();
            return redirect()->route('employee.reservasi')->with('success', 'Menu berhasil ditambahkan');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menambah reservasi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $reservasi = Reservation::findOrFail($id);
            return view('Employee.edit_reservasi', compact('reservasi'));
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memuat form edit: ' . $e->getMessage());
        }
    }
    public function acceptReservation($id)
    {
        try {
            $reservasi = Reservation::findOrFail($id);
            $reservasi->status = 'Accepted';
            $reservasi->save();
            return redirect()->route('employee.reservasi')->with('success', 'Reservasi telah diterima.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal mengupdate status reservasi: ' . $e->getMessage());
        }
    }

    // Memperbarui menu di database
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'reservation_date' => 'required|date',
                'nama'=>'required|string',
                'person' => 'required|integer',
                'phone' => 'required|string',
                'keterangan' => 'string'
            ]);

            $reservasi = Reservation::findOrFail($id);

            $reservasi->reservation_date = $request->reservation_date;
            $reservasi->person = $request->person;
            $reservasi->phone = $request->phone;
            $reservasi->email = $request->email ?? null;
            $reservasi->keterangan = $request->keterangan ?? null;

            $reservasi->save();
            return redirect()->route('employee.reservasi')->with('success', 'Reservasi berhasil diperbarui');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memperbarui reservasi: ' . $e->getMessage());
        }
    }

    // Menghapus menu dari database
    public function destroy($id)
    {
        try {
            $reservasi = Reservation::findOrFail($id);
            $reservasi->delete();
            return redirect()->route('employee.reservasi')->with('success', 'Reservasi berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus reservasi: ' . $e->getMessage());
        }
    }
}
