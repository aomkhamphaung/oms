<?php
include_once 'controller/category_controller.php';

$categoryController = new CategoryController();
$id = $_POST['id'];
$result = $categoryController->deleteCategory($id);

if ($result) {
    echo 'success';
} else {
    echo 'fail';
}

?>