<?php

namespace Admin\Controller;

use Admin\Form\Categoria;

use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractController
{
	public function indexAction()
	{
		// carregando os repositories
		$repoCategoria = $this->getEm('Admin\Entity\Categoria');

		return new ViewModel(array(
			'data' => $repoCategoria->findAll()
		));
	}
	
	public function cadastrarAction()
	{
		// definindo variaveis
		$request = $this->getRequest();
		
		// instanciando services
		$serviceCategoria = $this->getServiceLocator()->get('admin-service-categoria');
		
		// instanciando o form
		$form = new Categoria();
		
		if ($request->isPost()) 
		{
			// setando o input filter no orm
			$data = $request->getPost()->toArray();
			$form->setInputFilter(new \Admin\Filter\Categoria());
			$form->setData($data);
			
			if ($form->isValid())
			{
				if ($serviceCategoria->insert($data, 'Admin\Entity\Categoria'))
				{
					return $this->redirect()->toUrl('/admin/categoria');
				}
			}
		}
		
		$view = new ViewModel(array(
			'form' => $form
		));
		$view->setTemplate('admin/categoria/form.phtml');
		
		return $view;
	}
	
	public function editarAction()
	{
		// definindo variaveis
		$request = $this->getRequest();
		$id = $this->params('id');
		
		// instanciando services
		$serviceCategoria = $this->getServiceLocator()->get('admin-service-categoria');
		
		// instanciando o repository
		$dadosCategoria = $this->getEm('Admin\Entity\Categoria')->find($id)->toArray();
		
		// instanciando o form
		$form = new Categoria();
		$form->setData($dadosCategoria);
		
		if ($request->isPost()) 
		{
			// setando o input filter no orm
			$data = $request->getPost()->toArray();
			$form->setInputFilter(new \Admin\Filter\Categoria());
			$form->setData($data);
			
			if ($form->isValid())
			{
				if ($serviceCategoria->update($data, 'Admin\Entity\Categoria', $id))
				{
					return $this->redirect()->toUrl('/admin/categoria');
				}
			}
		}
		
		$view = new ViewModel(array(
			'form' => $form
		));
		$view->setTemplate('admin/categoria/form.phtml');
		
		return $view;
	}
	
	public function deleteAction()
	{
		// definindo variaveis
		$id = $this->params('id');
		
		// instanciando services
		$serviceCategoria = $this->getServiceLocator()->get('admin-service-categoria');
		
		// instanciando o repository
		$dadosCategoria = $this->getEm('Admin\Entity\Categoria')->find($id);
		
		if ($dadosCategoria)
		{
			if ($serviceCategoria->delete('Admin\Entity\Categoria', $id))
				return $this->redirect()->toUrl('/admin/categoria');
		}
	}
}