<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AbstractController extends AbstractActionController
{
	public function getEm($entity = null) 
	{
		if ($entity === null) {
			return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		} else {
			$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
			return $em->getRepository($entity);
		}
	}
	
	public function getEmRef($entity, $id) {
		return $this->getEm()->getReferente($entity, $id);
	}
}