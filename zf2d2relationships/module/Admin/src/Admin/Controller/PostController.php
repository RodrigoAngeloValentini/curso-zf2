<?php

namespace Admin\Controller;

use Admin\Form\Post;

use Zend\View\Model\ViewModel;


class PostController extends AbstractController
{
	public function indexAction()
	{
		// carregando os repositories
		$repoPost = $this->getEm('Admin\Entity\Post');

		return new ViewModel(array(
			'data' => $repoPost->findAll()
		));
	}
	
	public function cadastrarAction()
	{
		// definindo variaveis
		$request = $this->getRequest();
	
		// instanciando services
		$servicePost = $this->getServiceLocator()->get('admin-service-post');
	
		// instanciando o form
		$form = new Post($this->getServiceLocator()->get('servicemanager'));
	
		if ($request->isPost())
		{
			// setando o input filter no orm
			$data = $request->getPost()->toArray();
			$form->setInputFilter(new \Admin\Filter\Post());
			$form->setData($data);
				
			if ($form->isValid())
			{	
				//echo "<pre>";
				//print_r($data);
				//exit;
				if ($servicePost->insert($data, 'Admin\Entity\Post'))
				{
					return $this->redirect()->toUrl('/admin/post');
				}
			}
		}
	
		$view = new ViewModel(array(
				'form' => $form
		));
		$view->setTemplate('admin/post/form.phtml');
	
		return $view;
	}
	
	public function editarAction()
	{
		// definindo variaveis
		$request = $this->getRequest();
		$id = $this->params('id');
	
		// instanciando services
		$servicePost = $this->getServiceLocator()->get('admin-service-post');
	
		// instanciando o repositorio
		$dadosPost = $this->getEm('Admin\Entity\Post')->find($id)->toArray();
	
		// instanciando o form
		$form = new Post($this->getServiceLocator()->get('servicemanager'));
		$form->setData($dadosPost);
	
		if ($request->isPost())
		{
			// setando o input filter no orm
			$data = $request->getPost()->toArray();
			$form->setInputFilter(new \Admin\Filter\Categoria());
			$form->setData($data);
	
			if ($form->isValid())
			{
				if ($servicePost->update($data, 'Admin\Entity\Post', $id))
				{
					return $this->redirect()->toUrl('/admin/post');
				}
			}
		}
	
		$view = new ViewModel(array(
				'form' => $form
		));
		$view->setTemplate('admin/post/form.phtml');
	
		return $view;
	}
	
	public function deleteAction()
	{
		// definindo variaveis
		$id = $this->params('id');
	
		// instanciando services
		$servicePost = $this->getServiceLocator()->get('admin-service-post');
	
		// instanciando o repository
		$dadosCategoria = $this->getEm('Admin\Entity\Post')->find($id);
	
		if ($dadosCategoria)
		{
			if ($servicePost->delete('Admin\Entity\Post', $id))
				return $this->redirect()->toUrl('/admin/post');
		}
	}
	
	
}