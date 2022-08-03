<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInAdmin'] ) {
    
    // send them to the login page
    header("Location: ../index.php");
}

// connect to database
include('../includes/connection.php');

// query & result
$query = "SELECT * FROM administrator";
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New Administrator added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Administrator updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Administrator deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
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
            <h1>Administrators</h1>
          </div>
          <div class="col-sm-6 text-right">
          	<a href="addadministrator.php" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add Administrator</a>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                                    <th>EMPLOYEE #</th>
                                    <th>NAME</th>
                                    <th>JOB TITLE</th>
                                    <th class="text-center">EDIT</th> 
                               </tr>  
                            </thead>  
                          <?php 
                  
                  if( mysqli_num_rows($result) > 0 ) {
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["employee"].'</td>  
                                    <td>'.$row["fullname"].'</td>  
                                    <td>'.$row["jobtitle"].'</td>  
                                    <td><a href="" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit text-center"></i>
                    </a></td>
                               </tr>  
                               ';  
//                                editadministrator.php?id=' . $row['id'] . '
                          } 
                      } else { // if no entries
                            echo "<div class='alert alert-warning'>You have no Adminisitrator registred!</div>";
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