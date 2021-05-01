<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=userList" class="link-secondary text-decoration-none">Users</a> / Edit</h1>
</div>
<div class="container">
    <form action="./?action=userEditSave&userID=<?= $this->userDetails['UserID'] ?>" method="POST"
          class="row g-3">
        <div class="col-md-6">
            <label for="inputUserFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" name="inputUserFirstName"
                   value="<?= $this->userDetails['FirstName'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputUserLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="inputUserLastName"
                   value="<?= $this->userDetails['LastName'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputUserEmail" class="form-label">Email</label>
            <input type="text" class="form-control" name="inputUserEmail"
                   value="<?= $this->userDetails['Email'] ?>">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>