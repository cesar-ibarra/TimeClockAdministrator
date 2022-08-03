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


// query & result
/* $query = "SELECT * FROM sortable WHERE IFNULL(ddate , '') = '' ORDER BY ronumber ASC";
$result = mysqli_query( $conn, $query ); */
/* 
// query & result
$queryUsers = "SELECT * FROM users";
$resultUsers = mysqli_query( $conn, $queryUsers ); */

//query & result
$queryactive = "SELECT * FROM employees WHERE status = '1'";
$resultactive = mysqli_query( $conn, $queryactive );
/* 
$queryReceived = "SELECT * FROM sortable WHERE IFNULL(ddate , '') = '' && IFNULL(rdate , '') != '' ORDER BY ronumber ASC";
$resultReceived = mysqli_query( $conn, $queryReceived ); */
/* 
$totalSor = mysqli_num_rows($result);
$totalUsers = mysqli_num_rows($resultUsers); */
$totalactive = mysqli_num_rows($resultactive);

// $receivedSor = mysqli_num_rows($resultReceived);

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Time Clock added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updated' ) {
        $alertMessage = "<div class='alert alert-success'>Time Card updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Time Clock deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

// close the mysql connection
mysqli_close($conn);

include('../includes/header.php');
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php  echo '. .. ...' ?></h3>

                <p>Print Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="report.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php  echo $totalactive ?></h3>
                <p>Active Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
              <a href="activeemployee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-4 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
				<div class="clock">
		           <div id="Date"></div>
		              <ul>
		                <li id="hours"></li>
		                <li id="point">:</li>
		                <li id="min"></li>
		                <li id="point">:</li>
		                <li id="sec"></li>
		              </ul>
		           </div>
              </div>
              <div class="icon">
                <i class="ion ion-ios-alarm"></i>
              </div>
              <a href="" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php

    include('../includes/footer.php');

?>