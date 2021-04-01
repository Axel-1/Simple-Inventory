<?php

namespace App\Controller;

use App\Model\ProductDAO;


$productCollection = ProductDAO::getAll();

$productList = array();
foreach ($productCollection as $key => $val) {
    $productList[] = array('ProductName' => $val->getProductName(),
        'ModelNo' => $val->getModelNo(),
        'SerialNo' => $val->getSerialNo(),
        'PurchaseDate' => $val->getPurchaseDate()->format("Y-m-d"));
}

include_once "../View/header.php";
include_once "../View/productListView.php";
include_once "../View/footer.php";