<?php


namespace App\Controller;


use App\Model\SiteDAO;

class SiteListController
{
    private array $siteList;
    private static SiteListController $_instance;
    private string $activePage;

    private function __construct()
    {
        $siteCollection = SiteDAO::getAll();

        $this->siteList = array();
        foreach ($siteCollection as $key => $val) {
            $this->siteList[] = array('SiteName' => $val->getSiteName(),
                'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
                'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
        }
    }

    public static function getInstance(): SiteListController
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteListView.php";
        include_once "app/View/footer.php";
    }
}