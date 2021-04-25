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
        ProductController::getInstance()->details();
        break;
    case "productEdit" :
        ProductController::getInstance()->edit();
        break;
    case "productEditSave" :
        ProductController::getInstance()->save();
        break;
    case "productCreate" :
        ProductCreateController::getInstance()->create();
        break;
    case "productCreateSave" :
        ProductCreateController::getInstance()->save();
        break;
    case "productDelete" :
        ProductController::getInstance()->delete();
        break;
    case "siteDetails" :
        SiteController::getInstance()->details();
        break;
    case "siteDelete" :
        SiteController::getInstance()->delete();
        break;
    case "siteEdit" :
        SiteController::getInstance()->edit();
        break;
    case "siteEditSave" :
        SiteController::getInstance()->save();
        break;
    case "siteCreate" :
        SiteCreateController::getInstance()->create();
        break;
    case "siteCreateSave" :
        SiteCreateController::getInstance()->save();
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
    case "monitCreate" :
        MonitoringCreateController::getInstance()->create();
        break;
    case "monitCreateSave" :
        MonitoringCreateController::getInstance()->save();
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
    case "warrantyCreate" :
        WarrantyCreateController::getInstance()->create();
        break;
    case "warrantyCreateSave" :
        WarrantyCreateController::getInstance()->save();
        break;
    default :
        DashboardController::getInstance()->render();
        break;
}