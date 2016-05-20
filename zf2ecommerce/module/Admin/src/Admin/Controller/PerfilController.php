<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;

class PerfilController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Perfil';
	protected $filter 		= 'admin-filter-perfil';
	protected $form 		= 'admin-form-perfil';
	protected $service		= 'admin-service-perfil';
	
	protected $controller	= 'perfil';
	protected $template		= 'admin/perfil/form.phtml';
	protected $order		= array('s.id' => 'ASC');
	
	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
	
		// instanciando os services
		$serviceAuth = 1;
	
		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		
		// setando os valores default
		$filtro['perfil'] = isset($filtro['perfil']) ? $filtro['perfil'] : "";
		
		$this->setFiltro($filtro);
	
		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
	
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$perfilParent = $this->getEm($this->entity)->findFilter(array('perfil' => "IS NULL"));
		
		$paginator = $this->paginator($list, $page);
	
		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'perfil' => $perfilParent
		));
	}
	
	public function permissoesAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
		
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');
		
		// services
		$serviceAcl = $this->getServiceLocator()->get('admin-service-acl');
		
		// definindo variáveis
		$arrayPerfil = array();
		$arrayResourcesSelecionados = array();
		$arrayResourcesOutroPerfil = array();
		$arrayAclPerfil = array();
		$arrayPerfilClass = array();
		
		$perfil = $this->getEm('Admin\Entity\Perfil')->find($id);
		$resources = $this->getEm('Admin\Entity\Resource')->findAll();
		$dadosAcl = $this->getEm('Admin\Entity\Acl')->findAll();
		
		if (count($dadosAcl)) {
			foreach ($dadosAcl as $acl) {
				$arrayPerfil[$acl->getResource()->getId()] = $acl->getPerfil()->getNome();
				$arrayAclPerfil[$acl->getResource()->getId()] = $acl->getId();
				
				switch ($acl->getPerfil()->getId()) {
					case 2:
						$arrayPerfilClass[$acl->getPerfil()->getNome()] = 'label-success';
						break;
					case 3:
						$arrayPerfilClass[$acl->getPerfil()->getNome()] = 'label-info';
						break;
					case 4:
						$arrayPerfilClass[$acl->getPerfil()->getNome()] = 'label-primary';
						break;
					case 5:
						$arrayPerfilClass[$acl->getPerfil()->getNome()] = 'label-warning';
						break;
					case 6:
						$arrayPerfilClass[$acl->getPerfil()->getNome()] = 'label-danger';
						break;
				}
				
				if ($acl->getPerfil()->getId() != $id) {
					$arrayResourcesOutroPerfil[] = $acl->getResource()->getId();
				} else {
					$arrayResourcesSelecionados[] = $acl->getResource()->getId();
				}
			}
		}
		
		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			
			$arrayResourceCadastrar = array_diff($data['resource'], $arrayResourcesSelecionados);
			$arrayResourceExcluir = array_diff($arrayResourcesSelecionados, $data['resource']);
			
			if (count($arrayResourceCadastrar)) {
				foreach ($arrayResourceCadastrar as $idResource) {
					$dadaResourceCadastrar = array();
					$dadaResourceCadastrar['perfil'] = $this->getEmRef('Admin\Entity\Perfil', $id);
					$dadaResourceCadastrar['resource'] = $this->getEmRef('Admin\Entity\Resource', $idResource);
					$dadaResourceCadastrar['permissao'] = 'allow';
					
					$serviceAcl->insert($dadaResourceCadastrar);
				}
			}
			
			if (count($arrayResourceExcluir)) {
				foreach ($arrayResourceExcluir as $idResource) {
					$serviceAcl->delete($arrayAclPerfil[$idResource]);
				}
			}
			
			$this->flashMessenger()->addMessage(array('success' => 'As alterações das permissões foi um sucesso!'));
			$this->redirect()->toRoute('admin/default', array('controller' => 'perfil', 'action' => 'permissoes', 'id' => $id));
		}
		
		return new ViewModel(array(
			'perfil' => $perfil,
			'resources' => $resources,
			'arrayPerfil' => $arrayPerfil,
			'arrayPerfilClass' => $arrayPerfilClass,
			'arrayResourcesSelecionados' => $arrayResourcesSelecionados,
			'arrayResourcesOutroPerfil' => $arrayResourcesOutroPerfil
		));
		
	}
	
}