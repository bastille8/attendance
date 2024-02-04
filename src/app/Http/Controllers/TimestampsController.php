<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Stamp;


class TimestampsController extends Controller
{

    public function create(Request $request)
    {
        $stamps_id = $request->input('stamps_id');
        $stamps_day = Carbon::now();
        Stamp::create($stamps_id);
        Stamp::create($stamps_day);


        return redirect('/');
    }

}
