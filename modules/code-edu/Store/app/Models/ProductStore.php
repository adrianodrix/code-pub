<?php namespace CodeEdu\Store\Models;

class ProductStore
{
    private $id;
    private $name;
    private $price;
    private $productOriginal;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductOriginal()
    {
        return $this->productOriginal;
    }

    /**
     * @param mixed $productOriginal
     */
    public function setProductOriginal($productOriginal)
    {
        $this->productOriginal = $productOriginal;
        return $this;
    }
}