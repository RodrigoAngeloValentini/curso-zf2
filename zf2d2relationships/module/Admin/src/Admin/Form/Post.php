<?php

namespace Admin\Form;

use Zend\Form\Element\Textarea;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;

class Post extends Form
{
	public function __construct(ServiceLocatorInterface $sm)
	{
		parent::__construct('formPost');
		
		// definindo variáveis
		$em = $sm->get('Doctrine\ORM\EntityManager');
		$arrCategorias = array("" => "Selecione");
		
		$repoCategoria = $em->getRepository('Admin\Entity\Categoria');
		$arrCategorias += $repoCategoria->fetchPairs();
		
		$categoria = new Select('categoria');
		$categoria->setLabel('Categoria')
			->setAttributes(array(
				'id' => 'categoria',
				'class' => 'form-control',
				'options' => $arrCategorias
			));
		$this->add($categoria);
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control',
				'placeholder' => 'Digite o seu nome'
			));
		$this->add($nome);
		
		$descricao = new Textarea('descricao');
		$descricao->setLabel('Descrição')
			->setAttributes(array(
				'id' => 'descricao',
				'class' => 'form-control',
				'style' => 'height: 80px',
				'placeholder' => 'Digite a descrição do post'
			));
		$this->add($descricao);
		
		$conteudo = new Textarea('conteudo');
		$conteudo->setLabel('Conteúdo')
			->setAttributes(array(
				'id' => 'conteudo',
				'class' => 'form-control',
				'style' => 'min-height: 150px',
				'placeholder' => 'Digite o conteúdo do post'
			));
		$this->add($conteudo);
		
		$tags = new Text('tags');
		$tags->setLabel('Tags')
		->setAttributes(array(
			'id' => 'tags',
			'class' => 'form-control',
			'placeholder' => 'Digite as tags do conteúdo'
		));
		$this->add($tags);
		
		$submit = new Submit('submit');
		$submit->setValue('Salvar');
		$this->add($submit);
	}
}