<?php
include_once __DIR__ . '/../includes/db.php';
class Customer
{
    private $pdo;
    public function getCustomerList()
    {
        // 1. Get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Write Sql
        $sql = "select * from customers";
        // Prepare Sql
        $statement = $this->pdo->prepare($sql);
        // execute statement
        $statement->execute();
        //result
        $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $customers;
    }

    public function createCustomer($name, $phone, $email, $address)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into customers(name, phone, email, address) values (:name, :phone, :email, :address)";
        $statement = $this->pdo->prepare($sql);
        //binding parameters
        $statement->bindParam(":name", $name);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":address", $address);
        //$statement->execute();

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
?>