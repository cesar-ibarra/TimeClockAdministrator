<?php

require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

if(isset($_POST['crear'])) {
    //GET HTML Content
    ob_start();
    require_once 'print_view.php';
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf('P','Letter','En','true','UFT-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output('timecard.pdf');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PH | TIMECLOCK | MANAGER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
</head>
<body>

<div class="container">
        <form action="" method="POST">
            <div class="form-group col-sm-3">
                <label for="fromdate">Employee #:</label>
                <input type="text" placeholder="Titulo" name="idemployee" />
            </div>

            <div class="form-group col-sm-3">
                <label for="fromdate">From:</label>
                <input type="text" name="fromdate">
            </div>

            <div class="form-group col-sm-3">
                <label for="todate">To:</label>
                <input type="text" name="todate">
            </div>

        
                <input type="submit" class="btn btn-primary" value="crear un PDF" name="crear" />

        </form>
</div>

</body>

<footer class="text-center footer">
    <hr>
    <small>Coded with &hearts; by <a href="http://cesar-ibarra.com/">Cesar</a> Ibarra</small>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</footer>
</html>

