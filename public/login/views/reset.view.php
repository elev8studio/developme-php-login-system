<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Reset Password</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}@media (min-width:768px){.bd-placeholder-img-lg{font-size:3.5rem}}.heading-center{display:block;margin:auto}#newPassword{border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:-1px}#confirmPassword{border-top-left-radius:0;border-top-right-radius:0;border-bottom-left-radius:4px;border-bottom-right-radius:4px;}
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <form class="form-signin" action="" method="post">
        <img class="mb-4" src="media/logo.png" alt="" width="150" height="">

        <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>

        <?php if (!$expired) { ?>
            <label for="newPassword" class="sr-only">New Password</label>
            <input type="password" id="newPassword" class="form-control" placeholder="Password" name="newPassword" value="">

            <label for="confirmPassword" class="sr-only">New Password</label>
            <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" name="confirmPassword" value="">

            <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
        <?php } ?>

        <br />

        <p class="text-muted">Not registered? <a href="register.php">Create new account</a></p>

        <p class="text-muted">Already registered? <a href="login.php">Login</a></p>

        <br />

        <?php include('alerts.php') ?>

        <?php if ($success) { ?>
            <br /><a href="login.php" class="btn btn-primary">Login</a>
        <?php } ?>

        <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>

</body>
</html>
