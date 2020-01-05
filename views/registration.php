<?php require_once('../bootstrap.php') ?>
<?php Template::header() ?>
<div class="container">


<?php include_once('toast.php'); ?>



    <div class="py-5 text-center">

        <h2>Welcome</h2>
        <p class="lead">Please fill out the form below to signup and start using the site</p>
    </div>

    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-md-7 order-md-1">
            <h4 class="mb-3">Signup Form</h4>
            <form name="singup-form" class="needs-validation" novalidate="" method="POST" action="/core/user.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Please enter your name
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Please enter your last name.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" name="email" placeholder="you@example.com" required="">
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password">Password </label>
                    <input type="password" class="form-control" name="password" placeholder="" required="">
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password">Confirm Password </label>
                    <input type="password" class="form-control" name="password2" placeholder="" required="">
                    <div class="invalid-feedback">
                        Please confirm your passsword.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Signup</button>
            </form>
        </div>
    </div>

</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        "use strict";
        window.addEventListener(
            "load",
            function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();
    $(document).ready(function() {
        if (window.GLOBALS.error) {
            $('.toast').toast({
                delay: 12000
            });
            $('.toast').toast('show')
        }

    });
</script>

<?php Template::footer() ?>

<?php
unset($_SESSION['error']);