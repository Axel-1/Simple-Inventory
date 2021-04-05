<?php


namespace App\Controller;


require "vendor/autoload.php";

$action = $_GET['action'];

switch ($action) {
    case "productList" :
        ProductListController::getInstance()->render();
        break;
    case "siteList" :
        SiteListController::getInstance()->render();
        break;
    case "monitoringList" :
        MonitoringListController::getInstance()->render();
        break;
    case "productDetails" :
        ProductDetailsController::getInstance($_GET['productID'])->render();
        break;
    default :
        DashboardController::getInstance()->render();
        break;
}