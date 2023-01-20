<?php
include_once __DIR__ . "/../model/stock.php";

class StockController extends Stock
{
    public function getStock()
    {
        $stock = $this->getStockList();
        return $stock;
    }

    public function getStockInfo($id)
    {
        $stocks = $this->getStocks($id);
        return $stocks;
    }

    public function getProduct()
    {
        $product = $this->getProducts();
        return $product;
    }

    public function addStock($products, $price, $qty, $date)
    {
        $result = $this->createStock($products, $price, $qty, $date);
        return $result;
    }

    public function getProductNameWithId($id)
    {
        $result = $this->getProductById($id);
        return $result;
    }

    public function getPrices()
    {
        $result = $this->getPriceList();
        return $result;
    }
}
?>