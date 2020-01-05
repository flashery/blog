<?php require_once('../bootstrap.php') ?>
<?php Template::header() ?>
<?php $post = Post::getPosts($_GET['post_id']); ?>
<div class="container">


    <?php include_once('toast.php'); ?>


    <div class="blog-post">
        <a href="/views/view_post.php?post_id=<?= $post->id ?>">
            <h2 class="blog-post-title"><?php echo $post->title ?></h2>
        </a>
        <?php
        if (isset($_SESSION['user'])) {
            if ($post->user_id === $_SESSION['user']->id) {
                echo "<a class='btn btn-primary float-right' href='/views/post.php?post_id={$post->id}'>Edit</a>";
            }
        }
        ?>
        <p class="blog-post-meta"><?php echo date_format(date_create($post->updated_at), 'F d, Y'); ?> by
            <a href="/views/profile.php?user_id=<?= $post->user_id ?>"><?php echo $post->first_name; ?></a></p>

        <?php echo $post->content; ?>
    </div>

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

<?php Template::footer() ?>

<?php
unset($_SESSION['error']);
