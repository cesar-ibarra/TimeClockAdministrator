<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInAdmin'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');

require '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

// $query = "SELECT * FROM employees";
// $result = mysqli_query( $conn, $query );


// if generate button was submitted
if( isset($_POST['generate']) ) {

    
    //GET HTML Content
    ob_start();
    require_once 'print_view.php';
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf('P','Letter','En','true','UFT-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output('timecard.pdf');
    
    header( "Location: ../print_pdf.php" );
}

// close the mysql connection
mysqli_close($conn);

include('../includes/header.php');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee Information</h1>
            <?php echo $employeeID; ?>
            <?php echo $alertMessage; ?>
          </div>
			      <div class="col-sm-6 text-right">
          	    <a href="employees.php" class="btn btn-sm btn-primary"><span class="fa fa-arrow-circle-left"></span> Back</a>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            
    <div class="card-body">
    
            <form action="" method="post" class="row">

                <div class="form-group col-sm-3">
                    <label for="idemployee">Employee Number</label>
                    <select class="custom-select form-control input-lg" id="idemployee" name="idemployee" value="">
                        <option value=""><?php echo $employeeNumber; ?></option>
                            <?php
                            if( mysqli_num_rows($result) > 0 ) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row['id_employee'].'">'.$row['employee_number'].'</option>';
                                    $resultEmployee = $row['id_employee'];
                                }
                                
                            } else {
                                echo '<option value="No Data">No Data</option>';
                            }

                            ?>         
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="fromdate">From:</label>
                    <input type="text" class="form-control input-lg" id="datepicker" name="fromdate" value="">
                </div>

                <div class="form-group col-sm-3">
                    <label for="todate">To:</label>
                    <input type="text" class="form-control input-lg" id="datepicker1" name="todate" value="">
                </div>
            
          
                <div class="col-sm-3">
                    <label for="" class="text-white">Generate Report</label>
                    <button type="submit" class="btn btn-lg btn-primary pull-right" name="generate">GENERATE REPORT</button>
                </div>

        </form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
    
  </div>


<?php
include('../includes/footer.php');
?>