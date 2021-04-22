<?php


namespace App\Controller;


use App\Model\Warranty;
use App\Model\WarrantyDAO;

class WarrantyController
{
    private static WarrantyController $_instance;
    private Warranty $warranty;
    private array $warrantyDetails;
    private string $activePage;

    private function __construct()
    {
        $warrantyID = $_GET['warrantyID'];
        // Retrieving data from the database and instantiating objects
        $this->warranty = WarrantyDAO::getWarrantyByID($warrantyID);
    }

    public static function getInstance(): WarrantyController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function edit()
    {
        // Preparing the data that will be sent to the view
        $this->warrantyDetails = array('WarrantyID' => $this->warranty->getWarrantyID(),
            'ProductID' => $_GET['productID'],
            'WarrantyName' => $this->warranty->getWarrantyName(),
            'ExpDate' => $this->warranty->getExpirationDate()->format("Y-m-d"));

        $this->activePage = "productList";

        include_once "app/View/header.php";
        include_once "app/View/warrantyEditView.php";
        include_once "app/View/footer.php";
    }

    public function save()
    {
        $this->warranty->setWarrantyName($_POST["inputWarrantyName"]);
        $this->warranty->setExpirationDate(date_create($_POST["inputWarrantyExpDate"]));
        $this->warranty->persist();
        ProductController::getInstance($_GET['productID'])->details();
    }
}