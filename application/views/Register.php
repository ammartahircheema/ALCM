<?php include_once('_defaultHeader.php') ?>
<!-- WRAPPER -->
<div class="wrapper">

    <!-- .page-header -->
    <header class="page-header container text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="icon" data-icon="Z"></div>
            <h1>— User Register —</h1>
        </div>
        <!-- /.page-header -->

        <!-- CONTAINER -->
        <article class="container text-center">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 no-padding">
                <form action="<?php echo base_url() . 'User/ProcessRegister' ?>" method="post">
                    <div style="color: red"><?php
                        if (isset($msg)) {
                            echo str_replace("%20", " ", $msg);
                        }
                        ?></div>
                    <div class="form-group">
                        <input class="form-control text-center" type="text" id="name" name="name" placeholder="name *" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control text-center" type="text" id="batch" name="batch" placeholder="batch *" required>
                    </div>
                    <div class="form-group">

                        <select class="form-control" id="department" name="department" >
                            <option value="Computer Sciences">Computer Sciences</option>
                            <option value="Chemical Engineering">Chemical Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="BBA">BBA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control text-center" type="email" id="email" name="email" placeholder="email *" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control text-center" type="password" id="password" name="password" placeholder="password *" required>
                    </div>
                    <input class="btn btn-default" type="submit" value="Register">
                </form>
            </div>
        </article>
    </header>
    <!-- /.container -->
</div>
<!-- /.wrapper -->

<?php include_once('_defaultFooter.php') ?>
