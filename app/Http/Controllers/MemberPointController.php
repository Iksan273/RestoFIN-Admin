<?php

namespace App\Http\Controllers;

use App\Models\MemberPoint;
use App\Models\Promo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MemberPointController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|string',
                'point' => 'required|integer',
                'keterangan' => 'required|string',
            ]);

            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return back()->with('error', 'User dengan nomor telepon tersebut tidak ditemukan.');
            }

            if ($user->point < $request->point) {
                return back()->with('error', 'Poin tidak mencukupi untuk dikurangi.');
            }

            $user->point -= $request->point;
            $user->save();

            $memberPoint = new MemberPoint();
            $memberPoint->users_id = $user->id;
            $memberPoint->point = -$request->point;
            $memberPoint->keterangan = $request->keterangan;
            $memberPoint->save();

            return redirect()->route('employee.pointMinusAdmin')->with('success', 'Poin berhasil dipotong');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    public function formPoinPromo()
    {
        $promo = Promo::all();
        return view('Employee.member_point', compact('promo'));
    }

    public function minusPromo(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|string',
                'promo' => 'required|string', // Ubah validasi menjadi string untuk menerima dua nilai
            ]);

            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return back()->with('error', 'User dengan nomor telepon tersebut tidak ditemukan.');
            }

            // Pisahkan nilai yang diterima dari request promo
            list($pointDigunakan, $pointDibutuhkan) = explode('&', $request->promo);

            // Cek apakah poin user mencukupi untuk pointDibutuhkan
            if ($user->point < $pointDibutuhkan) {
                return back()->with('error', 'Poin User tidak mencukupi untuk menggunakan promo ini.');
            }

            // Cek jika poin user setelah dikurangi pointDigunakan kurang dari 0
            if ($user->point - $pointDigunakan < 0) {
                return back()->with('error', 'Poin user tidak mencukupi untuk menggunakan promo ini.');
            }
            // Kurangi poin user dengan pointDigunakan
            $user->point -= $pointDigunakan;
            $user->save();

            $memberPoint = new MemberPoint();
            $memberPoint->users_id = $user->id;
            $memberPoint->point = -$pointDigunakan;
            $memberPoint->keterangan = "Pemakaian Promo";
            $memberPoint->save();

            return redirect()->route('employee.pointMinus')->with('success', 'Promo berhasil digunakan');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }
}
