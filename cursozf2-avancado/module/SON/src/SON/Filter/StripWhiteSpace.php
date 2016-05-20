<?php

namespace SON\Filter;

use Zend\Filter\AbstractFilter;

class StripWhiteSpace extends AbstractFilter 
{
    public function filter($value) {
        return preg_replace('/\s\s+/',' ',$value);
    }
}
