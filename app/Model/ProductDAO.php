<?php


namespace App\Model;


class ProductDAO extends DAO
{
    public static function getAll(): array
    {
        $productCollection = array();
        $rs = self::query("SELECT * FROM Produit");
        foreach ($rs as $key => $val) {
            if ($val['Type'] == "p") {
                $productCollection[$val['ID_produit']] = new PhysicalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Nom_hote'], WarrantyDAO::getWarrantyByProductID($val['ID_produit']), SiteDAO::getSiteByID($val['ID_site']), ($val['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($val['ID_supervision'])));
            } elseif ($val['Type'] == "d") {
                $productCollection[$val['ID_produit']] = new DigitalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Activation'], date_create($val['Date_expiration']));
            }
        }
        return $productCollection;
    }

    public static function getProductByID(int $productID): Product
    {
        $rs = self::prepare("SELECT * FROM Produit WHERE ID_produit = :productID", array(":productID" => $productID));
        if ($rs[0]['Type'] == "p") {
            return new PhysicalProduct($rs[0]['ID_produit'], $rs[0]['Nom_produit'], $rs[0]['Fabricant'], $rs[0]['Num_modele'], $rs[0]['Num_serie'], date_create($rs[0]['Date_achat']), $rs[0]['Chemin_facture'], $rs[0]['Nom_hote'], WarrantyDAO::getWarrantyByProductID($rs[0]['ID_produit']), SiteDAO::getSiteByID($rs[0]['ID_site']), ($rs[0]['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($rs[0]['ID_supervision'])));
        } elseif ($rs[0]['Type'] == "d") {
            return new DigitalProduct($rs[0]['ID_produit'], $rs[0]['Nom_produit'], $rs[0]['Fabricant'], $rs[0]['Num_modele'], $rs[0]['Num_serie'], date_create($rs[0]['Date_achat']), $rs[0]['Chemin_facture'], $rs[0]['Activation'], date_create($rs[0]['Date_expiration']));
        }
    }

    public static function getProductByType(string $productType): array
    {
        $productCollection = array();
        $rs = self::prepare("SELECT * FROM Produit WHERE Type = :productType", array(":productType" => $productType));
        foreach ($rs as $key => $val) {
            if ($val['Type'] == "p") {
                $productCollection[$val['ID_produit']] = new PhysicalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Nom_hote'], WarrantyDAO::getWarrantyByProductID($val['ID_produit']), SiteDAO::getSiteByID($val['ID_site']), ($val['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($val['ID_supervision'])));
            } elseif ($val['Type'] == "d") {
                $productCollection[$val['ID_produit']] = new DigitalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Activation'], date_create($val['Date_expiration']));
            }
        }
        return $productCollection;
    }

    public static function getMonitoredProducts(): array
    {
        $productCollection = array();
        $rs = self::query("SELECT * FROM Produit WHERE ID_supervision IS NOT NULL");
        foreach ($rs as $key => $val) {
            $productCollection[$val['ID_produit']] = new PhysicalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Nom_hote'], WarrantyDAO::getWarrantyByProductID($val['ID_produit']), SiteDAO::getSiteByID($val['ID_site']), ($val['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($val['ID_supervision'])));
        }
        return $productCollection;
    }

    public static function updateProduct(Product $product): void
    {
        if ($product instanceof PhysicalProduct) {
            $productAttributes = array(':productName' => $product->getProductName(),
                ':manufacturer' => $product->getManufacturer(),
                ':modelNo' => $product->getModelNo(),
                ':serialNo' => $product->getSerialNo(),
                ':purchaseDate' => $product->getPurchaseDate()->format("Y-m-d"),
                ':billPath' => $product->getBillPath(),
                ':hostname' => $product->getHostname(),
                ':productID' => $product->getProductID(),
                ':siteID' => $product->getSite()->getSiteID());
            self::update("UPDATE Produit SET Nom_produit = :productName, Fabricant = :manufacturer, Num_modele = :modelNo, Num_serie = :serialNo, Date_achat = :purchaseDate, Chemin_facture = :billPath, Nom_hote = :hostname, ID_site = :siteID WHERE ID_produit = :productID", $productAttributes);
        } elseif ($product instanceof DigitalProduct) {
            $productAttributes = array(':productName' => $product->getProductName(),
                ':manufacturer' => $product->getManufacturer(),
                ':modelNo' => $product->getModelNo(),
                ':serialNo' => $product->getSerialNo(),
                ':purchaseDate' => $product->getPurchaseDate()->format("Y-m-d"),
                ':billPath' => $product->getBillPath(),
                ':activated' => $product->isActivated(),
                ':expirationDate' => $product->getExpirationDate()->format("Y-m-d"),
                ':productID' => $product->getProductID());
            self::update("UPDATE Produit SET Nom_produit = :productName, Fabricant = :manufacturer, Num_modele = :modelNo, Num_serie = :serialNo, Date_achat = :purchaseDate, Chemin_facture = :billPath, Activation = :activated, Date_expiration = :expirationDate WHERE ID_produit = :productID", $productAttributes);
        }
    }

    public static function deleteProduct(Product $product): void
    {
        $productAttributes = array(':productID' => $product->getProductID());
        self::update("DELETE FROM Produit WHERE ID_produit = :productID", $productAttributes);
    }
}