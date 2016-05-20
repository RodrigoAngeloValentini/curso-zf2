<?php

namespace JVKart\Interfaces;

interface KartInterface
{
	public function setItem($key, $value);
	public function getItem($key);
	public function getItems();
	public function hasItem($key);
	public function hasItems();
	
	public function setCupomBonus($vBonus);
	public function getCupomBonus();
	public function getBonus();
	
	public function getDiscountCode();
	public function setDiscountCode($codDiscountCode);
	
	public function add($item);
	public function delete($key);
	public function clear();
	
	public function blocked();
	public function unlocked();
	public function getSumDuplicateAddItem();
	public function setSumDuplicateAddItem($flag);
	public function addQuantity($key, $qtd);
	public function removeQuantity($key, $qtd);
	public function setNewQuantity($key, $qtd);
}