<?php if (Auth::check()) { ?>

    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">Comment</h4>
            <form class="needs-validation" novalidate="" method="POST" action="/core/comment.php">
                <div class="form-group">
                    <textarea rows="4" cols="50" class="form-control" name="content" placeholder="Content" required=""></textarea>
                    <input type="hidden" name="post_id" value="<?= $_GET['post_id']; ?>">
                    <div class="invalid-feedback">
                        Please enter a content.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add comment</button>
            </form>
        </div>
    </div>

<?php } else { ?>

    <div class="row">
        <div class="col-md-12">
            <p class="mb-3"><a href="/views/login.php">Login</a> to add comment</p>
        </div>
    </div>

<?php } ?>

<?php $comments = Comment::getComments($_GET['post_id']); ?>

<hr>

<div class="row">
    <div class="col-md-12">
        <h4 class="mb-3">Comments</h4>
        <?php foreach ($comments as $comment) { ?>
            <div class="blog-post">

                <p class="blog-post-meta"><?php echo date_format(date_create($comment->updated_at), 'F d, Y'); ?> by
                    <a href="/views/profile.php?user_id=<?= $comment->user_id ?>"><?php echo $comment->first_name; ?></a></p>

                <?php echo $comment->content; ?>
            </div>
        <?php } ?>
    </div>
</div>