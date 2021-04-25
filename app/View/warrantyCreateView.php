<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=productList" class="link-secondary text-decoration-none">Products</a> / <a
                href="?action=productDetails&productID=<?= $productID ?>"
                class="link-secondary text-decoration-none">Product details</a> / Create warranty</h1>
</div>
<div class="container">
    <form action="./?action=warrantyCreateSave&productID=<?= $productID ?>"
          method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="inputWarrantyName" class="form-label">Name</label>
            <input type="text" class="form-control" name="inputWarrantyName">
        </div>
        <div class="col-md-6">
            <label for="inputWarrantyExpDate" class="form-label">Expiration Date</label>
            <input type="text" class="form-control" name="inputWarrantyExpDate">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>