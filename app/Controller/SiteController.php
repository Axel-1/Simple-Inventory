<?php


namespace App\Controller;


use App\Model\Site;
use App\Model\SiteDAO;

class SiteController
{
    private Site $site;
    private array $siteDetails;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $this->site = SiteDAO::getSiteByID($_GET['siteID']);
    }

    public static function getInstance(): SiteController
    {
        return new self();
    }

    public function edit(): void
    {
        $this->prepareData();

        $this->activePage = "siteList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/siteEditView.php";
        include_once "app/View/footer.php";
    }

    private function prepareData(): void
    {
        // Preparing the data that will be sent to the view
        $this->siteDetails = array('SiteID' => $this->site->getSiteID(),
            'SiteName' => $this->site->getSiteName(),
            'Street' => $this->site->getStreet(),
            'ZipCode' => $this->site->getZipCode(),
            'City' => $this->site->getCity(),
            'MonitID' => $this->site->getMonitoring()->getMonitID(),
            'IP' => $this->site->getMonitoring()->getIP(),
            'Status' => $this->site->getMonitoring()->isUp(),
            'LastPing' => $this->site->getMonitoring()->getLastPing()->format("Y-m-d h:i A"));
    }

    public function save(): void
    {
        // Setting object properties
        $this->site->setSiteName($_POST["inputSiteName"]);
        $this->site->setStreet($_POST["inputSiteStreet"]);
        $this->site->setZipCode($_POST["inputSiteZip"]);
        $this->site->setCity($_POST["inputSiteCity"]);

        // Saving change in the database
        $this->site->persist();

        // Reloading details page
        header("Location: ?action=siteDetails&siteID=" . $this->site->getSiteID());
    }

    public function details(): void
    {
        $this->prepareData();

        $this->activePage = "siteList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/siteDetailsView.php";
        include_once "app/View/footer.php";
    }

    public function delete(): void
    {
        $this->site->delete();

        // Reloading sites list
        header("Location: ?action=siteList");
    }
}