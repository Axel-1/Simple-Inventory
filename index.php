<?php


namespace App\Controller;


require "vendor/autoload.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "default";
}

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
        ProductController::getInstance($_GET['productID'])->details();
        break;
    case "productEdit" :
        ProductController::getInstance($_GET['productID'])->edit();
        break;
    case "productEditSave" :
        ProductController::getInstance($_GET['productID'])->save();
        break;
    case "siteDetails" :
        SiteController::getInstance($_GET['siteID'])->details();
        break;
    case "siteEdit" :
        SiteController::getInstance($_GET['siteID'])->edit();
        break;
    case "siteEditSave" :
        SiteController::getInstance($_GET['siteID'])->save();
        break;
    case "monitEdit" :
        MonitoringController::getInstance()->edit();
        break;
    case "monitEditSave" :
        MonitoringController::getInstance()->save();
        break;
    default :
        DashboardController::getInstance()->render();
        break;
}