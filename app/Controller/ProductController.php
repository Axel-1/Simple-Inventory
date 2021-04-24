<?php


namespace App\Controller;


use App\Model\DigitalProduct;
use App\Model\PhysicalProduct;
use App\Model\Product;
use App\Model\ProductDAO;
use App\Model\SiteDAO;

class ProductController
{
    private static ProductController $_instance;
    private Product $product;
    private array $productDetails;
    private array $siteDetails;
    private ?array $warrantiesList;
    private ?array $monitoringDetails;
    private string $activePage;

    private function __construct(int $productID)
    {
        // Retrieving data from the database and instantiating objects
        $this->product = ProductDAO::getProductByID($productID);

        if ($this->product instanceof PhysicalProduct) {
            // Retrieving data from the database and instantiating objects
            $warrantiesCollection = $this->product->getWarranties();
            // List of warranties
            foreach ($warrantiesCollection as $key => $val) {
                $this->warrantiesList[] = array('WarrantyID' => $val->getWarrantyID(),
                    'WarrantyName' => $val->getWarrantyName(),
                    'ExpDate' => $val->getExpirationDate()->format("Y-m-d"));
            }

            // Retrieving data from the database and instantiating objects
            $monitoring = $this->product->getProductMonitoring();
            // Monitoring details
            if (!is_null($monitoring)) {
                $this->monitoringDetails = array('MonitID' => $monitoring->getMonitID(),
                    'IP' => $monitoring->getIP(),
                    'LastPing' => $monitoring->getLastPing()->format("Y-m-d h:i A"),
                    'Status' => $monitoring->isUp());
            }

            // Retrieving data from the database and instantiating objects
            $site = $this->product->getSite();
            // Site details
            $this->siteDetails = array('SiteID' => $site->getSiteID(),
                'SiteName' => $site->getSiteName());

            // Preparing the data that will be sent to the view
            $this->productDetails = array('ProductID' => $this->product->getProductID(),
                'ProductName' => $this->product->getProductName(),
                'Manufacturer' => $this->product->getManufacturer(),
                'ModelNo' => $this->product->getModelNo(),
                'SerialNo' => $this->product->getSerialNo(),
                'PurchaseDate' => $this->product->getPurchaseDate()->format("Y-m-d"),
                'BillPath' => $this->product->getBillPath(),
                'Type' => "Physical",
                'Hostname' => $this->product->getHostname(),
                'Site' => $this->siteDetails,
                'Warranties' => isset($this->warrantiesList) ? $this->warrantiesList : null,
                'Monitoring' => isset($this->monitoringDetails) ? $this->monitoringDetails : null);
        } elseif ($this->product instanceof DigitalProduct) {
            // Preparing the data that will be sent to the view
            $this->productDetails = array('ProductID' => $this->product->getProductID(),
                'ProductName' => $this->product->getProductName(),
                'Manufacturer' => $this->product->getManufacturer(),
                'ModelNo' => $this->product->getModelNo(),
                'SerialNo' => $this->product->getSerialNo(),
                'PurchaseDate' => $this->product->getPurchaseDate()->format("Y-m-d"),
                'BillPath' => $this->product->getBillPath(),
                'Type' => "Digital",
                'ExpDate' => $this->product->getExpirationDate()->format("Y-m-d"));
        }

    }

    public static function getInstance(int $productID): ProductController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($productID);
        }
        return self::$_instance;
    }

    public function edit(): void
    {
        if ($this->product instanceof PhysicalProduct) {
            $siteCollection = SiteDAO::getAll();
            foreach ($siteCollection as $key => $val) {
                if ($key != $this->product->getSite()->getSiteID()) {
                    $siteList[$val->getSiteID()] = $val->getSiteName();
                }
            }
        }
        $this->activePage = "productList";
        include_once "app/View/header.php";
        include_once "app/View/productEditView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        if ($this->product instanceof PhysicalProduct) {
            $this->product->setProductName($_POST["inputProdName"]);
            $this->product->setHostname($_POST["inputProdHostname"]);
            $this->product->setManufacturer($_POST["inputProdManufacturer"]);
            $this->product->setModelNo($_POST["inputProdModelNo"]);
            $this->product->setSerialNo($_POST["inputProdSerialNo"]);
            $this->product->setPurchaseDate(date_create($_POST["inputProdPurchaseDate"]));
            $this->product->setBillPath($_POST["inputProdBillPath"]);
            $this->product->setSite(SiteDAO::getSiteByID($_POST["inputProdSite"]));
        } elseif ($this->product instanceof DigitalProduct) {
            $this->product->setProductName($_POST["inputProdName"]);
            $this->product->setExpirationDate(date_create($_POST["inputProdExpDate"]));
            $this->product->setManufacturer($_POST["inputProdManufacturer"]);
            $this->product->setModelNo($_POST["inputProdModelNo"]);
            $this->product->setSerialNo($_POST["inputProdSerialNo"]);
            $this->product->setPurchaseDate(date_create($_POST["inputProdPurchaseDate"]));
            $this->product->setBillPath($_POST["inputProdBillPath"]);
        }
        $this->product->persist();
        self::$_instance = new self($_GET['productID']);
        self::$_instance->details();
    }

    public function details(): void
    {
        $this->activePage = "productList";
        include_once "app/View/header.php";
        include_once "app/View/productDetailsView.php";
        include_once "app/View/footer.php";
    }

    public function delete(): void
    {
        $this->product->delete();
        ProductListController::getInstance()->render();
    }
}