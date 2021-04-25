<?php


namespace App\Controller;


use App\Model\MonitoringDAO;
use App\Model\PhysicalProduct;
use App\Model\ProductDAO;

class MonitoringCreateController
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

    public static function getInstance(): MonitoringCreateController
    {
        return new self();
    }

    public function create(): void
    {
        $productID = $this->physicalProduct->getProductID();

        $this->activePage = "productList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/monitoringCreateView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        $this->physicalProduct->setProductMonitoring(MonitoringDAO::createMonitoring($_POST['inputMonitIP']));
        $this->physicalProduct->persist();

        // Reloading products details
        ProductController::getInstance()->details();
    }
}