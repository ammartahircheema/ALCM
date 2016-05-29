<?php include_once('_UserHeader.php') ?>

<!-- CONTAINER -->
<article class="container comments-area" id="comments">

    <hr/>

    <section class="comments">
        <div class="comment clearfix">
            <!--
            <div class="col-sm-3 col-xs-2 text-right">
                <a href="#"><img src="../../asserts/images/no-ava.png" alt="" class="img-circle"></a>
            </div>
            -->
        <?php
        foreach ($result as $row) {
            echo '<div class="col-sm-8 col-xs-10"><div class="comment-line">';
            echo '<p><a href="#">'.$row->userid.'</a>, '.$row->timestamp.'</p></div>';
            echo '<p>'.$row->msg.'</p>';
            echo '</div></div>';
        }
        ?>
            
                    
                
            
    </section>
    <hr/>

    <section class="addcomment" id="addcomment">
        <form method="POST" action="<?php echo base_url() . 'User/sendMsg' ?>">
        <div class="comment clearfix">
            <div class="col-sm-8 col-xs-10">
                <input class="form-control" type="text" id="msg" name="msg" placeholder="Your message">
            </div>
            <div class="col-sm-3 col-xs-2 text-right">
                <input class="btn btn-default btn-wd" type="submit" value="Send">
            </div>
        </div>
            </form>
    </section>

</article>
<!-- /.container -->

<?php include_once('_defaultFooter.php') ?>
