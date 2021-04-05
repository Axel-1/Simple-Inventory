<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product details</h1>
</div>
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $this->productDetails['ProductName'] ?></h5>
                    <p class="card-subtitle"><?= $this->productDetails['Type'] == "Digital" ? "Expire on: " . $this->productDetails['ExpDate'] : $this->productDetails['Hostname'] ?></p>
                </div>
                <div class="container">
                    <div class="row mb-4">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <b>Manufacturer</b>: <?= $this->productDetails['Manufacturer'] ?></li>
                                <li class="list-group-item"><b>Model N°</b>: <?= $this->productDetails['ModelNo'] ?>
                                </li>
                                <li class="list-group-item"><b>Type</b>: <?= $this->productDetails['Type'] ?></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Serial N°</b>: <?= $this->productDetails['SerialNo'] ?>
                                </li>
                                <li class="list-group-item"><b>Purchase
                                        date</b>: <?= $this->productDetails['PurchaseDate'] ?></li>
                                <li class="list-group-item"><b>Bill</b>: <?= $this->productDetails['BillPath'] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->productDetails['Type'] == "Physical") { ?>
        <div class="row mb-4">
            <?php if (!is_null($this->productDetails['Warranties'])) { ?>
                <div class="col-6">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h4>Warranty</h4>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php foreach ($this->productDetails['Warranties'] as $key => $val) { ?>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $val['WarrantyName'] ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Expiration date</b>: <?= $val['ExpDate'] ?></li>
                                    </ul>
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary">More info</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (!is_null($this->productDetails['Monitoring'])) { ?>
                <div class="col-6">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h4>Monitoring</h4>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $this->productDetails['Monitoring']['IP'] ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Last
                                            ping</b>: <?= $this->productDetails['Monitoring']['LastPing'] ?></li>
                                    <?php if ($this->productDetails['Monitoring']['Status']) { ?>
                                        <li class="list-group-item text-success">Product is <b>UP</b></li>
                                    <?php } else { ?>
                                        <li class="list-group-item text-danger">Product is <b>Down</b></li>
                                    <?php } ?>
                                </ul>
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary">More info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>