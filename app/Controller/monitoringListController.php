<?php

namespace App\Controller;

use App\Model\MonitoringDAO;


$monitoringCollection = MonitoringDAO::getAllProductMonitoring();

$monitoringList = array();
foreach ($monitoringCollection as $key => $val) {
    $monitoringList[] = array('IP' => $val->getIP(),
        'LastPing' => $val->getLastPing()->format("Y-m-d"),
        'Status' => $val->isUp());
}

include_once "../View/header.php";
include_once "../View/monitoringListView.php";
include_once "../View/footer.php";