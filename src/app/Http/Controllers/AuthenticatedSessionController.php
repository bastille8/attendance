<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;


class AuthenticatedSessionController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        $stamps = Stamp::Paginate(5);
        return view('attendance', ['stamps' => $stamps]);
    }

}


