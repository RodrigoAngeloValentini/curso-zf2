<?php

namespace Admin\Repository;

class Cupom extends AbstractRepository
{
    public function findToArray($id)
    {
        $result = $this->find($id)->toArray();
        $result['dta_ini'] = $result['dta_ini']->format('d-m-Y H:i');
        $result['dta_fim'] = $result['dta_fim']->format('d-m-Y H:i');

        return $result;
    }
}