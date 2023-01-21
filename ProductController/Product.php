<?php

namespace ProductController;


abstract class Product
{
    private $sku;
    private $name;
    private $price;   // in $

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sku = rand(10000000, 99999999); // unique key
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function getSku()
    {
        return $this->sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    abstract public function getDetails();
}

class DiscProduct extends Product
{
    private $size;    // in MB

    public function __construct($name, $price, $size)
    {
        parent::__construct($name, $price);
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getDetails()
    {
        return "DiscProduct : Name - " . $this->getName() . ", Price - " . $this->getPrice() . ", Size - " . $this->getSize();
    }
}

class BookProduct extends Product
{
    private $weight;  //  in KG

    public function __construct($name, $price, $weight)
    {
        parent::__construct($name, $price);
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getDetails()
    {
        return "BookProduct : Name - " . $this->getName() . ", Price - " . $this->getPrice() . ", Weight - " . $this->getWeight();
    }
}

class FurnitureProduct extends Product
{
    private $dimension;   // in (HxWxL)

    public function __construct($name, $price, $dimension)
    {
        parent::__construct($name, $price);
        $this->dimension = $dimension;
    }

    public function getDimension()
    {
        return $this->dimension;
    }

    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    public function getDetails()
    {
        return "FurnitureProduct : Name - " . $this->getName() . ", Price - " . $this->getPrice() . ", Dimension - " . $this->getDimension();
    }
}