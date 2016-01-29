<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

use Admin\Controller\AbstractController;

class PostController extends AbstractController
{
	public function indexAction()
	{
		// instanciando o repositorio
		$repoPost = $this->getEm('Admin\Entity\Post');
		$repoTag = $this->getEm('Admin\Entity\Tag');
		
		return new ViewModel(array(
			'posts' => $repoPost->findAll(),
			'tags' => $repoTag->findAll()
		));
	}
	
	public function detalheAction()
	{
		// pegando os valores via request
		$slug = $this->params('slug');
		$request = $this->getRequest();
		
		// instanciando o repositorio
		$repoPost = $this->getEm('Admin\Entity\Post')->findOneBySlug($slug);
		$comentarios = $repoPost->getComentario()->filter(function($comentario) {
			return count($comentario->getComentario()) == 0;
		});
		/* 
		echo "<pre>";
		print_r($comentarios[0]->getChildren()[0]->getNome());
		exit; */
		
		if ($request->isPost())
		{
			$serviceComentario = $this->getServiceLocator()->get('admin-service-comentario');
			$data = $request->getPost()->toArray();
			
			if ($serviceComentario->insert($data, 'Admin\Entity\Comentario'))
			{
				return $this->redirect()->toUrl('/post/detalhe/' . $data['slug']);
			}
		}
		
		return new ViewModel(array(
			'post' => $repoPost,
			'comentarios' => $comentarios
		));
	}
}