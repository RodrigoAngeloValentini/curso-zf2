<?php

namespace Admin\Service;

use Admin\Model\CorreiosCalculoFrete;
use Zend\Stdlib\Hydrator\ClassMethods;

class CalculoFrete
{
    public function correiosCalculoFrete(array $params)
    {
        $classMethods = new ClassMethods();
        $correiosCalculoFrete = new CorreiosCalculoFrete();

        $classMethods->hydrate($params, $correiosCalculoFrete);
        $params = http_build_query(get_object_vars($correiosCalculoFrete));

        $curl = curl_init('http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'.$params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $dados = curl_exec($curl);
        $dados = simplexml_load_string($dados);

        return $dados;
    }
}