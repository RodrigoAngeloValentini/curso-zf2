<?php

namespace Admin\Controller;

use Admin\Entity\Foto;

use Zend\Validator\AbstractValidator;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

class ProdutoController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Produto';
	protected $filter 		= 'admin-filter-produto';
	protected $form 		= 'admin-form-produto';
	protected $service		= 'admin-service-produto';

	protected $controller	= 'produto';
	protected $template		= 'admin/produto/form.phtml';
	protected $order		= array('s.nome' => 'DESC');

	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');

		// instanciando os services
		$serviceAuth = 1;

		// definindo as variáveis
		$filtro = $this->params()->fromQuery();

		// setando os valores default
		$filtro['ativo'] = isset($filtro['ativo']) ? $filtro['ativo'] : "";
		$filtro['categoria'] = isset($filtro['categoria']) ? $filtro['categoria'] : "";

		$this->setFiltro($filtro);

		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));

		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$categorias = $this->getEm('Admin\Entity\Categoria')->findFilter(array('categoria' => "IS NULL"));

		$paginator = $this->paginator($list, $page);

		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'categorias' => $categorias
		));
	}

	public function cadastrarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();

		$arrCaracteristicas = array();
		$viewCaracteristicas = array();

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

			$data = $request->getPost()->toArray();
			$caracteristicasCheck = isset($data['caracteristica_check']) ? $data['caracteristica_check'] : array();
			$caracteristicasValor = isset($data['caracteristica_valor']) ? $data['caracteristica_valor'] : array();

			if (count($caracteristicasCheck)) {
				foreach ($caracteristicasCheck as $item) {
					$arrCaracteristicas[$item] = $caracteristicasValor[$item];
					$viewCaracteristicas[] = $item;
				}
			}

			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

			$data = $request->getPost()->toArray();
			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				$data['caracteristica'] = $arrCaracteristicas;
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
			'atributosTipo' => $this->getEm('Admin\Entity\AtributoTipo')->findAll(),
			'arrAtributos' => isset($data['atributo']) ? $data['atributo'] : array(),
			'viewCaracteristicas' => $arrCaracteristicas,
			'caracteristicaPerfil' => $this->getEm('Admin\Entity\CaracteristicaPerfil')->findByStatus(1)
		));
		$view->setTemplate($this->template);

		return $view;
	}

	public function editarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');

		//$caracteristicas = $this->getEm('Admin\Entity\Caracteristica')->findByStatus(1);
		$arrCaracteristicas = array();
		$viewCaracteristicas = array();

		// instanciando o form
		$form = $this->getServiceLocator()->get($this->form);

		// tratando os dados do filtro vindos do container
		$container = new Container(str_replace("-", "", $this->controller));

		$url = "?";
		$url .= isset($container->filtro['params']['pagina']) ? "pagina=" . $container->filtro['params']['pagina'] : "pagina=1";

		// get array contendo os dados a ser editado
		$dataEntity = $this->getEm($this->entity)->findToArray($id);
		$caracteristicas = $dataEntity['caracteristica'];
		if (count($caracteristicas)) {
			foreach ($caracteristicas as $itemCaracteristica) {
				$viewCaracteristicas[] = $itemCaracteristica->getCaracteristica()->getId();
			}
		}

		$form->setData($dataEntity);

		if ($request->isPost())
		{
			if ($this->filter != null)
			{
				$form->setInputFilter($this->getServiceLocator()->get($this->filter));
			}

			$data = $request->getPost()->toArray();
			$caracteristicasCheck = isset($data['caracteristica_check']) ? $data['caracteristica_check'] : array();
			$caracteristicasValor = isset($data['caracteristica_valor']) ? $data['caracteristica_valor'] : array();

			if (count($caracteristicasCheck)) {
				foreach ($caracteristicasCheck as $item) {
					$arrCaracteristicas[$item] = $caracteristicasValor[$item];
					$viewCaracteristicas[] = $item;
				}
			}

			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

			$data = $request->getPost()->toArray();
			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				$data['caracteristica'] = $arrCaracteristicas;
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

		$atritubosDB = $dataEntity['atributo'] ? $dataEntity['atributo']->toArray() : array();
		$arrAtributos = array();
		if (count($atritubosDB)) {
			foreach ($atritubosDB as $atributo) {
				$arrAtributos[$atributo->getId()] = $atributo->getId();
			}
		}

		$view = new ViewModel(array(
			'form' => $form,
			'controller' => $this->controller,
			'atributosTipo' => $this->getEm('Admin\Entity\AtributoTipo')->findAll(),
			'arrAtributos' => $arrAtributos,
			'caracteristicas' => $caracteristicas,
			'viewCaracteristicas' => $viewCaracteristicas,
			'caracteristicaPerfil' => $this->getEm('Admin\Entity\CaracteristicaPerfil')->findByStatus(1)
		));
		$view->setTemplate($this->template);

		return $view;
	}

	public function fotoAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');
		$imagem = null;

		$produto = $this->getEm('Admin\Entity\Produto')->find($id);

		if ($request->isPost())	{
			$upload = new \JVUpload\Service\Upload($this->getServiceLocator()->get('servicemanager'));
			$result = $upload->setType('image')
				->setRename()
			    ->setThumb(array('destination' => '/arquivos/produtos/thumbs/' . $id, 'width' => 200, 'height' => 250, 'cropimage' => array(2,0,40,40,50,50)))
			    ->setExtValidation('ext-image-min')
			    ->setSizeValidation(array('10', '1000')) // validation of the file size in KB array (min max).
			    ->setDestination('/arquivos/produtos/' . $id)
			    ->prepare()->execute();

			$imagem = $result['files']['foto'];

			if ($imagem) {
				$data['arquivo'] = $imagem;
				$data['codigo'] = 0;
				$data['produto'] = $id;

				$serviceFoto = $this->getServiceLocator()->get('admin-service-foto');
				$serviceFoto->insert($data);

				return $this->redirect()->toRoute('admin/default', array('controller' => 'produto', 'action' => 'foto', 'id' => $id));
			}
		}

		$view = new ViewModel(array(
			'fotos' => $produto->getFoto(),
			'id' => $id
		));

		return $view;
	}

	public function fotoExcluirAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');
		$diretorio = $request->getServer('DOCUMENT_ROOT') . "/arquivos/produtos";
		$serviceFoto = $this->getServiceLocator()->get('admin-service-foto');

		$foto = $this->getEm('Admin\Entity\Foto')->find($id);

		$enderecoFoto = $diretorio . "/" . $foto->getProduto()->getId() . "/" . $foto->getArquivo();
		$enderecoThumb = $diretorio . "/thumbs/" . $foto->getProduto()->getId() . "/" . $foto->getArquivo();

		if ($foto) {
			if ($serviceFoto->delete($id)) {
				if (is_file($enderecoFoto)) {
					unlink($enderecoFoto);
				}
				if (is_file($enderecoThumb)) {
					unlink($enderecoThumb);
				}
			}
		}

		return $this->redirect()->toRoute('admin/default', array('controller' => 'produto', 'action' => 'foto', 'id' => $foto->getProduto()->getId()));
	}

	public function getCaracteristicasAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$arrCaracteristicas = array();
		$id = $this->params('id');

		$caracteristicas = $this->getEm('Admin\Entity\CaracteristicaPerfil')->findOneBy(array('id' => $id, 'status' => 1));
		if ($caracteristicas) {
			foreach ($caracteristicas->getCaracteristica() as $caracteristica) {
				$arrCaracteristicas[] = array(
					'id' => $caracteristica->getId(),
					'nome' => $caracteristica->getNome(),
					'valor' => $caracteristica->getValor()
				);
			}
		}

		return $this->getResponse()->setContent(Json::encode($arrCaracteristicas));
	}
}



