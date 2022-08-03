<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInAdmin'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// get ID sent by GET collection
$idTimeDetail = $_GET['id_timedetail'];

// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM timedetail WHERE id_timedetail='$idTimeDetail'";
$result = mysqli_query( $conn, $query );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) { 
        
        $timeinOne    =    $row["time_in_one"];  
        $timeoutOne   =    $row["time_out_one"];
        $calcTimeOne  =    $row["calc_time_one"];  
        $timeinTwo    =    $row["time_in_two"];
        $timeoutTwo   =    $row["time_out_two"];
        $calcTimeTwo  =    $row["calc_time_two"]; 
        $regulartime  =    $row["regular_time"];
        $overtime     =    $row["over_time"];
        $total_time   =    $row["total_time"];
        $id_employee  =    $row["id_employee"];
    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='users.php'>Head back</a>.</div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables
    $timeinOne = validateFormData( $_POST["timeinone"] );
    $timeoutOne  = validateFormData( $_POST["timeoutone"] );
    $calcTimeOne    = validateFormData( $_POST["calctimeone"] );
    $timeinTwo    = validateFormData( $_POST["timeintwo"] );
    $timeoutTwo    = validateFormData( $_POST["timeouttwo"] );
    $calcTimeTwo    = validateFormData( $_POST["calctimetwo"] );
    $regulartime  = validateFormData( $_POST["regulartime"] );
    $overtime    = validateFormData( $_POST["overtime"] );
    $totalTime    = validateFormData( $_POST["totaltime"] );
    

    $newtotaltime = $calcTimeOne + $calcTimeTwo;
    if ($calcTimeTwo=='NaN'){
        $calcTimeTwo = '0.00';
    }
    // new database query & result
    $query = "UPDATE timedetail
            SET time_in_one='$timeinOne',
            time_out_one='$timeoutOne',
            calc_time_one='$calcTimeOne',
            time_in_two='$timeinTwo',
            time_out_two='$timeoutTwo',
            calc_time_two='$calcTimeTwo',
            regular_time = IF( '$newtotaltime' <= 8.00, '$newtotaltime', 8.00),
			over_time = IF( '$newtotaltime' > 8.00, '$newtotaltime' - 8.00, 0.00),
            total_time='$calcTimeOne' + '$calcTimeTwo'
            WHERE id_timedetail='$idTimeDetail'";
    
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: editemployee.php?id_employee=$id_employee&alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn); 
    }
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
            <h1>Edit Employee Time Card</h1>
                     
            <?php echo $alertMessage; ?>
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

            <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id_timedetail=<?php echo $idTimeDetail; ?>" method="post" class="row">
            <div class="form-group col-sm-4">
                    <label for="timeinone">Time In</label>
                    <input type="text" class="form-control input-lg Time1" id="timeinone" name="timeinone" value="<?php echo $timeinOne; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="timeoutone">Time Out</label>
                    <input type="text" class="form-control input-lg Time2" id="timeoutone" name="timeoutone" value="<?php echo $timeoutOne; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <input type="hidden" class="form-control input-lg Hours" id="calctimeone" name="calctimeone" value="<?php echo $calcTimeOne; ?>">
                </div>

                <div class="form-group col-sm-4">
                    <label for="timeintwo">Time In</label>
                    <input type="text" class="form-control input-lg Time11" id="timeintwo" name="timeintwo" value="<?php echo $timeinTwo; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="timeouttwo">Time Out</label>
                    <input type="text" class="form-control input-lg Time22" id="timeouttwo" name="timeouttwo" value="<?php echo $timeoutTwo; ?>">
                </div>

                <div class="form-group col-sm-4">
                    <input type="hidden" class="form-control input-lg Hours1" id="calctimetwo" name="calctimetwo" value="<?php echo $calcTimeTwo; ?>">
                </div>
 
                <div class="form-group col-sm-4">
                    <input type="hidden" class="form-control input-lg" id="regulartime" name="regulartime" value="<?php echo $regulartime; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <input type="hidden" class="form-control input-lg" id="overtime" name="overtime" value="<?php echo $overtime; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <input type="hidden" class="form-control input-lg" id="totaltime" name="totaltime" value="<?php echo $totalTime; ?>">
                </div>

            <hr>

            <div class="row mb-2">
        	<div class="col-sm-6 text-left">
        		<a href="editemployee.php?id_employee=<?php echo $id_employee ?>" type="button" class="btn btn-lg btn-default">Cancel</a>
            </div>
        	<div class="col-sm-6 text-right">
        		<button type="submit" class="btn btn-lg btn-primary" name="update">Update</button>
        	</div>
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



