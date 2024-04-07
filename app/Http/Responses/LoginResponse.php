<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract {

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request) {

        $home = Auth::user()->is_admin ? route('admin.dashboard')
            : route('dashboard');

        return redirect($home);
    }

}
