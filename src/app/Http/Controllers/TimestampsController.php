<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Stamp;
use App\Models\Rest;


class TimestampsController extends Controller
{

    public function create(Request $request)
    {
        $stamps = new Stamp();
        $stamps_id = $request->input('stamps_id');
        $stamps->create([
            'stamps_id' => $stamps_id,
            'stamps_day' => Carbon::now(),
            'work_in' => Carbon::now(),
        ]);

        return redirect('/');

    }

    public function store(Request $request)
    {
        $stamps = new Stamp();
        $stamps->create([
            'work_out' => Carbon::now(),
        ]);

        return redirect('/');
    }

}

