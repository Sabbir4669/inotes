<?php
//INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'go to sell a book', 'i want sell my book ASAP', current_timestamp());
//connection database
$insert=false;
$update=false;
$delete=false;
$servername="localhost";
$username="root";
$password="";
$dbname="notes";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
    die("Sorry failed to connect " . mysqli_connect_error());
}
else
{
    //echo "Connection was Successfully <br>";
}
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `sno` = $sno";
  $result=mysqli_query($conn,$sql);
}

if($_SERVER['REQUEST_METHOD'] =='POST')
{
  if(isset($_POST['snoEdit']))
  {
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["desEdit"];

$sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";

$result=mysqli_query($conn,$sql);
if($result)
{
    $update=true;

}
else
{
    echo "Update could not successfully";
}
  }
  else{

$title=$_POST['notetitle'];
$description=$_POST['notedes'];

$sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";

$result=mysqli_query($conn,$sql);

if($result)
{
    $insert=true;
    //echo "New record created succesfully! <br>";
}
else
{

    echo"table not created because of error " . mysqli_connect_error($conn);
}
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
    </script>

  <title>iNotes</title>

</head>

<body>

  <!-- edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button>


<!-- edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit This Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/CRUD/index8.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="titleEdit" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit">
            </div>
            <div class="mb-3">
              <label for="desEdit">Note Description</label>
              <textarea class="form-control" name="desEdit" id="desEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">iNotes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/CRUD/index8.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
       
       if($insert)
       {
         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
         <strong>Success!</strong> Your Notes Inserted Successfully!
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       }

       ?>
  <?php
       
       if($delete)
       {
         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
         <strong>Success!</strong> Your Notes deleted Successfully!
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       }

       ?>
  <?php
       
       if($update)
       {
         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
         <strong>Success!</strong> Your Notes updated Successfully!
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       }

       ?>
  <div class="container mt-3">
    <h1>Add a Note</h1>
    <form action="/CRUD/index8.php" method="post">
      <div class="mb-3">
        <label for="notetitle" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="notetitle" name="notetitle">
      </div>
      <div class="mb-3">
        <label for="notedes">Note Description</label>
        <textarea class="form-control" name="notedes" id="notedes" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>
  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Discription</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
         
         $sql="SELECT * FROM `notes`";
         $result=mysqli_query($conn,$sql);
         $sno=0;
         while($row=mysqli_fetch_assoc($result))
     {    
         
        $sno=$sno+1;
         echo "<tr>
         <th scope='row'>". $sno ."</th>
         <td>". $row['title'] ."</td>
         <td>". $row['description'] ."</td>
         <td> <button class=' edit btn btn-sm btn-primary' id=" .$row['sno'].">Edit</button> <button class='delete edit btn btn-sm btn-primary' id=d" .$row['sno'].">Delete</button> </td>
       </tr>";
     }
 
   ?>
      </tbody>
    </table>


  </div>
  <hr>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        desEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        sno = e.target.id.substr(1,);

        if (confirm("Are You Sure?")) {
          console.log("yes");
          window.location = `/CRUD/index8.php?delete=${sno}`;
        }
        else {
          console.log("no");
          window.location = "/CRUD/index8.php";
        }


      })
    })
  </script>
</body>

</html>