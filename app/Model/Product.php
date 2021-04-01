<?php


namespace App\Model;

use DateTime;

abstract class Product
{
    protected string $productID;
    protected string $productName;
    protected string $manufacturer;
    protected string $modelNo;
    protected string $serialNo;
    protected DateTime $purchaseDate;
    protected string $billPath;

    /**
     * Product constructor.
     * @param string $productID
     * @param string $productName
     * @param string $manufacturer
     * @param string $modelNo
     * @param string $serialNo
     * @param DateTime $purchaseDate
     * @param string $billPath
     */
    public function __construct(string $productID, string $productName, string $manufacturer, string $modelNo, string $serialNo, DateTime $purchaseDate, string $billPath)
    {
        $this->productID = $productID;
        $this->productName = $productName;
        $this->manufacturer = $manufacturer;
        $this->modelNo = $modelNo;
        $this->serialNo = $serialNo;
        $this->purchaseDate = $purchaseDate;
        $this->billPath = $billPath;
    }

    /**
     * @return string
     */
    public function getProductID(): string
    {
        return $this->productID;
    }

    /**
     * @param string $productID
     */
    public function setProductID(string $productID): void
    {
        $this->productID = $productID;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function getModelNo(): string
    {
        return $this->modelNo;
    }

    /**
     * @param string $modelNo
     */
    public function setModelNo(string $modelNo): void
    {
        $this->modelNo = $modelNo;
    }

    /**
     * @return string
     */
    public function getSerialNo(): string
    {
        return $this->serialNo;
    }

    /**
     * @param string $serialNo
     */
    public function setSerialNo(string $serialNo): void
    {
        $this->serialNo = $serialNo;
    }

    /**
     * @return DateTime
     */
    public function getPurchaseDate(): DateTime
    {
        return $this->purchaseDate;
    }

    /**
     * @param DateTime $purchaseDate
     */
    public function setPurchaseDate(DateTime $purchaseDate): void
    {
        $this->purchaseDate = $purchaseDate;
    }

    /**
     * @return string
     */
    public function getBillPath(): string
    {
        return $this->billPath;
    }

    /**
     * @param string $billPath
     */
    public function setBillPath(string $billPath): void
    {
        $this->billPath = $billPath;
    }

}