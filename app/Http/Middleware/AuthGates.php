<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if(!empty($user)){
            $permissions = Permission::all()??'';
            if(!empty($permissions)){
                foreach ($permissions as $permission){
                    Gate::define($permission->slug,function (User $user) use($permission){
                        return $user->hasPermission($permission);
                    });
                }
            }

        }
        return $next($request);

    }
}
