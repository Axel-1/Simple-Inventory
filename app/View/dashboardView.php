<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h1 class="card-title text-center"><?=$productCount?></h1>
                    <p class="card-text text-center">Products in inventory</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success">
                <div class="card-body">
                    <h1 class="card-title text-center"><?=$monitProductCount?></h1>
                    <p class="card-text text-center">Products monitored</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger">
                <div class="card-body">
                    <h1 class="card-title text-center"><?=$productDownCount?></h1>
                    <p class="card-text text-center">Products that are not responding</p>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($dashSiteList as $key => $val) {?>
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $val['SiteName']?></h5>
                        <p class="card-text"><b>Lorem</b> ipsum</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $val['Address']?></li>
                        <li class="list-group-item"><?= $val['IP']?></li>
                        <?php if ($val['Status']) {?>
                            <li class="list-group-item text-success">Site is <b>UP</b></li>
                        <?php } else {?>
                            <li class="list-group-item text-danger">Site is <b>Down</b></li>
                        <?php }?>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary">More info</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>