<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('/public/profile.css') ?>">

      <!-- axios cdn library  -->
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <style>
        .img-account-profile {
            height: 150px;
            width: 150px;
            object-fit: cover;

        }
    </style>
</head>

<body>
    <?php $loggedInuser = session()->get('user'); ?>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?php echo base_url('/dashboard') ?>"> Dashboard </a>
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
            </div>
        </div>
    </div>

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->

        <?php $loggedInuser = session()->get('user'); ?>

        <?php if ($loggedInuser): ?>
            <div class="mb-3 ">
                <!-- Profile picture image-->

                <?php
                $img = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png";

                if ($loggedInuser['profilePicName'] !== null) {
                    $profilePicName = $loggedInuser["profilePicName"];
                    $img = "/uploads/$profilePicName";
                }
                ?>
            <?php endif; ?>

            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" id="profilePicPre"
                                src="<?php echo esc($img) ?>">


                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <!-- Hidden file input -->
                            <!-- Custom button -->
                            <?php if (isset($validation)): ?>
                                        <small class="text-danger"><?= $validation->getError('profilePic') ?></small>
                                    <?php endif; ?>
                                    <br><br>
                            <button class="btn btn-dark form-control mb-5" type="button"
                                onclick="document.getElementById('profilePic').click();">
                                Upload Image
                            </button>
                            <div class="col-md-6">
                                        <input type="file" accept="image/*" id="profilePic" name="profilePic"
                                            style="display: none;" onchange="loadFile(event)">
                                    </div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="<?= base_url('/edit-profile'); ?>" method="post"
                                enctype="multipart/form-data">

                                <?php if ($loggedInuser): ?>
                                    <input type="hidden" name="id" value="<?php echo $loggedInuser['id']; ?>">
                                <?php endif; ?>

                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Username </label>
                                    <input class="form-control" id="inputUsername" type="text" name="username"
                                        placeholder="Enter your username"
                                        value="<?= $loggedInuser['user_name'] ?? '' ?>">
                                    <?php if (isset($validation)): ?>
                                        <small class="text-danger"><?= $validation->getError('username') ?></small>
                                    <?php endif; ?>
                                </div>

                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                        placeholder="Enter your email address"
                                        value="<?= $loggedInuser['email'] ?? '' ?>">
                                    <?php if (isset($validation)): ?>
                                        <small class="text-danger"><?= $validation->getError('email') ?></small>
                                    <?php endif; ?>
                                </div>


                                <?php if ($loggedInuser['role'] == 'admin') { ?>
                                    <!-- Form Group (role)-->
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select type="hidden" class="form-select" id="role" name="role" required>
                                            <option value="staff" <?= isset($loggedInuser['role']) && $loggedInuser['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                                            <option value="admin" <?= isset($loggedInuser['role']) && $loggedInuser['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </div>
                                <?php } else { ?>
                                    <div class="mb-3">
                                        <input type="hidden" name="role" value="<?= $loggedInuser['role'] ?? '' ?>">
                                    </div>
                                <?php } ?>

                                <div class="mb-3">
                                    <input type="hidden" name="status" value="<?= $loggedInuser['status'] ?? '' ?>">
                                </div>

                                
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address-1(Flat No/Door No, Apartment/House
                            Name)</label>
                        <input type="text" class="form-control" id="address1" name="address1" required
                            value="<?= $loggedInuser['address1'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('address1') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="address2" class="form-label">Address-2(Street Name, Area/Locality Name)</label>
                        <input type="text" class="form-control" id="address2" name="address2" required
                            value="<?= $loggedInuser['address2'] ?? '' ?>">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('address2') ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="address3" class="form-label">Address-3(optional)</label>
                        <input type="text" class="form-control" id="address3" name="address3"
                            value="<?= $loggedInuser['address3'] ?? '' ?>">
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

                                <!-- Form Row (password and confirm password)      -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputNewPassword">New Password</label>
                                        <input class="form-control" id="inputNewPassword" type="password"
                                            name="new_password" placeholder="Enter New password" value="">
                                        <?php if (isset($validation)): ?>
                                            <small class="text-danger"><?= $validation->getError('new_password') ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputConfirmNewPassword">Confirm New
                                            Password</label>
                                        <input class="form-control" id="inputConfirmNewPassword" type="password"
                                            name="confirm_new_password" placeholder="Enter New Password Again" value="">
                                        <?php if (isset($validation)): ?>
                                            <small class="text-danger"><?= $validation->getError('confirm_new_password') ?></small>
                                        <?php endif; ?>
                                    </div>

                                    


                                </div>

                                <!-- Save changes button-->
                                <button class="btn btn-dark" type="submit">Save changes</button>
                                <a class="btn btn-secondary" href="<?php echo base_url('/dashboard') ?>">Back To
                                    Home</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</body>

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
                               
                    let userDetailsResponse = await axios.get('<?= base_url() ?>' + 'user/getUserDetails?user_id=' + <?= $loggedInuser['id'] ?>);

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

            catch (error) {
                console.log(`Error while prepopulating edit data of user in user_view`, error)
            }


        })
    </script>

</html>