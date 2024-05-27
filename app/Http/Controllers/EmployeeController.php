<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function showRegisterForm()
    {
        return view('Auth.add_employee');
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (Auth::guard('employee')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }

            Log::error('Login gagal: Username atau password salah.');
            return back()->withErrors([
                'username' => 'Username yang anda masukan salah',
                'password' => 'Password yang Anda masukkan salah.',
            ]);
        } catch (ValidationException $e) {
            Log::error('Error validasi saat login: ' . $e->getMessage());
            return back()->with('error', 'Gagal Login: ' . $e->getMessage());
        } catch (Exception $e) {
            Log::error('Error eksepsi saat login: ' . $e->getMessage());
            return back()->with('error', 'Gagal Login: ' . $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:employees',
                'password' => 'required|string',
            ]);

            $employee = new Employee();
            $employee->firstname = $validatedData['firstname'];
            $employee->lastname = $validatedData['lastname'];
            $employee->username = $validatedData['username'];
            $employee->password = bcrypt($validatedData['password']);
            $employee->role = "Employee";
            $employee->save();

            return redirect()->route('master.employee')->with('success', 'Pendaftaran Employee baru berhasil.');
        } catch (Exception $e) {
            Log::error('Error saat pendaftaran employee: ' . $e->getMessage());
            return back()->with('error', 'Gagal Menambahkan: ' . $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
