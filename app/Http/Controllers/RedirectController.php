<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek()
    {
        if (auth()->user()->role_id === 1) {
            return redirect('/admin');
        } else if (auth()->user()->role_id === 2) {
            return redirect('/sm');
        } else if (auth()->user()->role_id === 3 || auth()->user()->role_id === 4) {
            return redirect('/report');
        } else if (auth()->user()->role_id === 5) {
            return redirect('/halamanCustomer');
        } else if (auth()->user()->role_id === 6) {
            return redirect('/fo');
        }

    }
}
