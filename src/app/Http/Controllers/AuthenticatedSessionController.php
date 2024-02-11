<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AuthenticatedSessionController extends Controller
{
    public function index(Request $request)
    {
        // stampsテーブルからレコードを取得
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
        $stamps = Stamp::Paginate(5);
        return view('attendance', compact('stamps'));
    }

}


