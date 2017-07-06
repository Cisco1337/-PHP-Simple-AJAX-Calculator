<?php
include 'inc/core.inc.php';
include 'inc/config.inc.php';
$core = new Core(TEXT_COLOR);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Simple AJAX Calculator</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="calc">
            <div class="output">
                xd
            </div>
            <?php echo $core->generateCalculator(); ?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        function calc(e){
            var cData = $(e).html();
            $.post( "ajax/calc.ajax.php", {
                data: cData
            }).done(function( data ) {
                //alert( "Data Loaded: " + data );
                var jData = $.parseJSON(data);
                if (typeof jData.evil !== "undefined"){
                    alert("Invalid (possibly) evil data!");
                } else if (typeof jData.previous !== "undefined"){
                    alert(jData.previous);
                } else if (typeof jData.current !== "undefined"){
                    alert(jData.current);
                }
            });
        }
        </script>
    </body>
</html>