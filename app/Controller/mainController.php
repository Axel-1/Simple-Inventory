<?php


namespace App\Controller;

require "../../vendor/autoload.php";

$action = $_GET['action'];

switch ($action) {
    case "dashboard" :
        $activePage = "dashboard";
        include_once "dashboardController.php";
        break;
    case "productList" :
        $activePage = "productList";
        include_once "productListController.php";
        break;
    case "siteList" :
        $activePage = "siteList";
        include_once "siteListController.php";
        break;
    case "monitoringList" :
        $activePage = "monitoringList";
        include_once "monitoringListController.php";
        break;
    default :
        $activePage = "dashboard";
        include_once "dashboardController.php";
}