    <div class="toast" style="position: absolute; top: 20%; right: 1%;">


        <div class="toast-header">
            <strong class="mr-auto danger">Error</strong>
            <small>11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <div class="alert alert-danger" role="alert">

                <?php echo $_SESSION['error']; ?>

            </div>
        </div>
    </div>