<?php
include_once __DIR__ . '/../includes/db.php';

class Product
{
    private $pdo;
    public function getProductList()
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from products";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getCategoryId()
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from categories";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $category_id = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $category_id;
    }

    public function createProduct($category_id, $name, $price, $model, $brand, $color)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into products(category_id, name, price, model, brand, color) values (:category_id, :name, :price, :model, :brand, :color)";
        $statement = $this->pdo->prepare($sql);
        //binding parameters
        $statement->bindParam(":category_id", $category_id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":model", $model);
        $statement->bindParam(":brand", $brand);
        $statement->bindParam(":color", $color);


        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>