<?php

namespace Admin\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Form\Element\Text;

class Cupom extends Form
{
	public function __construct()
	{
		parent::__construct('form-cupom');
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);

        $codigo = new Text('codigo');
        $codigo->setLabel('Código')
			->setAttributes(array(
				'id' => 'codigo',
				'class' => 'form-control'
			));
		$this->add($codigo);

        $descricao = new Textarea('descricao');
        $descricao->setLabel('Descrição')
			->setAttributes(array(
				'id' => 'descricao',
				'class' => 'form-control'
			));
		$this->add($descricao);

        $tipo = new Select('tipo');
        $tipo->setLabel('Tipo')
            ->setAttributes(
                array(
                    'id' => 'tipo',
                    'class' => 'form-control',
                    'options' => array(
                        '1' => 'Cupom para o item',
                        '2' => 'Cupom para o pedido'
                    )
                )
            );
        $this->add($tipo);

        $tipoDesconto = new Select('tipo_desconto');
        $tipoDesconto->setLabel('Tipo Desconto')
            ->setAttributes(
                array(
                    'id' => 'tipo_desconto',
                    'class' => 'form-control',
                    'options' => array(
                        '1' => 'Valor',
                        '2' => 'Porcentagem'
                    )
                )
            );
        $this->add($tipoDesconto);

        $valor = new Text('valor');
        $valor->setLabel('Valor')
            ->setAttributes(array(
                'id' => 'valor',
                'class' => 'form-control'
            ));
        $this->add($valor);

        $dtaIni = new Text('dta_ini');
        $dtaIni->setLabel('Data Início')
            ->setAttributes(array(
                'id' => 'dta_ini',
                'class' => 'form-control'
            ));
        $this->add($dtaIni);

        $dtaFim = new Text('dta_fim');
        $dtaFim->setLabel('Data Final')
            ->setAttributes(array(
                'id' => 'dta_fim',
                'class' => 'form-control'
            ));
        $this->add($dtaFim);
	}
}