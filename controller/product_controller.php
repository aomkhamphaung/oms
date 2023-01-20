<?php
include_once __DIR__ . '/../model/product.php';

class ProductController extends Product
{
    public function getProducts()
    {
        $products = $this->getProductList();
        return $products;
    }

    public function getId()
    {
        $id = $this->getCategoryId();
        return $id;
    }

    //public function getCategoryName()
    //{
    //$c_name = $this->getCategory();
    //return $c_name;
    //}

    public function addProduct($category_id, $name, $price, $model, $shape, $color, $brand, $description, $status)
    {
        $result = $this->createProduct($category_id, $name, $price, $model, $brand, $color);
        return $result;
    }
}
?>