<?php


namespace App\Model;

use DateTime;

final class Warranty
{
    private string $warrantyID;
    private string $warrantyName;
    private DateTime $expirationDate;

    /**
     * Warranty constructor.
     * @param string $warrantyID
     * @param string $warrantyName
     * @param DateTime $expirationDate
     */
    public function __construct(string $warrantyID, string $warrantyName, DateTime $expirationDate)
    {
        $this->warrantyID = $warrantyID;
        $this->warrantyName = $warrantyName;
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return string
     */
    public function getWarrantyID(): string
    {
        return $this->warrantyID;
    }

    /**
     * @param string $warrantyID
     */
    public function setWarrantyID(string $warrantyID): void
    {
        $this->warrantyID = $warrantyID;
    }

    /**
     * @return string
     */
    public function getWarrantyName(): string
    {
        return $this->warrantyName;
    }

    /**
     * @param string $warrantyName
     */
    public function setWarrantyName(string $warrantyName): void
    {
        $this->warrantyName = $warrantyName;
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