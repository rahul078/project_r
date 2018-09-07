<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
  <title>Homepage</title>
  <script>
  function callHiderFunction(){

    var x = document.getElementById('hider');
   if (x.style.display === 'none') {
       x.style.display = 'block';
   } else {
       x.style.display = 'none';
   }
}
}
  </script>
<?php
  $conn = mysqli_connect("localhost", "root", "","employee") or die("databse connection failed");
  $sql = "SELECT name FROM employee";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>

</head>
<body>
  <!--Bootstrap Navigation bar responsive -->
  <div id="navigation_bar">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">AppName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="homepage.php">Table View</a></li>
        <li class="active"><a href="#">List View</a></li>
    </ul>
    </div>
  </div>
</nav>
</div>
<!-- End of Bootstrap Navigation bar responsive -->
<div class="row">
<div class="col-sm-9">
  <h2 style="margin-left:11%; font-family: "Times New Roman", Times, serif;">EMPLOYEE LIST</h2>
</div>
<div class="col-sm-3">
  <button class="button2" onclick="myFunction()">Add New</button>

</div>
<br /><br />
</div>
<div class="row"><div class="col-sm-12" id="hider" style="margin-left:8%; width:84%; margin-right:8%; display:none;">
  <form action="insert.php" method="post">
    <div class="form-group">
      <label for="id">Employee id:</label>
      <input type="text" class="form-control" id="id" placeholder="Enter Employee id" name="id">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label for="designation">Designation:</label>
      <input type="text" class="form-control" id="designation" placeholder="Enter Designation" name="designation">
    </div>
    <label for="reporting_mgr">Select Reporting Manager</label>
      <select class="form-control" id="reporting_mgr" name="reporting_mgr">
        <?php
        while($row = mysqli_fetch_assoc($result))
          echo "<option>".$row["name"]."</option>";
        ?>
      </select><br />
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</div>
<script>
function myFunction() {
    var x = document.getElementById('hider');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>

<br />
<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-6">
    <?php
    function returnEmployeeArray($mgr){
      $conn = mysqli_connect("localhost", "root", "","employee") or die("database connection failed");
      $sql1 = "SELECT name FROM employee where mgr_name='$mgr'";
        $result1 = mysqli_query($conn, $sql1);
        $res_array=array();
        if (mysqli_num_rows($result1) > 0) {
      while($row = mysqli_fetch_assoc($result1)){
        $name=$row["name"];
          array_push($res_array,$name);
      }}
      mysqli_close($conn);
      return $res_array;
    }


        $conn = mysqli_connect("localhost", "root", "","employee") or die("database connection failed");
        $sql = "SELECT   DISTINCT
            mgr_name
        FROM
            employee
        WHERE
            mgr_name > ''
        ";
        $result = mysqli_query($conn, $sql);
        $main_array=array();
        mysqli_close($conn);
        while($row = mysqli_fetch_assoc($result)){
            $mgr=$row["mgr_name"];

            $res_array=returnEmployeeArray($mgr);
            $main_array[$mgr]=$res_array;

        }
          $conn = mysqli_connect("localhost", "root", "","employee") or die("databse connection failed");
        $sql = "SELECT name FROM employee where mgr_name=''";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $head=$row["name"];

        $sql = "SELECT name,designation FROM employee";
        $result = mysqli_query($conn, $sql);
        $designation=array();
        while($row = mysqli_fetch_assoc($result)){
            $name2=$row["name"];
            $des=$row["designation"];
            $designation[$name2]=$des;
        }
        mysqli_close($conn);
        echo "<ul>
          <li>$head <span class='designation'>($designation[$head])</span></li>";
          printLowerEmployees($head,$main_array,$designation);
          echo "</ul>";

          function printLowerEmployees($head,$main_array,$designation)
          {
              if(array_key_exists ( $head , $main_array ))
              {
                $sub_array=$main_array["$head"];
                foreach ($sub_array as $iterator) {
                  echo "<ul><li>".$iterator." <span class='designation'>(".$designation[$iterator].")</span></li>";
                  printLowerEmployees($iterator,$main_array,$designation);
                  echo "</ul>";
                }
              }
          }
     ?>
  </div>
  <div class="col-sm-3"></div>

</div>
</body>
</html>
