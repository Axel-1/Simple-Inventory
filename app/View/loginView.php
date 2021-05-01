<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body class="bg-image">
<main class="form-signin text-center">
    <div class="card border-0 shadow-lg">
        <div class="card-body">
            <form action="./?action=authenticationLogin" method="POST">
                <h1 class="h2 mb-4 mt-4 fw-normal">Simple Inventory</h1>
                <h1 class="h6 mb-3 fw-normal text-muted">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" name="inputLoginEmail" placeholder="name@example.com">
                    <label for="inputLoginEmail">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="inputLoginPassword" placeholder="Password">
                    <label for="inputLoginPassword">Password</label>
                </div>
                <?php if ($this->error == true) { ?>
                    <h1 class="h6 mb-3 mt-4 fw-normal text-danger">The email or password is incorrect</h1>
                <?php } ?>
                <button class="w-100 btn btn-lg btn-primary shadow mt-2" type="submit">Sign in</button>
            </form>
        </div>
    </div>
    <p class="mt-5 mb-3 text-white">Made with️ <i class="bi bi-heart-fill text-danger"></i> by <a
                href="https://github.com/Axel-1/Simple-Inventory" class="text-decoration-none text-white"><i
                    class="bi bi-github"></i> Axel</a></p>

</main>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>