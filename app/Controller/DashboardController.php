<?php


namespace App\Controller;


use App\Model\ProductDAO;
use App\Model\SiteDAO;

class DashboardController
{
    private static DashboardController $_instance;
    private int $productCount;
    private int $monitProductCount;
    private int $productDownCount;
    private array $dashSiteList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $siteCollection = SiteDAO::getAll();
        $productCollection = ProductDAO::getAll();
        $phyProdCollection = ProductDAO::getProductByType("p");

        // Product counter
        $this->productCount = count($productCollection);

        // Monitored product counter
        $this->monitProductCount = 0;
        foreach ($phyProdCollection as $key => $val) {
            if ($val->getProductMonitoring() != null) {
                $this->monitProductCount++;
            }
        }

        // Not responding product counter
        $this->productDownCount = 0;
        foreach ($phyProdCollection as $key => $val) {
            if ($val->getProductMonitoring() != null) {
                if (!$val->getProductMonitoring()->isUp()) {
                    $this->productDownCount++;
                }
            }
        }

        // List of site
        $this->dashSiteList = array();
        foreach ($siteCollection as $key => $val) {
            $this->dashSiteList[] = array('SiteName' => $val->getSiteName(),
                'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
                'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
        }
    }

    public static function getInstance(): DashboardController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "dashboard";
        include_once "app/View/header.php";
        include_once "app/View/dashboardView.php";
        include_once "app/View/footer.php";
    }

}