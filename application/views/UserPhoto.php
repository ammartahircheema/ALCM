<?php include_once('_UserHeader.php') ?>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- .page-header -->
    <header class="page-header container text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="icon" data-icon="Z"></div>
            <h1>— Update Profile Photo—</h1>
        </div>
    </header>
    <!-- /.page-header -->

    <!-- CONTAINER -->
    <article class="container text-center">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form action="<?php echo base_url() . 'User/xUserPhoto' ?>" method="post" enctype="multipart/form-data">
                <div style="color: red"><?php
                    if (isset($msg)) {
                        echo str_replace("%20", " ", $msg);
                    }
                    ?></div>
                <?php
                    echo '<div class="form-group">';
                    echo '<input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required accept=",.jpg,.jpeg,.png">';
                    echo '</div>';
                ?>
                <input class="btn btn-default" type="submit" value="Upload Photo">
            </form>
        </div>
    </article>
    <!-- /.container -->
</div>
<!-- /.wrapper -->
<?php include_once('_defaultFooter.php') ?>
