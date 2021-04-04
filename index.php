<?php


namespace App\Controller;


require "vendor/autoload.php";

$action = $_GET['action'];

switch ($action) {
    case "dashboard" :
        DashboardController::getInstance()->render();
        break;
    case "productList" :
        ProductListController::getInstance()->render();
        break;
    case "siteList" :
        SiteListController::getInstance()->render();
        break;
    case "monitoringList" :
        MonitoringListController::getInstance()->render();
        break;
    default :
        DashboardController::getInstance()->render();
        break;
}