<?php require_once('../bootstrap.php') ?>
<?php Template::header(); ?>
<?php Template::checkAccess(); ?>

<div class="container">

    <?php include_once('toast.php'); ?>

    <?php if (isset($_GET['post_id'])) { ?>

        <?php $post = Post::getPosts($_GET['post_id']); ?>

        <div class="row">
            <div class="col-md-12">
                <header>
                    <h4 class="float-left mb-3">Update Post</h4>

                    <?php include_once('delete_post.php') ?>
                    
                </header>
                
                <div style="clear:both"></div>

                <form class="needs-validation" novalidate="" method="POST" action="/core/post.php">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="<?= $post->title ?>" placeholder="Enter title" required="">
                        <div class="invalid-feedback">
                            Please enter a title.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Content</label>
                        <textarea rows="4" cols="50" class="form-control" name="content" placeholder="Content" required=""><?= $post->content; ?></textarea>

                        <div class="invalid-feedback">
                            Please enter a content.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $_GET['post_id'] ?>">
                    <button type="submit" class="btn btn-primary">Update post</button>
                </form>
            </div>
        </div>

        <!-- If editing post -->
    <?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">New Post</h4>
                <form class="needs-validation" novalidate="" method="POST" action="/core/post.php">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" required="">
                        <div class="invalid-feedback">
                            Please enter a title.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Content</label>
                        <textarea rows="4" cols="50" class="form-control" name="content" placeholder="Content" required=""></textarea>

                        <div class="invalid-feedback">
                            Please enter a content.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add post</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <hr>
    <?php include_once('comments.php') ?>

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
