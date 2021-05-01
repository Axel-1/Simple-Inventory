<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users</h1>
    <a href="?action=userCreate" class="btn btn-primary">New</a>
</div>
<div class="container">
    <div class="row mb-4">
        <?php foreach ($this->userList as $key => $val) { ?>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $val['FirstName'] . " " . $val['LastName'] ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Email</b>: <?= $val['Email'] ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="?action=userEdit&userID=<?= $val['UserID'] ?>" class="btn btn-primary">Edit</a>
                        <a href="?action=userDelete&userID=<?= $val['UserID'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>