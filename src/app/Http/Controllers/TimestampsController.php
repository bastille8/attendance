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
        //ログインIDと当日の出勤記録を取得する
        $stamps = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->first();
        //$startdate = Rest::select('rest_in');
        //$enddate = Rest::select('rest_out');
        $stamps->update([
            'work_out' => Carbon::now(),
            //'rest_time' => $enddate - $startdate,
        ]);

        return redirect('/');
    }

}

