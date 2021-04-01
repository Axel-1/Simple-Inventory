<?php

namespace App\Controller;

use App\Model\MonitoringDAO;
use App\Model\ProductDAO;
use App\Model\SiteDAO;


// Objects instantiations from database
$siteCollection = SiteDAO::getAll();
$productCollection = ProductDAO::getAll();
$phyProdCollection = ProductDAO::getProductByType("p");
$monitoringCollection = MonitoringDAO::getAll();

// Product counter
$productCount = count($productCollection);

// Monitored product counter
$monitProductCount = 0;
foreach ($phyProdCollection as $key => $val) {
    if ($val->getProductMonitoring() != null) {
        $monitProductCount++;
    }
}

// Not responding product counter
$productDownCount = 0;
foreach ($phyProdCollection as $key => $val) {
    if ($val->getProductMonitoring() != null) {
        if(!$val->getProductMonitoring()->isUp()) {
            $productDownCount++;
        }
    }
}

// List of site
$dashSiteList = array();
foreach ($siteCollection as $key => $val) {
    $dashSiteList[] = array('SiteName' => $val->getSiteName(),
        'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
        'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
}


include_once "../View/header.php";
include_once "../View/dashboardView.php";
include_once "../View/footer.php";