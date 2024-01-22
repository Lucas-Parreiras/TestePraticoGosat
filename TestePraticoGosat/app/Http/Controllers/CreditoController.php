<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;

class CreditoController extends Controller
{
    public function show(Request $request) {
        $data = Helpers::cpfConsult($request->cpf);
        return $data;
    }

    public function showOffer(Request $request) {
        $data = Helpers::offerConsult($request);
        return $data;
    }
}
