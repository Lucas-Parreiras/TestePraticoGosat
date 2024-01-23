<?php

namespace App\Services;

use App\Helpers\Helpers;
use GuzzleHttp\Client;

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
        //return $arrUnico;

        $arrRetorno = Helpers::ofertasFormato($arrUnico);
        return $arrRetorno;
    }

}