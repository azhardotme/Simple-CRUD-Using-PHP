<?php

$conn = mysqli_connect('localhost','root','','crud');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $number =$_POST['number'];

    if(!empty($name) && !empty($number)){
        $sql = "INSERT INTO student(name ,reg_number) VALUE('$name','$number')";

     $result = mysqli_query($conn, $sql);

    if($result){
    echo "Your Data Submitted.";
}
    }else{
        echo "Feild should not be empty!";
    }
}

?>

<?php
if(isset($_GET['delete'])){
    $stdid = $_GET['delete'];
    $sql = "DELETE FROM student WHERE id={$stdid}";
    $deletesql = mysqli_query($conn,$sql);
    if($deletesql){
        echo 'Your Data Deleted.';
    }

}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body>

<div class="container shadow m-5 p-3 ">


<form action="" method="post" class="d-flex justify-content-around">
<input class="form-control" type="text" name="name" placeholder="Enter Your Name">
<input class="form-control" type="number" name="number" placeholder="Enter Your Phone Number">
<input type="submit" value="Submit" name="submit" class="btn btn-success">

</form>


</div>



<div class="container m-5 p-3 ">
<form action="" method="get" class="d-flex justify-content-around">

<?php
    if(isset($_GET['update'])){
        $stdid = $_GET['update'];

        $sql = "SELECT *
        FROM student
        WHERE id='$stdid'";

        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){

            $stdid = $row['id'];
            $stdname=$row['name'];
            $stdreg =$row['reg_number'];
      
?>


<input class="form-control" type="text" name="name" value="<?php echo $stdname; ?>">
<input class="form-control" type="number" name="number" value="<?php echo $stdreg; ?>">
<input type="submit" value="Update" name="update" class="btn btn-primary">

<?php }}?>

<?php
 if(isset($_POST['update'])){


     $stdname =$_POST['name'];
     $stdreg = $_POST['reg_number'];

     $sql2 = "UPDATE student SET name='$stdname',reg_number=$stdreg WHERE id=$stdid";

     $updatequery = mysqli_query($conn,$sql2);
     if($updatequery){
         echo "Updated Data!";
     }
     
 }

?>

</div>


<div class="container">
    <table class="table table-border">
    <tr>
        <th>ID</th>
        <th>Friend Name</th>
        <th>Friend Phone Number</th>
        <th>Action</th>
    </tr>

<?php 

$sql = "SELECT * FROM student";
$result = mysqli_query($conn,$sql);
if($result->num_rows>0){
    while($row=mysqli_fetch_assoc($result)){
        $stdid = $row['id'];
        $stdname = $row['name'];
        $stdreg = $row['reg_number'];
    
?>
    <tr>
     <td><?php echo $stdid; ?></td>
     <td><?php echo $stdname; ?></td>
     <td><?php echo $stdreg; ?></td>
     <td><a href="index.php?update=<?php echo $stdid; ?>" class="btn btn-info">Update</a></td>  
     <td><a href="index.php?delete=<?php echo $stdid; ?>" class="btn btn-danger">Delete</a></td>  
    
    </tr>
<?php
    }
}
?>

</table>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>
