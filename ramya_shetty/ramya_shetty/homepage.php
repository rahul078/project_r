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
$sql1="SELECT * FROM employee";
$result1 = mysqli_query($conn, $sql1);
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
        <li class="active"><a href="#">Table View</a></li>
        <li><a href="list_view.php">List View</a></li>
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
<div class="table-responsive">
  <table class="table TFtable">
    <thead>
      <tr style="background:#CBCBCB">
        <th>E.ID</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Manager</th>
      </tr>
    </thead>
    <tbody>

        <?php
          while($row = mysqli_fetch_assoc($result1)){
            echo "<tr>";
            echo"<td>".$row["id"]."</td>";
            echo"<td>".$row["name"]."</td>";
            echo"<td>".$row["designation"]."</td>";
            echo"<td>".$row["mgr_name"]."</td>";
            echo "  </tr>";
        }

        ?>

    </tbody>
  </table>
  </div>
</div>
</div>
</body>
</html>
