<?php


namespace App\Controller;


use App\Model\PhysicalProduct;
use App\Model\ProductDAO;
use App\Model\WarrantyDAO;
use http\Header;

class WarrantyCreateController
{
    private PhysicalProduct $physicalProduct;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $product = ProductDAO::getProductByID($_GET['productID']);
        if ($product instanceof PhysicalProduct) {
            $this->physicalProduct = $product;
        }
    }

    public static function getInstance(): WarrantyCreateController
    {
        return new self();
    }

    public function create(): void
    {
        $productID = $this->physicalProduct->getProductID();

        $this->activePage = "productList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/warrantyCreateView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        WarrantyDAO::createWarranty($_POST['inputWarrantyName'], date_create($_POST['inputWarrantyExpDate']), $this->physicalProduct);

        // Reloading products details
        header("Location: ?action=productDetails&productID=" . $this->physicalProduct->getProductID());
    }
}