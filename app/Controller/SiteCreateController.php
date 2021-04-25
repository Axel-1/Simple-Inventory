<?php


namespace App\Controller;


use App\Model\MonitoringDAO;
use App\Model\SiteDAO;

class SiteCreateController
{
    private string $activePage;

    private function __construct()
    {

    }

    public static function getInstance(): SiteCreateController
    {
        return new self();
    }

    public function create(): void
    {
        $this->activePage = "siteList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/siteCreateView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        $_GET['siteID'] = SiteDAO::createSite($_POST['inputSiteName'], $_POST['inputSiteStreet'], $_POST['inputSiteZip'], $_POST['inputSiteCity'], MonitoringDAO::createMonitoring($_POST['inputSiteIP']))->getSiteID();
        // Reloading products details
        SiteController::getInstance()->details();
    }
}