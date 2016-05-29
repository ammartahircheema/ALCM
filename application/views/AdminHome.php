<?php include_once('_AdminHeader.php') ?>


<!-- WRAPPER -->
<div class="wrapper">

    <!-- CONTAINER -->
    <article class="container">
        <h3 class="text-center">— InActive Users—</h3>
        <div class="table-responsive">
            <table class="table shop_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Batch</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($results as $row) {
                        echo '<tr><td class="order-number"><a href="#">' . $row->id . '</a></td>';
                        echo '<td class="order-date">' . $row->name . '</td>';
                        echo '<td class="order-date">' . $row->batch . '</td>';
                        echo '<td class="order-total">' . $row->department . '</td>';
                        echo '<td class="order-date">' . $row->email . '</td>';
                        echo '<td class="order-actions text-right"><a href="' . base_url() . 'Admin/setActive/' . $row->id . '">Active</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </article>
    <!-- /.container -->
    <!-- CONTAINER -->
    <article class="container">
        <h3 class="text-center">— Active Users—</h3>
        <div class="table-responsive">
            <table class="table shop_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Batch</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($InActive as $row) {
                        echo '<tr><td class="order-number"><a href="#">' . $row->id . '</a></td>';
                        echo '<td class="order-date">' . $row->name . '</td>';
                        echo '<td class="order-date">' . $row->batch . '</td>';
                        echo '<td class="order-total">' . $row->department . '</td>';
                        echo '<td class="order-date">' . $row->email . '</td>';
                        echo '<td class="order-actions text-right"><a href="' . base_url() . 'Admin/setInActive/' . $row->id . '">InActive</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </article>
    <!-- /.container -->
</div>
<!-- /.wrapper -->


<?php include_once('_defaultFooter.php') ?>
