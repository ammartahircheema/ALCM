<?php include_once('_defaultHeader.php') ?>

<!-- WRAPPER -->
<div class="wrapper">

    <!-- .page-header -->
    <header class="page-header container text-center">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="icon" data-icon="Z"></div>
            <h1>— OUR Alumni —</h1>
        </div>
    </header>
    <!-- /.page-header -->

    <!-- CONTAINER -->  
    <div class="container team text-center">
        <?php
        foreach ($results as $row) {
            echo '<div class="col-sm-3 person"><a href="#" data-toggle="modal" data-target="#person-1">';
            echo '<img alt="" src="../asserts/images/team/' . $row->photo . '" class="img-circle"></a>';
            echo '<h5>' . $row->name . ' <small>' . $row->department . ' - ' . $row->batch . '</small></h5>';
            echo '</div>';
        }
        ?>
    </div>
    <!-- /.container -->
</div>
<!-- /.wrapper -->
<?php include_once('_defaultFooter.php') ?>
