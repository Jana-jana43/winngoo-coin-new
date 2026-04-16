<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
class FaqController extends Controller
{
public function faqs()
{
    $faq = Faq::all();

    return response()->json([
        'success' => true,
        'message' => 'FAQS fetched successfully!',
        'data' => $faq
    ]);
}
}