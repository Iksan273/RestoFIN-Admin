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
    public function tambahPoint(Request $request)
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



            $user->point += $request->point;
            $user->save();

            $memberPoint = new MemberPoint();
            $memberPoint->users_id = $user->id;
            $memberPoint->point = $request->point;
            $memberPoint->keterangan = $request->keterangan;
            $memberPoint->save();

            return redirect()->route('employee.pointAddAdmin')->with('success', 'Poin berhasil ditanbah');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    public function formPoinPromo()
    {
        $promo = Promo::all();
        return view('Employee.member_point', compact('promo'));
    }

    public function minusPromoDouble(Request $request)
    {
        try {
            $request->validate([
                'phone1' => 'required|string',
                'phone2' => 'required|string',
                'promo' => 'required|string',
            ]);

            $user1 = User::where('phone', $request->phone1)->first();
            $user2 = User::where('phone', $request->phone2)->first();

            if (!$user1 || !$user2) {
                return back()->with('error', 'Salah satu atau kedua user dengan nomor telepon tersebut tidak ditemukan.');
            }

            list($pointDigunakan, $pointDibutuhkan) = explode('&', $request->promo);

            $totalPoints = $user1->point + $user2->point;

            if ($totalPoints < $pointDibutuhkan) {
                return back()->with('error', 'Total poin kedua user tidak mencukupi untuk menggunakan promo ini.');
            }

            if ($user1->point < $pointDigunakan || $user2->point < $pointDigunakan) {
                return back()->with('error', 'Salah satu user tidak memiliki cukup poin untuk menggunakan promo ini.');
            }

            $user1->point -= $pointDigunakan;
            $user2->point -= $pointDigunakan;
            $user1->save();
            $user2->save();

            $memberPoint1 = new MemberPoint();
            $memberPoint1->users_id = $user1->id;
            $memberPoint1->point = -$pointDigunakan;
            $memberPoint1->keterangan = "Pemakaian Promo Bersama " . $user1->firstname . " " . $user1->lastname;
            $memberPoint1->save();

            $memberPoint2 = new MemberPoint();
            $memberPoint2->users_id = $user2->id;
            $memberPoint2->point = -$pointDigunakan;
            $memberPoint2->keterangan = "Pemakaian Promo Bersama " . $user2->firstname . " " . $user2->lastname;
            $memberPoint2->save();
            return redirect()->route('employee.pointMinus')->with('success', 'Promo berhasil digunakan oleh kedua member');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
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
    public function checkMember(Request $request)
    {
        try {
            $phone = $request->phone;
            $user = User::where('phone', $phone)->first();

            if ($user) {
                return response()->json([
                    'name' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email,
                    'points' => $user->point,
                    'membership' => $user->membership
                ]);
            } else {
                return response()->json(['error' => 'User tidak ditemukan'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan pada server: ' . $e->getMessage()], 500);
        }
    }
}
