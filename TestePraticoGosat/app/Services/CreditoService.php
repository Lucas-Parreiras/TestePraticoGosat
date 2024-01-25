<?php

namespace App\Services;

use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use App\Models\Simulacao;

class CreditoService {
    static function offersFormatedService($cpf) {
        $cpfOptions = Helpers::cpfConsult($cpf);

        $arrOptions = [];

        $json = json_decode($cpfOptions);

        $instituicoesTest = $json->instituicoes;

        foreach ($instituicoesTest as $instituicao) {
            $instN = $instituicao->nome;
            $instId = $instituicao->id;
            $offerCpf = $cpf;
            $mods = $instituicao->modalidades;
            $retorno = Helpers::modalidadesFormato($instN, $instId, $mods, $offerCpf);
            array_push ($arrOptions, $retorno);
        }
        $arrUnico = array_merge($arrOptions[0], $arrOptions[1]);

        $arrRetorno = Helpers::ofertasFormato($arrUnico);

        foreach ($arrRetorno as $offer) {
            Simulacao::create($offer);
        }

        return $arrRetorno;
    }

}