<?php include_once('_UserHeader.php') ?>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- .page-header -->
    <header class="page-header container text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="icon" data-icon="Z"></div>
            <h1>— Update Profile —</h1>
        </div>
    </header>
    <!-- /.page-header -->

    <!-- CONTAINER -->
    <article class="container text-center">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form action="<?php echo base_url() . 'User/ProcessUpdate' ?>" method="post">
                <div style="color: red"><?php
                    if (isset($msg)) {
                        echo str_replace("%20", " ", $msg);
                    }
                    ?></div>
                <?php
                foreach ($result as $row) {
                    echo '<div class="form-group">';
                    echo '<input class="form-control" type="text" placeholder="name" id="name" name="name" required value="' . $row->name . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<input class="form-control" type="text" placeholder="batch" id="batch" name="batch" required value="' . $row->batch . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<select class="form-control" id="department" name="department" >';
                    echo '<option value="' . $row->department . '">' . $row->department . '</option>';
                    echo '<option value="Computer Sciences">Computer Sciences</option>';
                    echo '<option value="Chemical Engineering">Chemical Engineering</option>';
                    echo '<option value="Electrical Engineering">Electrical Engineering</option>';
                    echo '<option value="Civil Engineering">Civil Engineering</option>';
                    echo '<option value="Mechanical Engineering">Mechanical Engineering</option>';
                    echo '<option value="BBA">BBA</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<input class="form-control" type="email" placeholder="email" id="email" name="email" required value="' . $row->email . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<input class="form-control" type="password" placeholder="password" id="password" name="password" required value="' . $row->password . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<a href="'.base_url().'User/UserPhoto/'.$row->id.'">Update Photo </a>';
                    echo '</div>';
                }
                ?>
                <input class="btn btn-default" type="submit" value="Save Changes">
            </form>
        </div>
    </article>
    <!-- /.container -->
</div>
<!-- /.wrapper -->
<?php include_once('_defaultFooter.php') ?>
