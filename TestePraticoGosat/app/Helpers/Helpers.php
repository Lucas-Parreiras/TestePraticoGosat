<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Helpers {
    static function cpfConsult($cpf) {
        $cpfFormated = str_replace(array('.', '-', '/'), "", $cpf);

        $client = new Client();

        $url = 'https://dev.gosat.org/api/v1/simulacao/credito';

        $body = [ 'cpf' => $cpfFormated ];

        $response = $client->post($url, [ 'json' => $body ]);

        $data = $response->getBody();

        return $data;

    }

    static function offerConsult($info) {
        $client = new Client();

        $url = 'https://dev.gosat.org/api/v1/simulacao/oferta';

        $body = [
            'cpf' => $info->cpf,
            'instituicao_id' => $info->instituicao_id,
            'codModalidade' => $info->codModalidade
        ];

        $response = $client->post($url, [ 'json' => $body ]);

        $data = $response->getBody();
        
        return $data;
    }

}