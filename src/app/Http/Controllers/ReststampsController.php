<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rest;
use App\Models\Stamp;

class ReststampsController extends Controller
{
    public function create(Request $request)
    {
        // 休憩開始
        $rests = new Rest();
        $rests_id = $request->input('rests_id');
        $rests->create([
            'rests_id' => $rests_id,
            'rest_in' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function store(Request $request)
    {
        // 休憩終了 ~ 休憩時間の算出
        $auth = auth()->user()->id;
        $today = Carbon::now()->toDateString();
        // ログインしているIDで最後に休憩開始を押した形跡を探す(rest_outがnullになっているレコード)
        $rests = Rest::where('rests_id', $auth)->where('rest_out', null)->first();
        $rests->update([
            'rest_out' => Carbon::now(),
        ]);

        //休憩時間(単計)
        // 休憩時間がnullのレコードを探す
        $rests = Rest::where('rests_id', $auth)->where('rest_time', null)->first();
        // 休憩開始時間の挿入
        $rest_in = Carbon::parse($rests->rest_in);
        // 休憩終了時間の挿入
        $rest_out = Carbon::parse($rests->rest_out);
        // 差分を求める
        $rest_time = $rest_out->diffInSeconds($rest_in);

        $rests->update([
            'rest_time' => $rest_time,
        ]);

        //休憩時間(累計)初回のみ
        $stamps = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->where('rests_time', null)->first();
        if (!$stamps == null) {
            $stamps->update([
                'rests_time' => $rest_time,
            ]);
        }

        //休憩時間(累計)加算
        $stamps = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->first();
        $rest_time = Carbon::parse($rests->rest_time);
        dump($rest_time);
        $rests_time = Carbon::parse($stamps->rests_time);
        dump($rests_time);
        $addSeconds = $rests_time->addSeconds($rest_time);
        dd($addSeconds);

        $stamps->update([
            'rests_time' => $addSeconds,
        ]);

        return redirect('/');
    }
}
