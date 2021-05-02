<?php


namespace App\Controller;


use App\Model\ProductDAO;

class ProductListController
{
    private array $productList;
    private string $activePage;
    private string $title;

    private function __construct()
    {

    }

    public static function getInstance(): ProductListController
    {
        return new self();
    }

    public function all(): void
    {
        $this->prepareData($productCollection = ProductDAO::getAll());
        $this->title = "Products";
        $this->render();
    }

    private function prepareData(array $productCollection)
    {
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

    private function render()
    {
        $this->activePage = "productList";
        include_once "app/View/header.php";
        include_once "app/View/productListView.php";
        include_once "app/View/footer.php";
    }

    public function searchBySerial(): void
    {
        $this->prepareData($productCollection = ProductDAO::getProductBySerialNo($_POST['inputProdSearch']));
        $this->title = "Search";
        $this->render();
    }
}