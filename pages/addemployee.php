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

// if add button was submitted
if( isset( $_POST['addemployee'] ) ) {
    
    // set all variables to empty by default
    $eName = $eLastname = $eEmployeeNumber = $eDepartment = $ePassword = $eStatus = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    // these inputs are not required
    // so we'll just store whatever has been entered
    $eName = validateFormData( $_POST["eName"] );
    $ePassword = validateFormData( $_POST["ePassword"] );
    $eLastname    = validateFormData( $_POST["eLastname"] );
    $eEmployeeNumber = validateFormData( $_POST["eEmployeeNumber"] );
    $eDepartment  = validateFormData( $_POST["eDepartment"] );
    $ePassword  = password_hash($ePassword, PASSWORD_DEFAULT);
    $eStatus    = '0';
    
    // if required fields have data
//    if( $sorRoNumber && $sorParts ) {
        
        // create query
        $query = "INSERT INTO employees (id_employee, employee_name, employee_lastname, employee_number, department, passcode, status) VALUES (NULL, '$eName', '$eLastname', '$eEmployeeNumber', '$eDepartment', '$ePassword', '$eStatus')";
    
        
        $result = mysqli_query( $conn, $query );
        
        // if query was successful
        if( $result ) {
            
            // refresh page with query string
            header( "Location: employees.php?alert=success" );
        } else {
            
            // something went wrong
            echo "Error: ". $query ."<br>" . mysqli_error($conn);
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
            <h1>Add Employee</h1>
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

        <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
            <div class="form-group col-sm-6">
                <label for="name">Name*</label>
                <input type="text" class="form-control input-lg" id="eName" name="eName" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="lastname">Lastname*</label>
                <input type="text" class="form-control input-lg" id="eLastname" name="eLastname" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="employeenumber">Employee Number*</label>
                <input type="text" class="form-control input-lg" id="eEmployeeNumber" name="eEmployeeNumber" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="department">Department*</label>
                <select class="custom-select form-control input-lg" id="eDepartment" name="eDepartment" value="" required>
                  <option value="PH-I Parts Department">Parts</option>
                  <option value="PH-S Service Department">Service</option>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label for="password">Password*</label>
                <input type="text" class="form-control input-lg" id="ePassword" name="ePassword" value="" required>
            </div>
        
        <div class="row mb-2">
        	<div class="col-sm-6 text-left">
        		<a href="employees.php" type="button" class="btn btn-lg btn-default">Cancel</a>
        	</div>
        	<div class="col-sm-6 text-right">
        		<button type="submit" class="btn btn-lg btn-primary" name="addemployee">ADD EMPLOYEE</button>
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