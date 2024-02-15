<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Stamp;
use App\Models\Rest;

class ReststampsController extends Controller
{
    public function create(Request $request)
    {
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
        $auth = auth()->user()->id;
        // ログインしているIDで最後に休憩開始を押した形跡を探す(rest_outがnullになっているレコード)
        $rests = Rest::where('rests_id', $auth)->where('rest_out', null)->first();
        $rests->update([
            'rest_out' => Carbon::now(),
        ]);

        return redirect('/');
    }
}
