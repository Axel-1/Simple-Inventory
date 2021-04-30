<?php


namespace App\Controller;


use App\Model\Monitoring;
use App\Model\MonitoringDAO;

class MonitoringController
{
    private Monitoring $monitoring;
    private array $monitoringDetails;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $this->monitoring = MonitoringDAO::getMonitoringByID($_GET['monitID']);
    }

    public static function getInstance(): MonitoringController
    {
        return new self();
    }

    public function edit(): void
    {
        $this->prepareData();

        if (isset($_GET['siteID'])) {
            $this->activePage = "siteList";
        } elseif (isset($_GET['productID'])) {
            $this->activePage = "productList";
        }

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/monitoringEditView.php";
        include_once "app/View/footer.php";
    }

    private function prepareData(): void
    {
        // Preparing the data that will be sent to the view
        $this->monitoringDetails = array('MonitID' => $this->monitoring->getMonitID(),
            'SiteID' => $_GET['siteID'] ?? null,
            'ProductID' => $_GET['productID'] ?? null,
            'IP' => $this->monitoring->getIP(),
            'LastPing' => $this->monitoring->getLastPing()->format("Y-m-d h:i A"));
    }

    public function save(): void
    {
        // Setting object property
        $this->monitoring->setIP($_POST["inputMonitIP"]);

        // Saving change in the database
        $this->monitoring->persist();

        if (isset($_GET['siteID'])) {
            header("Location: ?action=siteDetails&siteID=" . $_GET['siteID']);
        } elseif (isset($_GET['productID'])) {
            header("Location: ?action=productDetails&productID=" . $_GET['productID']);
        }
    }

    public function delete(): void
    {
        $this->monitoring->delete();

        // Reloading site details or product details
        if (isset($_GET['siteID'])) {
            header("Location: ?action=siteDetails&siteID=" . $_GET['siteID']);
        } elseif (isset($_GET['productID'])) {
            header("Location: ?action=productDetails&productID=" . $_GET['productID']);
        }
    }
}