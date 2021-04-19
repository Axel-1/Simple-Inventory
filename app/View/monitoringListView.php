<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Monitoring</h1>
</div>
<div class="container">
    <div class="row mb-4">
        <?php foreach ($this->monitoringList as $key => $val) { ?>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><a href="?action=productDetails&productID=<?= $val['ProductID'] ?>" class="link-primary text-decoration-none"><?= $val['ProductName'] ?></a></h5>
                        <p class="card-subtitle"><?= $val['IP'] ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Last Ping</b>: <?= $val['LastPing'] ?></li>
                        <?php if ($val['Status']) { ?>
                            <li class="list-group-item text-success">Site is <b>UP</b></li>
                        <?php } else { ?>
                            <li class="list-group-item text-danger">Site is <b>Down</b></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</div>