<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php
    $id=$_POST["id"];
    $name=$_POST["name"];
    $designation=$_POST["designation"];
    $reporting_mgr=$_POST["reporting_mgr"];
    $conn = mysqli_connect("localhost", "root", "","employee") or die("database connection failed");
    $sql = "INSERT INTO employee VALUES ('$id', '$name', '$designation','$reporting_mgr')";
    if (mysqli_query($conn, $sql))
    {}else
    {
        echo '<script type="text/javascript">
                alert("Error while inserting");
              </script>';
      }
    mysqli_close($conn);
    echo '<script type="text/javascript">
            window.location = "homepage.php";
          </script>';
  ?>

</body>
</html>
