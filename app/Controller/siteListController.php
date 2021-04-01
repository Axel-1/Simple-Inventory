<?php

namespace App\Controller;

use App\Model\SiteDAO;


$siteCollection = SiteDAO::getAll();

$siteList = array();
foreach ($siteCollection as $key => $val) {
    $siteList[] = array('SiteName' => $val->getSiteName(),
        'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
        'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
}

include_once "../View/header.php";
include_once "../View/siteListView.php";
include_once "../View/footer.php";