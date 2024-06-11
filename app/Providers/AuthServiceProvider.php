<?php

namespace App\Providers;


use App\Models\Employee;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate as FacadesGate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [

    ];

    public function boot()
    {
        $this->registerPolicies();

        FacadesGate::define('cek-permission', [RolePolicy::class, 'permission']);
    }
}
