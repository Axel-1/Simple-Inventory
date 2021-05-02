<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <?php if (isset($this->monitoringDetails['SiteID'])) { ?>
        <h1 class="h2"><a href="?action=siteList" class="link-secondary text-decoration-none">Sites</a> / <a
                    href="?action=siteDetails&siteID=<?= $this->monitoringDetails['SiteID'] ?>"
                    class="link-secondary text-decoration-none">Sites details</a> / Edit monitoring</h1>
    <?php } elseif (isset($this->monitoringDetails['ProductID'])) { ?>
        <h1 class="h2"><a href="?action=productList" class="link-secondary text-decoration-none">Products</a> / <a
                    href="?action=productDetails&productID=<?= $this->monitoringDetails['ProductID'] ?>"
                    class="link-secondary text-decoration-none">Product details</a> / Edit monitoring</h1>
    <?php } ?>
</div>
<div class="container">
    <?php if (isset($this->monitoringDetails['SiteID'])) { ?>
    <form action="./?action=monitEditSave&monitID=<?= $this->monitoringDetails['MonitID'] ?>&siteID=<?= $this->monitoringDetails['SiteID'] ?>"
          method="POST" class="row g-3">
        <?php } elseif (isset($this->monitoringDetails['ProductID'])) { ?>
        <form action="./?action=monitEditSave&monitID=<?= $this->monitoringDetails['MonitID'] ?>&productID=<?= $this->monitoringDetails['ProductID'] ?>"
              method="POST" class="row g-3">
            <?php } ?>
            <div class="col-md-6">
                <label for="inputMonitIP" class="form-label">IP</label>
                <input type="text" class="form-control" name="inputMonitIP"
                       value="<?= $this->monitoringDetails['IP'] ?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputMonitLastPing" class="form-label">Last Ping</label>
                <input type="text" readonly disabled class="form-control" name="inputMonitLastPing"
                       value="<?= $this->monitoringDetails['LastPing'] ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
</div>