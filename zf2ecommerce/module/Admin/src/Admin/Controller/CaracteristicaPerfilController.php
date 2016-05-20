<?php

namespace Admin\Controller;

use Zend\Validator\AbstractValidator;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class CaracteristicaPerfilController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\CaracteristicaPerfil';
	protected $filter 		= 'admin-filter-caracteristica-perfil';
	protected $form 		= 'admin-form-caracteristica-perfil';
	protected $service		= 'admin-service-caracteristica-perfil';

	protected $controller	= 'caracteristica-perfil';
	protected $template		= 'admin/caracteristica-perfil/form.phtml';
	protected $order		= array('s.nome' => 'DESC');

	public function cadastrarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();

		$caracteristicas = $this->getEm('Admin\Entity\Caracteristica')->findByStatus(1);
		$arrCaracteristicas = array();

		// instanciando o form
		$form = $this->getServiceLocator()->get($this->form);

		// tratando os dados do filtro vindos do container
		$container = new Container(str_replace("-", "", $this->controller));

		$url = "";
		$url .= isset($container->filtro['params']['pagina']) ? "pagina=" . $container->filtro['params']['pagina'] : "pagina=1";

		if ($request->isPost())
		{
			if ($this->filter != null)
			{
				$form->setInputFilter($this->getServiceLocator()->get($this->filter));
			}

			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

			$data = $request->getPost()->toArray();
			$arrCaracteristicas = count($data['caracteristica']) ? $data['caracteristica'] : array();

			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				if ($service->insert($data))
				{
					$this->flashMessenger()->addMessage(array('success' => 'Cadastro efetuado com sucesso!'));
				}
				else
				{
					$this->flashMessenger()->addMessage(array('error' => 'Houve um erro ao tentar cadastrar o seu registro!'));
				}

				if ($this->module === null)
					return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
				else
					return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . $url);
			}
		}

		$view = new ViewModel(array(
			'form' => $form,
			'controller' => $this->controller,
			'caracteristicas' => $caracteristicas,
			'arrCaracteristicas' => $arrCaracteristicas
		));
		$view->setTemplate($this->template);

		return $view;
	}

	public function editarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');

		// instanciando o form
		$form = $this->getServiceLocator()->get($this->form);

		// tratando os dados do filtro vindos do container
		$container = new Container(str_replace("-", "", $this->controller));

		$url = "?";
		$url .= isset($container->filtro['params']['pagina']) ? "pagina=" . $container->filtro['params']['pagina'] : "pagina=1";

		// get array contendo os dados a ser editado
		$dataEntity = $this->getEm($this->entity)->findToArray($id);
		$form->setData($dataEntity);

		$caracteristicas = $this->getEm('Admin\Entity\Caracteristica')->findByStatus(1);
		$arrCaracteristicas = array();

		if (count($dataEntity['caracteristica'])) {
			foreach ($dataEntity['caracteristica'] as $caracteristica) {
				$arrCaracteristicas[] = $caracteristica->getId();
			}
		}

		if ($request->isPost())
		{
			if ($this->filter != null)
			{
				$form->setInputFilter($this->getServiceLocator()->get($this->filter));
			}

			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

			$data = $request->getPost()->toArray();
			$arrCaracteristicas = count($data['caracteristica']) ? $data['caracteristica'] : array();

			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				if ($service->update($data, $id))
				{
					$this->flashMessenger()->addMessage(array('success' => 'Cadastro editado com sucesso!'));
				}
				else
				{
					$this->flashMessenger()->addMessage(array('error' => 'Houve um erro ao tentar editar o seu registro!'));
				}

				if ($this->module === null)
					return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
				else
					return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . $url);
			}
		}

		$view = new ViewModel(array(
			'form' => $form,
			'controller' => $this->controller,
			'caracteristicas' => $caracteristicas,
			'arrCaracteristicas' => $arrCaracteristicas
		));
		$view->setTemplate($this->template);

		return $view;
	}
}