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
        $auth = auth()->user()->id;
        $today = Carbon::now()->toDateString();
        //↓要修正一番最後のレコードに更新されていく
        $stamps = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->first();
        $stamps->update([
            'work_out' => Carbon::now(),
        ]);

        return redirect('/');
    }

}

