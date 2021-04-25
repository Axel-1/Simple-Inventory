<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=productList" class="link-secondary text-decoration-none">Products</a> / Create</h1>
</div>
<div class="container">
    <form action="./?action=productCreateSave&productType=<?= $this->productType ?>" method="POST"
          class="row g-3">
        <div class="col-md-6">
            <label for="inputProdName" class="form-label">Name</label>
            <input type="text" class="form-control" name="inputProdName">
        </div>
        <div class="col-md-6">
            <?php if ($this->productType == "Physical") { ?>
                <label for="inputProdHostname" class="form-label">Hostname</label>
                <input type="text" class="form-control" name="inputProdHostname">
            <?php } elseif ($this->productType == "Digital") { ?>
                <label for="inputProdExpDate" class="form-label">Expiration date</label>
                <input type="text" class="form-control" name="inputProdExpDate">
            <?php } ?>
        </div>
        <div class="col-md-6">
            <label for="inputProdManufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control" name="inputProdManufacturer">
        </div>
        <div class="col-md-6">
            <label for="inputProdModelNo" class="form-label">Model N°</label>
            <input type="text" class="form-control" name="inputProdModelNo">
        </div>
        <div class="col-md-6">
            <label for="inputProdSerialNo" class="form-label">Serial N°</label>
            <input type="text" class="form-control" name="inputProdSerialNo">
        </div>
        <div class="col-md-6">
            <label for="inputProdPurchaseDate" class="form-label">Purchase Date</label>
            <input type="text" class="form-control" name="inputProdPurchaseDate">
        </div>
        <div class="col-md-6">
            <label for="inputProdBillPath" class="form-label">Bill path</label>
            <input type="text" class="form-control" name="inputProdBillPath">
        </div>
        <div class="col-md-6">
            <label for="inputProdType" class="form-label">Type</label>
            <input type="text" class="form-control" name="inputProdType" disabled readonly
                   value="<?= $this->productType ?>">
        </div>
        <?php if ($this->productType == "Physical") { ?>
            <div class="col-md-3">
                <label for="inputProdSite" class="form-label">Site</label>
                <select class="form-select" name="inputProdSite" required>
                    <option selected disabled value="">Choose...</option>
                    <?php foreach ($siteList as $key => $val) { ?>
                        <option value="<?= $key ?>"><?= $val ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>