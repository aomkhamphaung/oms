<?php
include_once __DIR__ . '/../includes/db.php';

class Category
{
    private $pdo;
    public function getCategoryList()
    {
        //1. get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "Select * from categories";

        //3. prepare sql
        $statement = $this->pdo->prepare($sql);

        //4. execute statement
        $statement->execute();

        //5. result
        $categories = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $categories;
    }

    public function getParent()
    {
        //1. get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "Select * from categories where parent = 0";

        //3. prepare sql
        $statement = $this->pdo->prepare($sql);

        //4. execute statement
        $statement->execute();

        //5. result
        $result = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $result;
    }

    public function addCat($name, $parent)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into categories(name, parent) values (:name, :parent)";
        $statement = $this->pdo->prepare($sql);
        //binding parameters
        $statement->bindParam(":name", $name);
        $statement->bindParam(":parent", $parent);

        //$statement->execute();

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCatInfo($id)
    {
        //1. get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "Select * from categories where id = :id";

        //3. prepare sql
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);

        //4. execute statement
        $statement->execute();

        //5. result
        $result = $statement->fetch(pdo::FETCH_ASSOC);
        return $result;
    }

    public function updateCat($id, $name, $parent)
    {
        //1. get connection
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "update categories set name = :name, parent = :parent where id = :id";

        //3. prepare sql
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":parent", $parent);

        //4. execute statement
        return $statement->execute();

    }

    public function deleteCat($id)
    {
        try {
            //1. get connection
            $this->pdo = Database::connect();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //2. write sql
            $sql = "delete from categories where id=:id";

            //3. prepare sql
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(":id", $id);

            $sql1 = "select * from categories where parent = :id";
            $statement1 = $this->pdo->prepare($sql1);
            $statement1->bindParam(":id", $id);
            $statement1->execute();
            $children = $statement1->fetchAll(PDO::FETCH_ASSOC);
            if (count($children) > 0) {
                return false;
            } else {
                //4. execute statement
                return $statement->execute();
            }




        } catch (PDOException $e) {
            return false;
        }

    }

    public function getCategoriesPage($page)
    {
        $item_per_page = 5;
        $offset = ($page - 1) * $item_per_page;
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from categories limit $offset, $item_per_page";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(pdo::FETCH_ASSOC);
        return $result;
    }
}

?>