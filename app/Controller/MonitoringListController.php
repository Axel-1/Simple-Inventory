<?php


namespace App\Controller;


use App\Model\ProductDAO;

class MonitoringListController
{
    private static MonitoringListController $_instance;
    private array $monitoringList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $monitProdCollection = ProductDAO::getMonitoredProducts();

        // List of monitoring
        $this->monitoringList = array();
        foreach ($monitProdCollection as $key => $val) {
            $this->monitoringList[] = array('ProductName' => $val->getProductName(),
                'ProductID' => $val->getProductID(),
                'IP' => $val->getProductMonitoring()->getIP(),
                'LastPing' => $val->getProductMonitoring()->getLastPing()->format("Y-m-d h:i A"),
                'Status' => $val->getProductMonitoring()->isUp());
        }
    }

    public static function getInstance(): MonitoringListController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "monitoringList";
        include_once "app/View/header.php";
        include_once "app/View/monitoringListView.php";
        include_once "app/View/footer.php";
    }
}