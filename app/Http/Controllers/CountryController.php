<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function __invoke()
    {
        $searchTerm = request('term');

        $countries = DB::table('countries')
            ->whereLike('name', "%$searchTerm%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $countries,
        ]);
    }
}
