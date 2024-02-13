<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;


class AuthenticatedSessionController extends Controller
{
    public function index(Request $request)
    {
        //現日時を取得
        $today = Carbon::now()->toDateString();
        dump($today);
        // Stampモデルからレコードを取得
        $stamp = Stamp::select('stamps_day')->get();
        dump($stamp);

        // 同じ日に打刻されているかチェック
        if ($stamp = $today) {
            // レコードが存在する場合
            $stamp = true;
        } else {
            // レコードが存在しない場合
            $stamp = false;
        }
        dump($stamp);

        $stampend = Stamp::select('work_out')->get();

        // レコードが存在するかどうかをチェック
        if ($stampend = null) {
            // レコードが存在する場合
            $stampend = true;
        } else {
            // レコードが存在しない場合
            $stampend = false;
        }

        return view('index', compact('stamp', 'stampend'));
    }

    public function create()
    {
        $stamps_day = Stamp::select('stamps_day')->get()->simplePaginate(5);
        $stamps = Stamp::Paginate(5);
        return view('attendance', compact('stamps', 'stamps_day', 'rests'));
    }

}


