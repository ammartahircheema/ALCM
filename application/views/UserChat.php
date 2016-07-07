<?php include_once('_UserHeader.php') ?>

<!-- CONTAINER -->
<article class="container comments-area">

    <hr/>

    <section class="comments" id="comments" style="max-height: 400px;overflow-y: scroll;">
        <div id="messages" class="comment clearfix">
            <!--
            <div class="col-sm-3 col-xs-2 text-right">
                <a href="#"><img src="../../asserts/images/no-ava.png" alt="" class="img-circle"></a>
            </div>
            -->

            <?php
            foreach ($result as $row) {
                echo '<div class="col-sm-8 col-xs-10"><div class="comment-line row"><div class="col-lg-8"><img src="../uploads/'
                . ($row->photo == 'user.png' ? 'avatar.jpg' : $row->photo) . '" style="max-height:50px;max-width:50px" /><a href="#">' .
                $row->name . '</a>, </div><div class="col-lg-4">' . $row->timestamp . '</div></div>' . $row->msg . '</div>';
            }
            ?>
        </div>



    </section>
    <hr/>

    <section class="addcomment" id="addcomment">
        <form method="POST">
            <div class="comment clearfix">
                <div class="col-sm-8 col-xs-10">
                    <input class="form-control" type="text" id="msg" autocomplete="off" name="msg" placeholder="Your message">
                </div>
                <div class="col-sm-3 col-xs-2 text-right">
                    <input class="btn btn-default btn-wd" type="submit" value="Send">
                </div>
            </div>
        </form>
    </section>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <!--<script src="node_modules/socket.io/node_modules/socket.io-client/socket.io.js" type="text/javascript"></script>-->
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <?php // var_dump($user->id); //exit(); ?>
    <script>
        var user = {id: <?php echo $user->id ?>, name: '<?php echo $user->name ?>', photo: '<?php echo $user->photo ?>', dept: '<?php echo $user->department ?>'};
        console.log(user);
//        var socket = io();
        var socket = io.connect('http://localhost:3000');
        $('form').submit(function () {
            socket.emit('chat message', {user: user, date: new Date(), msg: $('#msg').val()});
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() . 'User/sendMsg' ?>",
                data: {msg: $('#msg').val()}
            })
                    .done(function (msg) {
//                        alert("Data Saved: " + msg);
                    });
            $('#msg').val('');
            return false;
        });
        socket.on('chat message', function (msg) {
            var asd = $('#comments').html();
            var date = new Date(msg.date);
            asd = asd + '<div class="col-sm-8 col-xs-10"><div class="comment-line row"><div class="col-lg-8"><img src="../uploads/' + (msg.user.photo == 'user.png' ? 'avatar.jpg' : msg.user.photo) +
                    '" style="max-height:50px;max-width:50px" /><a href="#">' + msg.user.name +
                    '</a>, </div><div class="col-lg-4">' + date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds() +
                    '</div></div>' + msg.msg
            '</div>'

            $('#comments').html(asd);
        });
    </script>

</article>
<!-- /.container -->

<?php include_once('_defaultFooter.php') ?>
