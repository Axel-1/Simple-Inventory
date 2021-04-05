<?php


namespace App\Controller;


use App\Model\ProductDAO;

class ProductListController
{
    private static ProductListController $_instance;
    private array $productList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $productCollection = ProductDAO::getAll();
        // Preparing the data that will be sent to the view
        $this->productList = array();
        foreach ($productCollection as $key => $val) {
            $this->productList[] = array('ProductName' => $val->getProductName(),
                'ModelNo' => $val->getModelNo(),
                'SerialNo' => $val->getSerialNo(),
                'PurchaseDate' => $val->getPurchaseDate()->format("Y-m-d"),
                'ProductID' => $val->getProductID());
        }
    }

    public static function getInstance(): ProductListController
    {
        if (!isset(self::$_instance)) {
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