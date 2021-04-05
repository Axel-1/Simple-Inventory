<?php


namespace App\Controller;


use App\Model\MonitoringDAO;

class MonitoringListController
{
    private static MonitoringListController $_instance;
    private array $monitoringList;
    private string $activePage;

    private function __construct()
    {
        $monitoringCollection = MonitoringDAO::getAllProductMonitoring();

        $this->monitoringList = array();
        foreach ($monitoringCollection as $key => $val) {
            $this->monitoringList[] = array('IP' => $val->getIP(),
                'LastPing' => $val->getLastPing()->format("Y-m-d h:i A"),
                'Status' => $val->isUp());
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