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
            'cpf' => $info["cpf"],
            'instituicao_id' => $info["instituicao_id"],
            'codModalidade' => $info["codModalidade"]
        ];

        $response = $client->post($url, [ 'json' => $body ]);

        $data = $response->getBody();
        
        return $data;
    }

    static function modalidadesFormato($instN, $instId, $mods, $offerCpf) {
        $arrModalidades = [];

        foreach ($mods as $mod) {
            $ofertaInfo = [
                'cpf' => $offerCpf,
                'instituicaoId' => $instId,
                'instituicaoFinanceira' => $instN,
                'modalidadeCredito' => $mod->nome,
                'modalidadeCod' => $mod->cod
            ];

            array_push ($arrModalidades, $ofertaInfo);
        }

        return $arrModalidades;
    }

    private function ordenarPorTaxa($a, $b) {
        return $a['taxaJuros'] - $b['taxaJuros'];
    }

    static function ofertasFormato($arrOptions) {
        $retornoFormatado = [];

        foreach ($arrOptions as $option) {
            $requisiçãoInfo = [
                'cpf' => $option["cpf"],
                'instituicao_id' => $option["instituicaoId"],
                'codModalidade' => $option["modalidadeCod"]
            ];

            $ofertaInfo = Helpers::offerConsult($requisiçãoInfo);
            $ofertaInfoJson = json_decode($ofertaInfo);

            $valorSemJuros = $ofertaInfoJson->valorMax;
            $taxaDeJuros = $ofertaInfoJson->jurosMes;
            $quantidadeDeMeses = $ofertaInfoJson->QntParcelaMin;
            $valorComJuros = $valorSemJuros * pow(1 + $taxaDeJuros, $quantidadeDeMeses);
            $valorFormatado = number_format($valorComJuros, 2, '.', '');

            $ofertaFinal = [
                'instituicaoFinanceira' => $option["instituicaoFinanceira"],
                'modalidadeCredito' => $option["modalidadeCredito"],
                'valorAPagar' => $valorFormatado,
                'valorSolicitado' => $ofertaInfoJson->valorMax,
                'taxaJuros' => $ofertaInfoJson->jurosMes,
                'qntParcelas' => $ofertaInfoJson->QntParcelaMin
            ];

            array_push ($retornoFormatado, $ofertaFinal);
        }

        $test = usort(
            $retornoFormatado,
            function ($a, $b) {
                return $a['taxaJuros'] - $b['taxaJuros'];
            }
        );

        return $retornoFormatado;
    }

}