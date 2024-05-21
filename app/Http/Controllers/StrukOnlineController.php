<?php

namespace App\Http\Controllers;

use App\Models\MemberPoint;
use App\Models\StrukOnline;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StrukOnlineController extends Controller
{
public function index()
{
    try {
        $strukOnline = StrukOnline::orderBy('created_at', 'desc')->get();
        return view('Employee.struk_pembelian', compact('strukOnline'));
    } catch (Exception $e) {
        Log::error('Error memuat data struk: ' . $e->getMessage());
        return back()->with('error', 'Gagal memuat data struk: ' . $e->getMessage());
    }
}

public function store(Request $request)
{
    try {
        $request->validate([
            'phone' => 'required|string',
            'point' => 'required|integer',
        ]);

        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->with('error', 'User dengan nomor telepon tersebut tidak ditemukan.');
        }

        $user->point += $request->point;
        if ($user->point < 0) {
            return back()->with('error', 'Poin tidak boleh negatif.');
        }
        $user->save();

        $memberPoint = new MemberPoint();
        $memberPoint->users_id = $user->id;
        $memberPoint->point = $request->point;
        $memberPoint->keterangan = 'Pembelian Online';
        $memberPoint->save();

        return redirect()->route('employee.struk')->with('success', 'Poin berhasil ditambahkan dan struk berhasil disimpan');
    } catch (Exception $e) {
        return back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
    }
}

public function updatePointdanStatus(Request $request, $id)
{
    try {
        $request->validate([
            'point' => 'required|integer'
        ]);

        $strukOnline = StrukOnline::findOrFail($id);
        $strukOnline->status = 'Accepted';
        $strukOnline->point=$request->point;
        $strukOnline->save();

        $user = User::findOrFail($strukOnline->users_id);
        $user->point += $request->point;
        $user->save();

        $memberPoint = new MemberPoint();
        $memberPoint->users_id = $user->id;
        $memberPoint->point = $request->point;
        $memberPoint->keterangan = 'Pembelian Online';
        $memberPoint->save();

        return redirect()->route('employee.struk')->with('success', 'Status struk berhasil diperbarui dan poin berhasil ditambahkan');
    } catch (Exception $e) {
        return back()->with('error', 'Gagal memperbarui status struk dan menambahkan poin: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        $strukOnline = StrukOnline::findOrFail($id);
        $strukOnline->delete();

        return redirect()->route('employee.struk')->with('success', 'Struk berhasil dihapus');
    } catch (Exception $e) {
        return back()->with('error', 'Gagal menghapus struk: ' . $e->getMessage());
    }
}

}
