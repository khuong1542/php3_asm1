<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminStaffRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            return $next($request);
        }
        else{
            Alert::warning('Cảnh báo!', 'Bạn không có quyền thực hiện hành động này!');
            return back();
        }
    }
}
