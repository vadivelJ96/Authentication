<!DOCTYPE html>
<html>

<head>
    <title>CodeIgniter Authentication - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Register</h5>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url('/register'); ?>" method="post">


                            <?= csrf_field() ?>

                            <?php if (session()->get('validation')): ?>
                              <?php $validation=session()->get('validation'); ?>
                            <?php endif ?>


                            <div class="mb-3">
                                <label for="username" class="form-label">User Name</label>
                                <input class="form-control" id="username" name="username"
                                    value="<?= old('username') ?>">
                                <?php if (isset($validation)): ?>
                                    <small class="text-danger"><?= $validation->getError('username') ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= old('email') ?>">
                                <?php if (isset($validation)): ?>
                                    <small class="text-danger"><?= $validation->getError('email') ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <?php if (isset($validation)): ?>
                                    <small class="text-danger"><?= $validation->getError('password') ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password">
                                <?php if (isset($validation)): ?>
                                    <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Register Now</button>
                                <p class="text-center">Have already an account <a
                                        href="<?php echo base_url('/login'); ?>">Login here</a>
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