<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Products</h1>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            New
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="?action=productCreate&productType=Physical">Physical Product</a></li>
            <li><a class="dropdown-item" href="?action=productCreate&productType=Digital">Digital Product</a></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="row mb-4">
        <?php foreach ($this->productList as $key => $val) { ?>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $val['ProductName'] ?></h5>
                        <p class="card-subtitle"><?= $val['ModelNo'] ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Serial N°</b>: <?= $val['SerialNo'] ?></li>
                        <li class="list-group-item"><b>Purchase date</b>: <?= $val['PurchaseDate'] ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="?action=productDetails&productID=<?= $val['ProductID'] ?>" class="btn btn-primary">More
                            info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>