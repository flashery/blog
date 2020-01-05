<form class="float-right" method="POST" action="/core/post.php">
    <input type="hidden" name="id" value="<?= $_GET['post_id'] ?>">
    <input type="hidden" name="action" value="delete">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>