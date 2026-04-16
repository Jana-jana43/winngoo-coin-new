<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
class CountryController extends Controller
{
    //
public function index()
{
    return response()->json(
        Country::select(
            'id',
            'name',
            'iso_code',
            'phone_code',
            'phone_min',
            'phone_max'
        )->orderBy('name')->get()
    );
}
}
