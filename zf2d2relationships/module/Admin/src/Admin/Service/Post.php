<?php

namespace Admin\Service;

use Zend\Stdlib\Hydrator\ClassMethods;

use Admin\Entity\Tag;

class Post extends AbstractService
{
	public function insert(array $data, $entity)
	{
		$data['slug'] = $this->tituloToSlug($data['nome']);
		$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		$data['dta_inc'] = true;
		
		// tratando as tags
		$arrTagsPost = explode(",", $data['tags']);
		$arrTags = array();
		if (count($arrTagsPost))
		{
			foreach ($arrTagsPost as $nomeTag)
			{
				$slugTag = $this->tituloToSlug($nomeTag);
				$emTags = $this->getEm('Admin\Entity\Tag');
				$entityTag = $emTags->findOneBySlug($slugTag);
				
				if ($entityTag) {
					$arrTags[] = $entityTag;
				} else {
					$dataTag = array(
						'nome' => $nomeTag,
						'slug' => $slugTag
					);
					$newTag = new Tag($dataTag);
					$arrTags[] = $newTag;
				}
			}
		}
		
		// setando as tags do post
		$data['tag'] = $arrTags;
	
		return parent::insert($data, $entity);
	}
	
	public function update(array $data, $entity, $id)
	{
		$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		
		// instancianco o entity manager
		$em = $this->getEm();
		
		// instanciar o repository tags
		$repoPost = $this->getEm($entity)->find($id);
		$entity = $this->getEmRef($entity, $id);
		
		// hydrator
		$hydrator = new ClassMethods();
		$hydrator->hydrate($data, $entity);
		
		// tratando as tags
		$arrTagsPost = explode(",", $data['tags']);
		$arrTagsDb = array();
		
		if (count($repoPost->getTag()))
		{
			foreach ($repoPost->getTag() as $tag)
			{
				$arrTagsDb[] = $tag->getNome();
			}
		}
		
		// verificando se tem tags para inserir
		$addTags = array_diff($arrTagsPost, $arrTagsDb);
		$delTags = array_diff($arrTagsDb, $arrTagsPost);
		
		// inserindo as tags
		if (count($addTags))
		{
			foreach ($addTags as $nomeTag)
			{
				$slugTag = $this->tituloToSlug($nomeTag);
				$emTags = $this->getEm('Admin\Entity\Tag');
				$entityTag = $emTags->findOneBySlug($slugTag);
		
				if (!$entityTag) 
				{
					$dataTag = array(
						'nome' => $nomeTag,
						'slug' => $slugTag
					);
					$newTag = new Tag($dataTag);
				} else {
					$newTag = $entityTag;
				}
				
				$entity->addTag($newTag);
			}
		}
		
		// removendo as tags
		if (count($delTags))
		{
			foreach ($delTags as $nomeTag)
			{
				$slugTag = $this->tituloToSlug($nomeTag);
				$emTags = $this->getEm('Admin\Entity\Tag');
				$entityTag = $emTags->findOneBySlug($slugTag);
		
				if ($entityTag) {
					if (count($entityTag->getPost()) == 1)
						$em->remove($entityTag);
					
					$entity->removeTag($entityTag);
				}
			}
		}
	
		$em->persist($entity);
		$em->flush();
		
		return $entity;
	}
}