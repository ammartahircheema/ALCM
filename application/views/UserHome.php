<?php include_once('_UserHeader.php') ?>
<!-- WRAPPER -->
<div class="wrapper">


    <!-- .page-header -->
    <header class="page-header container text-center">
        <div class="col-md-8">
            <div class="icon" data-icon="N"></div>
            <h1>NFC IEFR Alumi Linkage and Chat Module</h1>
            <h2>User Home</h2>
        </div>
        <?php
            echo '<div class="col-md-4" >';
            echo '<marquee direction="up" style="border: #F9E0E4 1px solid;border-radius: 8px;">';
            foreach ($results as $row) {
                echo '<h5>' . $row->title . ' <small>' . $row->msg . '</small></h5><br>';
            }
            echo '</marquee></div>';
        ?>
    </header>
    <!-- /.page-header -->
    
    <!--
    <?php 
    echo $this->db->last_query();
    ?>
    -->
    
</div>

<?php include_once('_defaultFooter.php') ?>
