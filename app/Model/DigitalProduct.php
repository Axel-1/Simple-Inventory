<?php


namespace App\Model;

use DateTime;

final class DigitalProduct extends Product
{
    private DateTime $expirationDate;

    /**
     * DigitalProduct constructor.
     * @param string $productID
     * @param string $productName
     * @param string $manufacturer
     * @param string $modelNo
     * @param string $serialNo
     * @param DateTime $purchaseDate
     * @param string $billPath
     * @param DateTime $expirationDate
     */
    public function __construct(string $productID, string $productName, string $manufacturer, string $modelNo, string $serialNo, DateTime $purchaseDate, string $billPath, DateTime $expirationDate)
    {
        parent::__construct($productID, $productName, $manufacturer, $modelNo, $serialNo, $purchaseDate, $billPath);
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @param DateTime $expirationDate
     */
    public function setExpirationDate(DateTime $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

}