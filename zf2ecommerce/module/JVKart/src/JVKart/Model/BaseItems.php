<?php

namespace JVKart\Model;

class BaseItems
{
	protected $id = 0;
    protected $productCode = '';
	protected $idCategory = 0;
	protected $nameCategory = '';
	protected $description = '';
    protected $slug = '';
	protected $image = '';
	protected $price = 0.0;
	protected $quantity = 1;
	protected $bonus = 0.0;
	protected $weight = 0.0;
    protected $attributes = array();

	public function getId()
	{
	    return $this->id;
	}

	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * @param string $productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        return $this;
    }

	public function getIdCategory()
	{
	    return $this->idCategory;
	}

	public function setIdCategory($idCategory)
	{
	    $this->idCategory = $idCategory;
	    return $this;
	}

	public function getNameCategory()
	{
	    return $this->nameCategory;
	}

	public function setNameCategory($nameCategory)
	{
	    $this->nameCategory = $nameCategory;
	    return $this;
	}

	public function getDescription()
	{
	    return $this->description;
	}

	public function setDescription($description)
	{
	    $this->description = $description;
	    return $this;
	}

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

	public function getPrice()
	{
	    return $this->price;
	}

	public function setPrice($price)
	{
	    $this->price = $price;
	    return $this;
	}

	public function getQuantity()
	{
	    return $this->quantity;
	}

	public function setQuantity($quantity)
	{
	    $this->quantity = $quantity;
	    return $this;
	}
	
	public function getWeight()
	{
	    return $this->weight;
	}

	public function setWeight($weight)
	{
	    $this->weight = $weight;
	    return $this;
	}

	public function getBonus()
	{
	    return $this->bonus;
	}

	public function setBonus($bonus)
	{
	    $this->bonus = $bonus;
	    return $this;
	}

	public function getImage()
	{
	    return $this->image;
	}

	public function setImage($image)
	{
	    $this->image = $image;
	    return $this;
	}

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

}