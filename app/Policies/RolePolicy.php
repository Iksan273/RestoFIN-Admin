<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function permission(Employee $employee)
    {
        return $employee->role == 'Master'
            ? Response::allow()
            : Response::deny('Fitur ini hanya untuk Master Admin');
    }
}
