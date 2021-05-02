<?php


namespace App\Controller;


use App\Model\ProductDAO;
use App\Model\SiteDAO;

class ProductCreateController
{
    private string $activePage;
    private string $productType;

    private function __construct()
    {
        $this->productType = $_GET['productType'];
    }

    public static function getInstance(): ProductCreateController
    {
        return new self();
    }

    public function create(): void
    {
        if ($this->productType == "Physical") {
            $siteCollection = SiteDAO::getAll();
            foreach ($siteCollection as $key => $val) {
                $siteList[$val->getSiteID()] = $val->getSiteName();
            }
        }

        $this->activePage = "productList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/productCreateView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        if ($this->productType == "Physical") {
            $product = ProductDAO::createPhysicalProduct($_POST["inputProdName"],
                $_POST["inputProdManufacturer"],
                $_POST["inputProdModelNo"],
                $_POST["inputProdSerialNo"],
                date_create($_POST["inputProdPurchaseDate"]),
                "",
                $_POST["inputProdHostname"],
                SiteDAO::getSiteByID($_POST["inputProdSite"]));
        } elseif ($this->productType == "Digital") {
            $product = ProductDAO::createDigitalProduct($_POST["inputProdName"],
                $_POST["inputProdManufacturer"],
                $_POST["inputProdModelNo"],
                $_POST["inputProdSerialNo"],
                date_create($_POST["inputProdPurchaseDate"]),
                "",
                date_create($_POST["inputProdExpDate"]));
        }

        // Saving PDF file
        move_uploaded_file($_FILES['inputProdBill']['tmp_name'], "upload/" . $product->getProductID() . ".pdf");
        $product->setBillPath("upload/" . $product->getProductID() . ".pdf");
        $product->persist();

        // Reloading products details
        header("Location: ?action=productDetails&productID=" . $product->getProductID());
    }
}