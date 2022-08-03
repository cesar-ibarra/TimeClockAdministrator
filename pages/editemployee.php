<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInAdmin'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// get ID sent by GET collection
$employeeID = $_GET['id_employee'];

// connect to database
include('../includes/connection.php');

// include functions file
include('../includes/functions.php');

// query the database with client ID
$query = "SELECT * FROM employees WHERE id_employee='$employeeID'";
$result = mysqli_query( $conn, $query );

$querytimedetail = "SELECT * FROM timedetail WHERE id_employee='$employeeID'";
$resulttimedetail = mysqli_query( $conn, $querytimedetail );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {
        $employeeName = $row['employee_name'];
        $employeeLastname = $row['employee_lastname'];
        $employeeNumber = $row['employee_number'];
        $department = $row['department'];
        
        $fullname = $employeeName .' '.$employeeLastname;
    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>Nothing to see here. <a href='sor.php'>Head back</a>.</div>";
}


// // if update button was submitted
// if( isset($_POST['update']) ) {
    
//     // set variables
//     $employeeName     	= validateFormData( $_POST["employeename"] );
// 	  $employeeLastname   = validateFormData( $_POST["employeelastname"] );
// 	  $employeeNumber     = validateFormData( $_POST["employeenumber"] );
// 	  $department     	= validateFormData( $_POST["department"] );

// }

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

             <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $sorID; ?>" method="post" class="row">
                <div class="form-group col-sm-6">
                	<p for="employeename">Employee #: <?php echo $employeeNumber; ?></p>
                    <p for="employeename">Name: <?php echo $fullname; ?></p>
                    <p for="employeename">Department: <?php echo $department; ?></p>
                    
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
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
<?php echo $alertMessage; ?>

            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-striped">
<!--                <tbody>-->
                            <thead>  
                               <tr>  
                                    <th>DATE</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    <th>REGULAR TIME</th>
                                    <th>OVER TIME</th>
                                    <th>TOTAL TIME</th>
                                    <th>EDIT TIME</th>
                               </tr>  
                            </thead>  
                          <?php 
                  
                  if( mysqli_num_rows($resulttimedetail) > 0 ) {
                          while($row = mysqli_fetch_array($resulttimedetail))  
                          { 

                               echo '  
                               <tr>  
                                    <td>'.$row["date_set"].'</td>  
                                    <td>'.$row["time_in_one"].'</td>  
                                    <td>'.$row["time_out_one"].'</td>  
                                    <td>'.$row["time_in_two"].'</td>
                                    <td>'.$row["time_out_two"].'</td>
                                    <td>'.$row["regular_time"].'</td>
                                    <td>'.$row["over_time"].'</td>
                                    <td>'.$row["total_time"].'</td>
                                    <td class="text-center"><a href="editemployeetime.php?id_timedetail=' . $row["id_timedetail"] . '" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit text-center"></i>
                    </a></td>
                             
                               </tr>  
                               ';  
                          } 
                      } else { // if no entries
                            echo "<div class='alert alert-warning'>You have no Employee registred!</div>";
                        }

                        mysqli_close($conn);

                          ?>  
<!--                </tbody>-->
              </table>
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