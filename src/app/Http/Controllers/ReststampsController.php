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
        $rest_id = $request->input('rest_id');
        $rests->update([
            'rest_id' => $rest_id,
            'rest_in' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function store(Request $request)
    {
        $rests = new Rest();
        $rests->update([
            'rest_out' => Carbon::now(),
        ]);

        return redirect('/');
    }
}
