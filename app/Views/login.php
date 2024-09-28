<!DOCTYPE html>
<html>

<head>
    <title>CodeIgniter Login and Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url('/login.css')?>" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Sign In</h5>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url('/login'); ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                              
                                <a class="forget-password" style="color: red; font-size:14px; display: block;" href="<?php echo base_url('/forgetPassword'); ?>" >forget Password ?</a>
                                <br>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                <p class="text-center">Don't have account? 
                                    <a href="<?php echo base_url('/register'); ?>">Register here</a>
                                <p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <body>

</html>