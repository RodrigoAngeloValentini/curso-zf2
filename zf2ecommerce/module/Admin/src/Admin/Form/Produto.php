<?php

namespace Admin\Form;

use Zend\Form\Element\Checkbox;

use Zend\Form\Element\Textarea;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Produto extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-produto');

		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');

		// definindo variáveis
		$arrCategorias = array('' => 'Selecione');

		$repoCategorias = $em->getRepository('Admin\Entity\Categoria');
		$arrCategorias += $repoCategorias->getCategorias();

		$categoria = new Select('categoria');
		$categoria->setLabel('Categoria do produto')
			->setAttributes(array(
				'id' => 'categoria',
				'class' => 'form-control',
				'style' => 'width: 700px',
				'options' => $arrCategorias
			));
		$this->add($categoria);

		$codigo = new Text('codigo');
		$codigo->setLabel('Código do produto')
			->setAttributes(array(
				'id' => 'codigo',
				'style' => 'width: 200px',
				'class' => 'form-control'
			));
		$this->add($codigo);

		$nome = new Text('nome');
		$nome->setLabel('Nome do produto')
			->setAttributes(array(
				'id' => 'nome',
				'style' => 'width: 700px',
				'class' => 'form-control'
			));
		$this->add($nome);

		$slug = new Text('slug');
		$slug->setLabel('Slug do produto')
			->setAttributes(array(
				'id' => 'slug',
				'style' => 'width: 700px',
				'class' => 'form-control'
			));
		$this->add($slug);

		$descricao = new Textarea('descricao');
		$descricao->setLabel('Descrição')
			->setAttributes(array(
				'id' => 'descricao',
				'style' => 'width: 700px; height: 100px',
				'class' => 'form-control'
			));
		$this->add($descricao);

		$peso = new Text('peso');
		$peso->setLabel('Peso')
			->setAttributes(array(
				'id' => 'peso',
				'style' => 'width: 150px',
				'class' => 'form-control'
			));
		$this->add($peso);

		$ativo = new Checkbox('ativo');
		$ativo->setLabel('Ativo')
			->setAttributes(array(
				'id' => 'ativo',
				'style' => 'width: 38px',
				'class' => 'form-control'
			));
		$this->add($ativo);

	}
}