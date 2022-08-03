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
if( isset( $_POST['addadmin'] ) ) {
    
    // set all variables to empty by default
    $aUsername = $aPassword = $aEmployee = $aFullname = $aJobtittle = $aPrivileges = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    // these inputs are not required
    // so we'll just store whatever has been entered
    $aUsername = validateFormData( $_POST["aUsername"] );
    $aPassword = validateFormData( $_POST["aPassword"] );
    $aEmployee = validateFormData( $_POST["aEmployee"] );
    $aFullname  = validateFormData( $_POST["aFullname"] );
    $aJobtitle  = validateFormData( $_POST["aJobtitle"] ); 
    $aPrivileges  = validateFormData( $_POST["aPrivileges"] );
    $aPassword    = password_hash($aPassword, PASSWORD_DEFAULT);
    
    // if required fields have data
//    if( $sorRoNumber && $sorParts ) {
        
        // create query
        $query = "INSERT INTO administrator (id, username, password, employee, fullname, jobtitle, privileges) VALUES (NULL, '$aUsername', '$aPassword', '$aEmployee', '$aFullname', '$aJobtitle', '$aPrivileges')";
    
        
        $result = mysqli_query( $conn, $query );
        
        // if query was successful
        if( $result ) {
            
            // refresh page with query string
            header( "Location: administrator.php?alert=success" );
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
            <h1>Add Administrator</h1>
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
                <label for="username">Username*</label>
                <input type="text" class="form-control input-lg" id="aUsername" name="aUsername" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="password">Password*</label>
                <input type="text" class="form-control input-lg" id="aPassword" name="aPassword" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="employeenumber">Employee Number*</label>
                <input type="text" class="form-control input-lg" id="aEmployee" name="aEmployee" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="fullname">Full Name*</label>
                <input type="text" class="form-control input-lg" id="aFullname" name="aFullname" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="jobtitle">Job Title*</label>
                <input type="text" class="form-control input-lg" id="aJobtitle" name="aJobtitle" value="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="privileges">Privilege*</label>
                <select class="custom-select form-control input-lg" id="aPrivileges" name="aPrivileges" value="" required>
                  <option value="Manager">Manager</option>
                  <option value="Administrator">Administrator</option>
                </select>
            </div>
        
        <div class="row mb-2">
        	<div class="col-sm-6 text-left">
        		<a href="administrator.php" type="button" class="btn btn-lg btn-default">Cancel</a>
        	</div>
        	<div class="col-sm-6 text-right">
        		<button type="submit" class="btn btn-lg btn-primary" name="addadmin">ADD ADMINISTRATOR</button>
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