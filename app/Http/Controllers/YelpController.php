<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YelpController extends Controller
{
    public function getYelpData()
    {
        try {
            $response = Http::get('https://www.yelp.com/writeareview/search?find_desc=&find_loc=Providence%2C+RI');
            return $response->json();
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => 'Error fetching data from Yelp API'], 500);
        }
    }
}
