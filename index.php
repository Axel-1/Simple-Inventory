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
    case "productDelete" :
        ProductController::getInstance($_GET['productID'])->delete();
        break;
    case "siteDetails" :
        SiteController::getInstance($_GET['siteID'])->details();
        break;
    case "siteDelete" :
        SiteController::getInstance($_GET['siteID'])->delete();
        break;
    case "siteEdit" :
        SiteController::getInstance($_GET['siteID'])->edit();
        break;
    case "siteEditSave" :
        SiteController::getInstance($_GET['siteID'])->save();
        break;
    case "monitDelete" :
        MonitoringController::getInstance()->delete();
        break;
    case "monitEdit" :
        MonitoringController::getInstance()->edit();
        break;
    case "monitEditSave" :
        MonitoringController::getInstance()->save();
        break;
    case "warrantyDelete" :
        WarrantyController::getInstance()->delete();
        break;
    case "warrantyEdit" :
        WarrantyController::getInstance()->edit();
        break;
    case "warrantyEditSave" :
        WarrantyController::getInstance()->save();
        break;
    default :
        DashboardController::getInstance()->render();
        break;
}