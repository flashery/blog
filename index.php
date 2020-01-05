<?php require_once(dirname(__FILE__) . '/bootstrap.php') ?>

<?php Template::header(); ?>

<?php $posts = Post::getPosts(); ?>

<div class="container">

    <header class="row">
        <div class="col-md-12">
            <div class="float-left">
                <h1>Blog List</h1>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="/views/post.php">New Post</a>
            </div>
        </div>
    </header>

    <?php foreach ($posts as $post) { ?>

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

    <?php } ?>

</div>

<?php Template::footer(); ?>

<?php
unset($_SESSION['error']);
