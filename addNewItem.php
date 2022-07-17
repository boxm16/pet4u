<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add New Item</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                <center> ΚΑΙΝΟΥΡΙΟ ΠΡΟΪΟΝ</center>
                <hr>
                <form action="requestDispatcher.php" method="POST">
                    <input hidden name='addNewItem'>
                    <table class="table table-bordered">

                        <tr>
                            <td>ΠΕΡΙΓΡΑΦΗ</td>
                            <td><input type="text" size="120" name='description'></td>
                        </tr>
                        <tr>
                            <td>ΚΩΔΙΚΟΣ</td>
                            <td><input type="text" size="50" name='code'></td>
                        </tr>
                        <tr>
                            <td>ΘΕΣΗ</td>
                            <td><input type="text" size="50" name='position'></td>
                        </tr>
                        <tr>
                            <td>BARCODE ΤΕΜΑΧΙΟΥ</td>
                            <td><input type="text" size="120" name='barcode'></td>
                        </tr>
                        <tr>
                            <td> BARCODE ΚΟΥΤΙΟΥ:</td>
                            <td><input type="text" size="120" name='boxBarcode'></td>
                        </tr>
                        <tr>
                            <td> ΤΕΜΑΧΙΑ ΣΤΟ ΚΟΥΤΙ</td>
                            <td><input type="number" name='itemsInBox'></td>
                        </tr>
                         <tr>
                            <td>SITE</td>
                            <td><input type="text" size="120" name='site'></td>
                        </tr>
                        <tr>
                            <td colspan="2"> <button class="btn btn-primary" type="submit">ΚΑΤΑΧΩΡΗΣΗ</button></td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
