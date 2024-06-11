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
    public function index(){

        $employee=Employee::all();

        return view('Master.index',compact('employee'));
    }

    public function employee(){

        $employee=Employee::all();

        return view('Master.employee',compact('employee'));
    }
    public function delete($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return redirect()->route('master.employee')->with('success', 'Employee berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error saat menghapus employee: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus employee.');
        }
    }

    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('Master.edit_employee', compact('employee'));
        } catch (Exception $e) {
            Log::error('Error saat membuka form edit employee: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuka form edit employee.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'password' => 'nullable|string',
            ]);

            $employee = Employee::findOrFail($id);
            $employee->firstname = $validatedData['firstname'];
            $employee->lastname = $validatedData['lastname'];
            $employee->username = $validatedData['username'];
            if (!empty($validatedData['password'])) {
                $employee->password = bcrypt($validatedData['password']);
            }
            $employee->save();

            return redirect()->route('master.employee')->with('success', 'Employee berhasil diperbarui.');
        } catch (ValidationException $e) {
            Log::error('Error validasi saat update employee: ' . $e->getMessage());
            return back()->withErrors($e->errors());
        } catch (Exception $e) {
            Log::error('Error eksepsi saat update employee: ' . $e->getMessage());
            return back()->with('error', 'Gagal update employee.');
        }
    }
    public function showLoginForm()
    {
        return view('Auth.Login');
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
            return back()->with('error', 'Username atau password salah');
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
