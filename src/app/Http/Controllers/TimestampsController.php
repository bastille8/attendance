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
        $stamps->update([
            'work_out' => Carbon::now(),
        ]);

        $stamps = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->first();
        //出勤時間を抜き取る
        $work_in = Carbon::parse($stamps->work_in);
        //退勤時間を抜き取る
        $work_out = Carbon::parse($stamps->work_out);
        //秒単位で差分を求める
        $diffInSeconds = $work_out->diffInSeconds($work_in);

        //{時・分・秒へ直すときの構文}＊現状使わない
        //$hours = floor($diffInSeconds / 3600);
        //$minutes = floor(($diffInSeconds % 3600) / 60);
        //$seconds = $diffInSeconds % 60;

        $stamps->update([
            'work_time' => $diffInSeconds,
        ]);

        //$today = Carbon::now()->toDateString();
        //$rests = Rest::where('rests_id', $auth)->whereDate('created_at', $today)->get();
        //$rest_time = Carbon::parse($rests->rest_time):

        //$stamps->update([
        //'rests_time' => $rest_time,
        //]);

        return redirect('/');
    }

}

