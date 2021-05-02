<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=siteList" class="link-secondary text-decoration-none">Sites</a> / Create</h1>
</div>
<div class="container">
    <form action="./?action=siteCreateSave" method="POST"
          class="row g-3">
        <div class="col-md-6">
            <label for="inputSiteName" class="form-label">Name</label>
            <input type="text" class="form-control" name="inputSiteName" required>
        </div>
        <div class="col-md-6">
            <label for="inputSiteAddress" class="form-label">Address</label>
            <input type="text" class="form-control" name="inputSiteStreet" required>
        </div>
        <div class="col-md-6">
            <label for="inputSiteZip" class="form-label">Zip code</label>
            <input type="text" class="form-control" name="inputSiteZip" required>
        </div>
        <div class="col-md-6">
            <label for="inputSiteCity" class="form-label">City</label>
            <input type="text" class="form-control" name="inputSiteCity" required>
        </div>
        <div class="col-md-6">
            <label for="inputSiteIP" class="form-label">IP</label>
            <input type="text" class="form-control" name="inputSiteIP" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>