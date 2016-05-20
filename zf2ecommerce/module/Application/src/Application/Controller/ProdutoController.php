<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class ProdutoController extends AbstractController
{
    public function indexAction()
    {
    	$produtos = $this->getEm('Admin\Entity\Produto')->getProdutos();

        return new ViewModel(array(
        	'produtos' => $produtos
        ));
    }

    public function detalheAction()
    {
    	$this->layout('layout/layout_produto_detalhe');

    	$slug = $this->params('slug');
    	$produto = $this->getEm('Admin\Entity\Produto')->findOneBySlug($slug);
    	$atributos = array();

    	if (count($produto->getAtributo())) {
    		foreach ($produto->getAtributo() as $item) {
				$atributos[$item->getAtributoTipo()->getId()][] = $item;
    		}
    	}

    	/* echo "<pre>";
    	print_r($atributos);
    	exit; */

    	return new ViewModel(array(
    		'produto' => $produto,
    		'atributos' => $atributos
    	));
    }
}
