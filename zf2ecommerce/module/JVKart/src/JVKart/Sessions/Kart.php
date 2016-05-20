<?php

namespace JVKart\Sessions;

use JVKart\Interfaces\KartInterface;
use JVKart\Model\BaseItems;
use Zend\Session\Container;

class Kart extends BaseItems implements KartInterface
{
	protected $namespace = 'default';
	protected $session = null;
	
	/**
	 * Caso setado como true cada vez que o mesmo item for adicionado
	 * será somada a quantidade + 1
	 * @var sumDuplicateAddItem
	 */
	protected $sumDuplicateAddItem = true;
	
	public function __construct($namespace = null)
	{
		$namespace = $namespace ?: $this->getNamespace();
		$this->setNamespace($namespace);
		
		if (!$this->session instanceof Container) {
			$this->session = new Container($namespace);
			$this->setItemsArray();
			if ($this->isBlocked() === null) { 
				$this->unlocked();
			}
		}
	}
	
	public function setItemsArray()
	{
		if (!isset($this->session->items)) {
			$this->session->offsetSet('items', array());
		}
		
		return $this;
	}
	
	public function getItemsArray()
	{
		return $this->session->items;
	}
	
	public function setExpirationSeconds($seconds, $variables = null)
	{
		$this->session->setExpirationSeconds($seconds, $variables);
		return $this;
	}

	public function getNamespace()
	{
	    return $this->namespace;
	}

	public function setNamespace($namespace)
	{
	    $this->namespace = $namespace;
	}

	public function getSession()
	{
	    return $this->session;
	}

	public function setSession($session)
	{
	    $this->session = $session;
	}

    public function getShipping()
    {
        return isset($this->session->shipping) ? $this->session->shipping : array();
    }

    public function setShipping($codigoFrete, $valorFrete)
    {
        $this->session->shipping = array('codigo' => $codigoFrete, 'valor' => (float) $valorFrete);
    }
	
	/******************** Implementation Interface ********************/
	
	public function setItem($key, $value)
	{
		$key = (int) $key;
		if ((null === $value) && $this->hasItem($key)) {
			$this->delete($key);
		} elseif (null !== $value) {
			$this->session->items->{$key} = $value;
		}
		
		return $this;
	}
	
	public function getItem($key)
	{
		if ($this->hasItem($key)) {
			return $this->session->items[$key];
		}
		
		return false;
	}
	
	public function getItems()
	{
		if ($this->hasItems()) {
			return $this->session->getIterator();
		}
		
		return array();
	}
	
	public function hasItem($key)
	{
		$key = (int) $key;
		return isset($this->session->items[$key]) ? true : false;
	}
	
	public function hasItemAdd($key)
	{
		if ($this->getSumDuplicateAddItem()) {
			$item = $this->getItem($key);
			return $item ? $item->getQuantity() : 0;
		} else {
			$item = $this->getItem($key);
			if (!$item) {
				return 0;
			}
		}
		
		throw new \Exception('Esse item já foi adicionado ao carrinho');
	}
	
	public function hasItems()
	{
		return ($this->session->getIterator()) ? true : false;
	}
	
	public function getCupomBonus()
	{
		return isset($this->session->purchaseBonus) ? $this->session->purchaseBonus : false;
	}
	
	public function setCupomBonus($vBonus)
	{
		if (!$this->isBlocked()) {
			$this->session->purchaseBonus = (float) $vBonus;
			return $this;
		} else {
			throw new \Exception('Carrinho fechado, não é possível aplicar cupom de desconto!');
		}
	}
	
	public function getDiscountCode()
	{
		return isset($this->session->discountCode) ? $this->session->discountCode : false;
	}
	
	public function setDiscountCode($codDiscountCode)
	{
		if (!$this->isBlocked()) {
			$this->session->discountCode = $codDiscountCode;
		} else {
			throw new \Exception('Carrinho fechado, não é possível adicionar descontos!');
		}
	}
	
	public function add($item)
	{
		if (!$this->isBlocked()) {
			if ($qtdOld = $this->hasItemAdd($item->getId())) {
				$item->setQuantity($item->getQuantity() + $qtdOld);
			}
			
			$this->session->items[$item->getId()] = $item;
		} else {
			throw new \Exception('Carrinho fechado, não é possível adicionar mais itens!');
		}
		
		return $this;
	}
	
	public function addQuantity($key, $qtd)
	{
		if (!$this->isBlocked()) {
			$this->session->items[$key]->quantity += $qtd;
		} else {
			throw new \Exception('Carrinho fechado, não é possível alterar a quantidade!');
		}
		
		return $this;
	}
	
	public function removeQuantity($key, $qtd)
	{
		if (!$this->isBlocked()) 
		{
			if ($this->getItem($key)->quantity > 1) {
				$this->session->items[$key]->quantity -= $qtd;
			} else {
				throw new \Exception('A quantidade minima permitida é 1 (um).');
			}
		} else {
			throw new \Exception('Carrinho fechado, não é possível alterar a quantidade!');
		}
		
		return $this;
	}
	
	public function setNewQuantity($key, $qtd)
	{
		if (!$this->isBlocked()) {
			$this->session->items[$key]->quantity = $qtd;
		} else {
			throw new \Exception('Carrinho fechado, não é possível alterar a quantidade!');
		}
		
		return $this;
	}
	
	public function delete($key)
	{
		if (!$this->isBlocked()) {
			if ($this->hasItem($key)) { 
				unset($this->session->items[$key]);
				return true;
			}
		} else {
			throw new \Exception('Carrinho fechado, não é possível excluir os itens!');
		}
		
		return false;
	}
	
	public function sort()
	{
		if ($this->hasItems()) {
			return sort($this->session->items);
		}
		
		return false;
	}
	
	public function count()
	{
		return count($this->getItems());
	}
	
	public function clear()
	{
		if (!$this->isBlocked()) {
			if ($this->hasItems()) 
			{
				unset($this->session->items);

				return true;
			}
		} else {
			throw new \Exception('Carrinho fechado, não é possível excluir os itens!');
		}
	}
	
	public function blocked()
	{
		$this->session->purchaseBlocked = true;
	}
	
	public function unlocked()
	{
		$this->session->purchaseBlocked = false;
	}
	
	public function isBlocked()
	{
		return $this->session->purchaseBlocked;
	}
	
	public function getSumDuplicateAddItem() 
	{
		return $this->sumDuplicateAddItem;
	}
	
	public function setSumDuplicateAddItem($flag)
	{
		$this->sumDuplicateAddItem = $flag;
	}
}




