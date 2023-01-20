<?php
include_once __DIR__ . '/../includes/db.php';

class Stock
{
    private $pdo;
    public function getStockList()
    {
        //1. get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "Select stocks.id, stocks.product_id, products.name, stocks.qty, stocks.date from stocks join products where stocks.product_id = products.id";

        //3. prepare sql
        $statement = $this->pdo->prepare($sql);

        //4. execute statement
        $statement->execute();

        //5. result
        $stocks = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $stocks;
    }

    public function getStocks($id)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select stocks.id,stocks.product_id,products.name,unit_price,qty,date
        from stocks JOIN products
        WHERE products.id=stocks.product_id and stocks.product_id=$id";
        $statement = $this->pdo->prepare($sql);
        //$statement->bindParam(":id", $id);
        $statement->execute();
        $stocks = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $stocks;
    }

    public function getProducts()
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select * from products";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $products;
    }

    public function createStock($products, $price, $qty, $date)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into stocks (product_id, unit_price, qty, date) values (:product, :price, :qty, :date)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":product", $products);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":qty", $qty);
        $statement->bindParam(":date", $date);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductById($id)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select 
        products.name from products join stocks where products.id = stocks.product_id and products.id = $id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $result;
    }

    public function getPriceList()
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from prices join products where prices.product_id = products.id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $result;
    }
}

?>