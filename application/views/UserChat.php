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
        <ul id="messages"></ul>
        <form action="">
            <input id="m" autocomplete="off" /><button>Send</button>
        </form>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <!--<script src="node_modules/socket.io/node_modules/socket.io-client/socket.io.js" type="text/javascript"></script>-->
        <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
        <script>
            var socket = io();
            $('form').submit(function () {
                socket.emit('chat message', {id: 1, name: 'mubeen', msg: $('#m').val()});
                $('#m').val('');
                return false;
            });
            socket.on('chat message', function (msg) {
                $('#messages').append($('<li>').text(msg.msg));
            });
        </script>

</article>
<!-- /.container -->

<?php include_once('_defaultFooter.php') ?>
