<!DOCTYPE html>
<html>
<style>
    .create-user-div {
        display: flex;
    }

    .create-user-btn {
        margin-top: 50px;
        margin-left: auto;
    }
</style>


<head>
    <title>User Crud-Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- importing css for datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- importing css for datatable button -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

</head>

<body>
    <?php $loggedInuser = session()->get('user'); ?>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-12">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"> Dashboard </a>
                        <a class="navbar-brand" href="<?php echo base_url('/profile') ?>">
                            <?php echo $loggedInuser['user_name'] . " - Profile" ?> </a>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page"
                                        href="<?php echo base_url('/logout'); ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>


                <?php if ($loggedInuser['role'] == 'admin'): ?>
                    <div class="create-user-div">
                        <a href="<?php echo base_url('/create-user'); ?>"
                            class="btn btn-dark btn-sm create-user-btn  ">Create User</a>
                    </div>
                <?php endif ?>

                <h2 class="text-center mt-5">User Dashboard</h2>

                <table class="table table-striped display" id="example">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Address</th>
                            <?php if ($loggedInuser['role'] == 'admin'): ?>
                                <th scope="col">Action</th>
                            <?php endif ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($users as $user) {
                            if ($user['id'] != $loggedInuser['id']) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $user['id'] ?></th>
                                    <td><?= $user['user_name'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td><?= $user['status'] ?></td>
                                    <?php if (isset($user['address1'])) { ?>

                                        <td>
                                            <?= $user['address1'] ?> ,
                                            <?= $user['address2'] ?> ,<br>
                                            <?php if (!empty($user['address3'])): ?>
                                                <?= $user['address3'] ?><br>
                                            <?php endif; ?>
                                            <?= $user['city_name'] ?? '' ?> ,
                                            <?= $user['state_name'] ?? '' ?> ,
                                            <?= $user['country_name'] ?? '' ?>
                                        </td>

                                    <?php } else { ?>
                                        <td style="color: grey; font-weight: 300; cursor: default;"> No Address</td>
                                    <?php } ?>
                                    <?php if ($loggedInuser['role'] == 'admin'): ?>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-tasks"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo base_url("/edit-user?editUserId=" . $user['id']) ?>">
                                                            <i class="fas fa-edit"></i> Edit</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo base_url("/deactivate-user?deleteUserId=" . $user['id']) ?>">
                                                            <i class="fas fa-ban"></i> Deactivate</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    <?php endif ?>

                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

</body>

</html>