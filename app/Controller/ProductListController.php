<?php


namespace App\Controller;


use App\Model\ProductDAO;

class ProductListController
{
    private array $productList;
    private static ProductListController $_instance;
    private string $activePage;

    private function __construct()
    {
        $productCollection = ProductDAO::getAll();

        $this->productList = array();
        foreach ($productCollection as $key => $val) {
            $this->productList[] = array('ProductName' => $val->getProductName(),
                'ModelNo' => $val->getModelNo(),
                'SerialNo' => $val->getSerialNo(),
                'PurchaseDate' => $val->getPurchaseDate()->format("Y-m-d"));
        }
    }

    public static function getInstance(): ProductListController
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "productList";
        include_once "app/View/header.php";
        include_once "app/View/productListView.php";
        include_once "app/View/footer.php";
    }
}