<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
    rel="stylesheet"
    />

    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
    "></script>

        <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
        
        initMDB({ Input, Tab, Ripple });
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>

    </style>
</head>
<body>
    <?php @include('../layouts/navbar.php'); ?>
    <div class="d-flex justify-content-center">
        <div class="container">
            <div class="form-header">
                <h2>Edit Profile</h2>
            </div>
            <form id="editProfileForm" action="update_profile.php" method="POST">
                <div class="profile-photo">
                    <div class="avatar">
                        <img src="../assets/avatar.png" alt="Avatar">
                        <div class="overlay">
                            <button type="button"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                    <input type="file" class="form-control mt-2" id="registerPhoto" name="photo">
                </div>

                <div class="form-group">
                    <label class="form-label" for="registerName">Name</label>
                    <input type="text" id="registerName" name="name" class="form-control" required />
                    <div class="error" id="nameError">Name is required.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="registerEmail">Email</label>
                    <input type="email" id="registerEmail" name="email" class="form-control" required />
                    <div class="error" id="emailError">Valid email is required.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="registerPassword">New Password</label>
                    <div class="input-group">
                        <input type="password" id="registerPassword" name="password" class="form-control" required />
                        <button class="btn border border-dark text-white" type="button" id="togglePasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error" id="passwordError">Password is required.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="registerRepeatPassword">Old Password</label>
                    <div class="input-group">
                        <input type="password" id="registerRepeatPassword" name="old_password" class="form-control" required />
                        <button class="btn border border-dark text-white" type="button" id="toggleRepeatPasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error" id="repeatPasswordError">Old password is required.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="registerBirthdate">Date of Birth</label>
                    <input type="date" id="registerBirthdate" name="birthdate" class="form-control" required />
                    <div class="error" id="birthdateError">Date of birth is required.</div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <?php include('../layouts/footer.php'); ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordVisibilityButton = document.getElementById('togglePasswordVisibility');
            const toggleRepeatPasswordVisibilityButton = document.getElementById('toggleRepeatPasswordVisibility');
            const passwordField = document.getElementById('registerPassword');
            const repeatPasswordField = document.getElementById('registerRepeatPassword');

            togglePasswordVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(passwordField, this);
            });

            toggleRepeatPasswordVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(repeatPasswordField, this);
            });

            function togglePasswordVisibility(field, button) {
                if (field.type === 'password') {
                    field.type = 'text';
                    button.innerHTML = '<i class="fas fa-eye-slash text-white"></i>';
                } else {
                    field.type = 'password';
                    button.innerHTML = '<i class="fas fa-eye text-white"></i>';
                }
            }

            document.getElementById('editProfileForm').addEventListener('submit', function(event) {
                event.preventDefault();
                let valid = true;

                const name = document.getElementById('registerName').value;
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const oldPassword = document.getElementById('registerRepeatPassword').value;
                const birthdate = document.getElementById('registerBirthdate').value;

                if (!name) {
                    document.getElementById('nameError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('nameError').style.display = 'none';
                }

                if (!email || !/\S+@\S+\.\S+/.test(email)) {
                    document.getElementById('emailError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('emailError').style.display = 'none';
                }

                if (!password) {
                    document.getElementById('passwordError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('passwordError').style.display = 'none';
                }

                if (!oldPassword) {
                    document.getElementById('repeatPasswordError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('repeatPasswordError').style.display = 'none';
                }

                if (!birthdate) {
                    document.getElementById('birthdateError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('birthdateError').style.display = 'none';
                }

                if (valid) {
                    this.submit();
                }
            });
        });
    </script>
</body>
</html>
