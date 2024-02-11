<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class AuthenticatedSessionController extends Controller
{
    public function index(Request $request)
    {
        //stamps_dayに現日付を挿入し打刻日と照らし合わせる
        $request->stamps_day = new Carbon(Carbon::now());
        // Stampモデルからレコードを取得
        $stamp = Stamp::all()->where('stamps_day', $request->stamps_day)->first();

        // レコードが存在するかどうかをチェック
        if ($stamp) {
            // レコードが存在する場合
            $stamp = true;
        } else {
            // レコードが存在しない場合
            $stamp = false;
        }

        return view('index', compact('stamp'));
    }

    public function create()
    {
        $stamps_day = DB::table('stamps', 'stamps_day')->paginate(5);
        $stamps = Stamp::Paginate(5);
        return view('attendance', compact('stamps', 'stamps_day'));
    }

}


