<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h1>
            <center>
                <input id="input" type="text" onkeydown="scan(event)">


                <hr>
                <table id="tb">

                </table>
            </center>
        </h1>
        <?php
        // put your code here
        ?>
        <script>
            function scan(event) {
                if (event.keyCode === 13) {
                    var row = tb.insertRow(0);
                    var cell1 = row.insertCell(0);
                    var t = document.getElementById("input").value;
                    cell1.innerHTML = t;
                    document.getElementById("input").value = "";
                }
            }
        </script>
    </body>
</html>
