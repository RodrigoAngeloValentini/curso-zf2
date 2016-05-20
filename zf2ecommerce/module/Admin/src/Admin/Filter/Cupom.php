<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class Cupom extends InputFilter
{
	public function __construct()
	{
        $this->add(array(
            'name' => 'codigo',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));

		$this->add(array(
			'name' => 'nome',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

        $this->add(array(
            'name' => 'tipo',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));

        $this->add(array(
            'name' => 'tipo_desconto',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));

        $this->add(array(
            'name' => 'dta_ini',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));

        $this->add(array(
            'name' => 'dta_fim',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));

        $this->add(array(
            'name' => 'valor',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags')
            )
        ));
	}
}