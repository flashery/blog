<?php require_once('../bootstrap.php') ?>
<?php Template::header(); ?>

<div class="container">


    <?php include_once('toast.php'); ?>


    <div class="py-5 text-center">

        <h2>Welcome back</h2>
        <p class="lead">Please fill out the form below to login to the site</p>
    </div>

    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-md-7 order-md-1">
            <h4 class="mb-3">Login Form</h4>
            <form class="needs-validation" novalidate="" method="POST" action="/core/login.php">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required="">
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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
<?php Template::footer(); ?>

<?php
unset($_SESSION['error']);
