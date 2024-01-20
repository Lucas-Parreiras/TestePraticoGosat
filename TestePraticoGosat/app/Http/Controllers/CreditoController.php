<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CreditoController extends Controller
{
    public function show(Request $request) {
        $client = new Client();

        $url = 'https://dev.gosat.org/api/v1/simulacao/credito';

        $body = [ 'cpf' => $request->cpf ];

        $response = $client->post($url, [ 'json' => $body ]);

        $data = $response->getBody();

        return $data;
    }

    public function showOffer(Request $request) {
        $client = new Client();

        $url = 'https://dev.gosat.org/api/v1/simulacao/oferta';

        $body = [
            'cpf' => $request->cpf,
            'instituicao_id' => $request->instituicao_id,
            'codModalidade' => $request->codModalidade
        ];

        $response = $client->post($url, [ 'json' => $body ]);

        $data = $response->getBody();

        return $data;

    }
}
