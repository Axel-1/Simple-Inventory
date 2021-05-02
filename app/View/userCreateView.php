<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=userList" class="link-secondary text-decoration-none">Users</a> / Create</h1>
</div>
<div class="container">
    <form action="./?action=userCreateSave" method="POST"
          class="row g-3">
        <div class="col-md-6">
            <label for="inputUserFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" name="inputUserFirstName" required>
        </div>
        <div class="col-md-6">
            <label for="inputUserLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="inputUserLastName" required>
        </div>
        <div class="col-md-6">
            <label for="inputUserEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="inputUserEmail" required>
        </div>
        <div class="col-md-6">
            <label for="inputUserPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="inputUserPassword" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>