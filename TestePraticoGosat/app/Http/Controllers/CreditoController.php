<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Services\CreditoService;

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

    public function offersFormated(Request $request) {
        $data = CreditoService::offersFormatedService($request->cpf);
        return $data;
    }

}
