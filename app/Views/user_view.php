<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>

    <!-- axios cdn library  -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- bootstrap cdn library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f5f5f5;
            /* Light grey background */
            color: #333;
            /* Dark grey text */
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            /* White background for form */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            color: #333;
            /* Dark grey labels */
        }

        .btn-dark {
            border: solid 1px black;
        }

        .btn-dark:hover {
            border: solid 1px blue;
        }

        .btn-light {
            border: solid 1px black;
        }

        .btn-light:hover {

            border: solid 1px red;
        }

        .create-user-image {
            height: 150px;
            width: 150px;
            object-fit: cover;

        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card mb-4">
            <div class="card-header ">
                <?php
                echo '<h4 class="text-center">' . ($editUser ? 'Edit User' : 'Create User') . '</h2>';
                ?>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= $editUser ? base_url('/edit-by-user') : base_url('/create-user-by-admin') ?>"
                    method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>


                    <?php if (session()->get('validation')): ?>
                        <?php $validation = session()->get('validation');
                        Kint::dump($validation);
                        ?>

                    <?php endif ?>


                    <?php if ($editUser): ?>
                        <input type="hidden" name="id" id="editUserId" value="<?php echo $editUser['id']; ?>">
                    <?php endif; ?>

                    <?php if ($editUser == null): ?>
                        <div class="mb-3 ">
                            <!-- Profile picture image-->
                            <img class="create-user-image rounded-circle small form-control mx-auto  mb-3"
                                id="profilePicPre"
                                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                alt="">
                        </div>

                        <div class="mb-3 ">
                            <label for="profilePic" class="form-label"> Choose Profile Picture</label>
                            <input type="file" accept="image/*" class="form-control " id="profilePic" name="profilePic"
                                value="" onchange="loadFile(event)">
                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('profilePic') ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($editUser): ?>
                        <div class="mb-3 ">
                            <!-- Profile picture image-->
                            <?php
                            $img = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png";

                            if ($editUser['profilePicName'] !== null) {
                                $profilePicName = $editUser["profilePicName"];
                                $img = "/uploads/$profilePicName";
                            }


                            ?>

                            <img class="create-user-image rounded-circle small form-control mx-auto  mb-3"
                                id="profilePicPre" src="<?php echo esc($img) ?>" alt="Profile Picture">
                        </div>

                        <!-- Hidden file input -->
                        <input type="file" accept="image/*" id="profilePic" name="profilePic" style="display: none;"
                            onchange="loadFile(event)">

                        <?php if (isset($validation)): ?>
                            <small class="text-danger"
                                style="display:block ; text-align:center"><?= $validation->getError('profilePic') ?></small>
                        <?php endif; ?>

                        <br><br>

                        <!--- Custom Button --->
                    <button class="btn btn-dark form-control mb-5" type="button"
                        onclick="document.getElementById('profilePic').click();">
                        Upload Image
                    </button>


                    <?php endif; ?>


                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required
                            value="<?= $editUser['user_name'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                        <small class="text-danger">
                            <?= $validation->getError('username') ?>
                        </small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="<?= $editUser['email'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                        <small class="text-danger">
                            <?= $validation->getError('email') ?>
                        </small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="staff" <?= isset($editUser['role']) && $editUser['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                            <option value="admin" <?= isset($editUser['role']) && $editUser['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <?php if (isset($validation)): ?>
                        <small class="text-danger">
                            <?= $validation->getError('role') ?>
                        </small>
                        <?php endif; ?>
                    </div>
















                    <!-- new changes 16/08/2024 -->



                    <div class="mb-3">
                        <label for="address1" class="form-label">Address-1(Flat No/Door No, Apartment/House
                            Name)</label>
                        <input type="text" class="form-control" id="address1" name="address1" required
                            value="<?= $editUser['address1'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('address1') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="address2" class="form-label">Address-2(Street Name, Area/Locality Name)</label>
                        <input type="text" class="form-control" id="address2" name="address2" required
                            value="<?= $editUser['address2'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('address2') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="address3" class="form-label">Address-3(optional)</label>
                        <input type="text" class="form-control" id="address3" name="address3"
                            value="<?= $editUser['address3'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('address3') ?></small>
                        <?php endif; ?>
                    </div>


                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="">Select Country</option>


                        </select>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('country') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" name="state" required>
                            <option value="">Select State</option>

                        </select>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('state') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" name="city" required>
                            <option value="">Select City</option>

                        </select>
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('city') ?></small>
                        <?php endif; ?>
                    </div>




                    <!-- new changes 16/08/2024 -->




























                    <?php if ($editUser == null): ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('password') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>



                    <?php if ($editUser): ?>

                        <div class="mb-3">
                            <label class="form-label">Activate/Deactivate</label>

                            <!-- Radio buttons for activation and deactivation -->
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="activate" name="status" value="active"
                                    <?php echo $editUser['status'] == 'active' ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="activate">Activate</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="deactivate" name="status" value="inactive"
                                    <?php echo $editUser['status'] == 'inactive' ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="deactivate">Deactivate</label>
                            </div>

                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('activate_or_deactivate') ?></small>
                            <?php endif; ?>
                        </div>


                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            <small>(optional)</small>
                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('new_password') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_new_password"
                                name="confirm_new_password">
                            <small>(optional,only if you leave the above field empty )</small>
                            <?php if (isset($validation)): ?>
                                <small class="text-danger"><?= $validation->getError('confirm_new_password') ?></small>
                            <?php endif; ?>
                        </div>

                    <?php endif; ?>




                    <button type="submit"
                        class="btn btn-dark w-100"><?php echo $editUser ? 'Edit User' : 'Create User' ?>
                    </button>
                    <br><br>
                    <button type="button" class="btn btn-light w-100"
                        onclick="location.href='<?php echo base_url('/dashboard?editUser=true'); ?>'">Cancel</button>
                </form>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    <!-- script for alerting activate and deactivate of a user -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all radio buttons for activation/deactivation
            var radios = document.querySelectorAll('input[name="status"]');

            // Add event listener to each radio button
            radios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    // Get the value of the selected radio button
                    var selectedValue = this.value;

                    // Show confirmation dialog
                    var confirmed = confirm('Do you Confirm to change the user status to ' + selectedValue + '?');

                    // If not confirmed, revert the radio button selection
                    if (!confirmed) {
                        // Uncheck the radio button
                        this.checked = false;
                    }
                });
            });
        });
    </script>


    <!-- script for uploading image in the form -->
    <!-- <script>
        document.getElementById('profilePic').addEventListener('change', function(event) {
            
            var inputFiles = event.target.files;
            var reader = new FileReader();

            reader.onload = function(e) {
               
                var dataURL = e.target.result;
                var profileImage = document.getElementById('profilePicPre');
                profileImage.src = dataURL;
            };

            if (inputFiles && inputFiles[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        });
     </script> -->


    <script>
        var loadFile = function (event) {
            var output = document.getElementById('profilePicPre');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async function () {

            let response = await axios.get('<?= base_url('user/getCountriesList') ?>');
            let countries = response.data;
            console.log(countries);
            let countriesOptions = '<option value="">Select Country</option>';
            countries.forEach((country) => {
                countriesOptions += `<option value="${country.id}">${country.country_name}</option>`;
            })
            document.getElementById('country').innerHTML = countriesOptions;


            // Fetch states when country is selected
            document.getElementById('country').addEventListener('change', async function () {
                try {
                    var countryId = this.value;
                    let response = await axios.get('<?= base_url('user/getStatesByCountry') ?>/' + countryId)
                    let states = response.data;
                    let stateOptions = '<option value="">Select State</option>';
                    states.forEach((state) => {
                        stateOptions += `<option value="${state.id}">${state.state_name}</option> `;
                    })
                    document.getElementById('state').innerHTML = stateOptions;
                } catch (error) {
                    console.error('there was an error fetching the states!', error);
                }

            });

            // Fetch cities when state is selected
            document.getElementById('state').addEventListener('change', async function () {
                try {
                    var stateId = this.value;
                    let response = await axios.get('<?= base_url('user/getCitiesByState') ?>/' + stateId)
                    let cities = response.data;
                    let cityOptions = '<option value="">Select City</option>';
                    cities.forEach((city) => {
                        cityOptions += `<option value="${city.id}">${city.city_name}</option> `;
                    })
                    document.getElementById('city').innerHTML = cityOptions;
                } catch (error) {
                    console.error('there was an error fetching the cities!', error);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async function () {


            try {
                if (editUserId) {
                    let editUserId = document.getElementById('editUserId').value;

                    let userDetailsResponse = await axios.get('<?= base_url() ?>' + `user/getUserDetails?user_id=${editUserId}`);

                    let countryListResponse = await axios.get('<?= base_url('user/getCountriesList') ?>');
                    let stateListResponse = await axios.get('<?= base_url('user/getStatesList') ?>');
                    let cityListResponse = await axios.get('<?= base_url('user/getCitiesList') ?>');

                    let userDetails = userDetailsResponse.data;
                
                    let countries = countryListResponse.data;
                    let states = stateListResponse.data;
                    let cities = cityListResponse.data;


                    let countrySelect = document.getElementById('country');
                    let stateSelect = document.getElementById('state');
                    let citySelect = document.getElementById('city');

                    countrySelect.innerHTML = `<option value="">Select Country </option>`;
                    countries.forEach((country) => {
                        let selected = country.id === userDetails.country_id ? 'selected' : '';
                        countrySelect.innerHTML += `<option value="${country.id}" ${selected} > ${country.country_name}</option>`;
                    })

                    stateSelect.innerHTML = `<option value="">Select State   </option>`;
                    states.forEach((state) => {
                        let selected = state.id === userDetails.state_id ? 'selected' : '';
                        stateSelect.innerHTML += `<option value="${state.id}"    ${selected}  > ${state.state_name}</option>`;
                    })

                    citySelect.innerHTML = `<option value="">Select City    </option>`;
                    cities.forEach((city) => {
                        let selected = city.id === userDetails.city_id ? 'selected' : '';
                        citySelect.innerHTML += `<option value="${city.id}"      ${selected}  > ${city.city_name} </option>`;
                    })




                }

            } catch (error) {
                console.log(`Error while prepopulating edit data of user in user_view`, error)
            }


        })
    </script>



</body>

</html>