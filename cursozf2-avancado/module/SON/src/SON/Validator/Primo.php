<?php

namespace SON\Validator;

use Zend\Validator\AbstractValidator;

class Primo extends AbstractValidator
{
    
    const NOT_PRIME = "notPrime";
    
    protected $messageTemplates = array(
      self::NOT_PRIME => "Esse não é um número primo"  
    );
    
    public function isValid($value) 
    {
        if(is_numeric($value) && $value > 0) {
            $aux = 2;
            $result = true;
            while($aux<$value) {
                if($value % $aux == 0)
                    $result = false;
                $aux++;
            }
            if(!$result)
                $this->error(self::NOT_PRIME);
            
            return $result;
        }
        else {
            $this->error(self::NOT_PRIME);
            return false;
        }
            
    }
}
