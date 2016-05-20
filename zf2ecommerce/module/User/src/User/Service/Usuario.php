<?php

namespace User\Service;

use Zend\Stdlib\Hydrator\ClassMethods;

use Admin\Entity\Endereco;
use Admin\Entity\DadosPessoais;
use Admin\Service\AbstractService;

class Usuario extends AbstractService
{
	protected $entity = 'Admin\Entity\Usuario'; 
	
	public function insert(array $data, $entity = null)
	{
		$this->getEm()->getConnection()->beginTransaction();
		
		try {
			// Persistindo Usuario
			$dataUsuario['nome'] = $data['usuario_nome'];
			$dataUsuario['email'] = $data['email'];
			$dataUsuario['senha'] = $data['senha'];
			$dataUsuario['perfil'] = $this->getEmRef('Admin\Entity\Perfil', 3);
			$dataUsuario['dta_inc'] = true;
			$dataUsuario['status'] = "0";
			$dataUsuario['token'] = $this->getToken();
			
			$entityUsuario = new $this->entity($dataUsuario);
			$this->getEm()->persist($entityUsuario);
			$this->getEm()->flush();
			
			// Persistindo Endereço
			$dataEndereco['nome'] = 'Padrão';
			$dataEndereco['logradouro'] = $data['logradouro'];
			$dataEndereco['numero'] = $data['numero'];
			$dataEndereco['complemento'] = $data['complemento'];
			$dataEndereco['bairro'] = $data['bairro'];
			$dataEndereco['cidade'] = $data['cidade'];
			$dataEndereco['estado'] = $data['estado'];
			$dataEndereco['cep'] = $data['cep'];
			$dataEndereco['usuario'] = $entityUsuario;
			
			$entityEndereco = new Endereco($dataEndereco);
			$this->getEm()->persist($entityEndereco);
			$this->getEm()->flush();
			
			// Persistindo Dados Pessoais
			$dataDadosPessoais['rg'] = $data['rg'];
			$dataDadosPessoais['cpf'] = $data['cpf'];
			$dataDadosPessoais['telefone'] = $data['telefone'];
			$dataDadosPessoais['celular'] = $data['celular'];
			$dataDadosPessoais['usuario'] = $entityUsuario;
			
			$entityDadosPessoais = new DadosPessoais($dataDadosPessoais);
			$this->getEm()->persist($entityDadosPessoais);
			$this->getEm()->flush();
			
			$this->getEm()->getConnection()->commit();
			
			return $entityUsuario;
		} catch (\Exception $e) {
			$this->getEm()->getConnection()->rollback();
			throw new \Exception($e->getMessage());
		}
	}
	
	public function update(array $data, $id, $entity = null)
	{
		$dataUsuario['nome'] = $data['usuario_nome'];
		$dataUsuario['email'] = $data['email'];
		
		if ($data['senha'] != "") {
			$dataUsuario['senha'] = $data['senha'];
		}
		
		return parent::update($dataUsuario, $id);
	}
	
	public function editarDadosPessoais($data, $idUsuario) 
	{
		$dadosPessoais = $this->getEm('Admin\Entity\DadosPessoais')->findOneByUsuario($idUsuario);
		
		$hydrator = new ClassMethods();
		$hydrator->hydrate($data, $dadosPessoais);
		
		$this->getEm()->persist($dadosPessoais);
		$this->getEm()->flush();
		
		return $dadosPessoais;
	}
}