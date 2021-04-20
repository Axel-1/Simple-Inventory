<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=siteList" class="link-secondary text-decoration-none">Sites</a> / Site details</h1>
</div>
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $this->siteDetails['SiteName'] ?></h5>
                    <p class="card-subtitle"><?= $this->siteDetails['Street'] ?>
                        , <?= $this->siteDetails['ZipCode'] ?> <?= $this->siteDetails['City'] ?></p>
                </div>
                <div class="card-body">
                    <a href="?action=siteEdit&siteID=<?= $this->siteDetails['SiteID'] ?>"
                       class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <?php if (!is_null($this->siteDetails['Rooms'])) { ?>
            <div class="col-6">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4>Rooms</h4>
                </div>
                <div class="row">
                    <div class="col">
                        <?php foreach ($this->siteDetails['Rooms'] as $key => $val) { ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $val['RoomName'] ?></h5>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-6">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h4>Monitoring</h4>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= $this->siteDetails['IP'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Last
                                    ping</b>: <?= $this->siteDetails['LastPing'] ?></li>
                            <?php if ($this->siteDetails['Status']) { ?>
                                <li class="list-group-item text-success">Site is <b>UP</b></li>
                            <?php } else { ?>
                                <li class="list-group-item text-danger">Site is <b>Down</b></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>