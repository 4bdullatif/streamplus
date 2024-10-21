<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function __invoke()
    {
        $term = request('term');
        $countryId = request('country_id');

        $states = DB::table('states')
            ->where('country_id', $countryId)
            ->whereLike('name', "%$term%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $states
        ]);
    }
}
