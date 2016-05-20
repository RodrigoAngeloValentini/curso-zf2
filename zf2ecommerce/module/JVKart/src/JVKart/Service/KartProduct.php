<?php

namespace JVKart\Service;

use JVKart\Interfaces\KartExtraInterface;
use JVKart\Sessions\Kart;

class KartProduct extends Kart implements KartExtraInterface
{
	public function getTotalPrice()
	{
		$totalPrice = 0.0;
		if ($this->hasItems())
		{
			foreach ($this->getItems()->items as $item)
			{
				if ($item->getBonus()) {
					$totalPrice += (float) ($item->getPrice() - $item->getBonus()) * $item->getQuantity();
				} else {
					$totalPrice += (float) ($item->getPrice()) * $item->getQuantity();
				}
			}
			
			$totalPrice -= (float) $this->getCupomBonus() ?: 0;
		}
	
		return $totalPrice;
	}
	
	public function getTotalWeight()
	{
		$totalWeight = 0.0;
		if ($this->hasItems())
		{
			foreach ($this->getItems()->items as $item) {
				$totalWeight += (float) ($item->getWeight() * $item->getQuantity());
			}
		}
	
		return $totalWeight;
	}
}