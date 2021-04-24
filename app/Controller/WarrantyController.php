<?php


namespace App\Controller;


use App\Model\Warranty;
use App\Model\WarrantyDAO;

class WarrantyController
{
    private Warranty $warranty;
    private array $warrantyDetails;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $this->warranty = WarrantyDAO::getWarrantyByID($_GET['warrantyID']);
    }

    public static function getInstance(): WarrantyController
    {
        return new self();
    }

    public function edit(): void
    {
        $this->prepareData();

        $this->activePage = "productList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/warrantyEditView.php";
        include_once "app/View/footer.php";
    }

    private function prepareData(): void
    {
        // Preparing the data that will be sent to the view
        $this->warrantyDetails = array('WarrantyID' => $this->warranty->getWarrantyID(),
            'ProductID' => $_GET['productID'],
            'WarrantyName' => $this->warranty->getWarrantyName(),
            'ExpDate' => $this->warranty->getExpirationDate()->format("Y-m-d"));
    }

    public function save(): void
    {
        // Setting object properties
        $this->warranty->setWarrantyName($_POST["inputWarrantyName"]);
        $this->warranty->setExpirationDate(date_create($_POST["inputWarrantyExpDate"]));

        // Saving change in the database
        $this->warranty->persist();

        // Reloading details page
        ProductController::getInstance()->details();
    }

    public function delete(): void
    {
        $this->warranty->delete();

        // Reloading products list
        ProductController::getInstance()->details();
    }
}