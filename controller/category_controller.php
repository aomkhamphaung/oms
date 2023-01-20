<?php
include_once __DIR__ . '/../model/category.php';
class CategoryController extends Category
{
    public function getCategories()
    {
        $categories = $this->getCategoryList();
        return $categories;
    }

    public function getParents()
    {
        $parents = $this->getParent();
        return $parents;
    }

    public function addCategory($name, $parent)
    {
        $result = $this->addCat($name, $parent);
        return $result;
    }

    public function getCategory($id)
    {
        $result = $this->getCatInfo($id);
        return $result;
    }

    public function updateCategory($id, $name, $parent)
    {
        $result = $this->updateCat($id, $name, $parent);
        return $result;
    }

    public function deleteCategory($id)
    {
        $result = $this->deleteCat($id);
        return $result;
    }

    public function getCategoriesPage($page)
    {
        $result = parent::getCategoriesPage($page);
        return $result;
    }
}
?>