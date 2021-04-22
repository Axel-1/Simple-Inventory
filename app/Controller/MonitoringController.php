<?php


namespace App\Controller;


use App\Model\Monitoring;
use App\Model\MonitoringDAO;

class MonitoringController
{
    private static MonitoringController $_instance;
    private Monitoring $monitoring;
    private array $monitoringDetails;
    private string $activePage;

    private function __construct()
    {
        $monitID = $_GET['monitID'];
        // Retrieving data from the database and instantiating objects
        $this->monitoring = MonitoringDAO::getMonitoringByID($monitID);
    }

    public static function getInstance(): MonitoringController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function edit(): void
    {
        // Preparing the data that will be sent to the view
        $this->monitoringDetails = array('MonitID' => $this->monitoring->getMonitID(),
            'SiteID' => $_GET['siteID'] ?? null,
            'ProductID' => $_GET['productID'] ?? null,
            'IP' => $this->monitoring->getIP(),
            'LastPing' => $this->monitoring->getLastPing()->format("Y-m-d h:i A"));

        if (isset($_GET['siteID'])) {
            $this->activePage = "siteList";
        } elseif (isset($_GET['productID'])) {
            $this->activePage = "productList";
        }

        include_once "app/View/header.php";
        include_once "app/View/monitoringEditView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        $this->monitoring->setIP($_POST["inputMonitIP"]);
        $this->monitoring->persist();
        if (isset($_GET['siteID'])) {
            SiteController::getInstance($_GET['siteID'])->details();
        } elseif (isset($_GET['productID'])) {
            ProductController::getInstance($_GET['productID'])->details();
        }
    }

    public function delete(): void
    {
        $this->monitoring->delete();
    }
}