<?php
require_once 'lib/library.php';
$value = "Submit";
$values = "submit";

$class = new Input;
if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $class->addUser($nama, $alamat);
}

if(isset($_GET['no'])) {

    $edit = $class->editUser($_GET['no']);
    $show = $edit->fetch_assoc();
    $value = "Update";
    $values = "send";
    
}

if(isset($_POST['send'])) {

    $id = $_GET['no'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $stmt = $class->updateUser($id, $nama, $alamat);
    if ($stmt == 'sukses') {
        
        header('Location: index.php');
    } else {
        echo "<script>alert('Error ')</script>";
    }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/style.css">
    <title>Crud</title>
  </head>
  <body>
      <div class="wrap">
        <h2>Crud in 1 file</h2>
        <form action="" method="post">
            <input type="text" name="nama" placeholder="nama" value="<?= $show['nama']?>">
            <input type="text" name="alamat" placeholder="alamat" value="<?= $show['alamat']?>">
            <input type="submit" value="<?= $value?>" name="<?= $values?>">
        </form>
      </div>
    
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th style="width: 200px; height: 30px;">Nama</th>
                <th style="width: 200px; height: 30px;">Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            $show = $class->showUser();
            if ($show->num_rows > 0 ) {

                while ($data = $show->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $i++;?></td>
                        <td><?= $data['nama'];?></td>
                        <td><?= $data['alamat'];?></td>
                        <td><a href="index.php?no=<?= $data['id']?>">edit</a> | <a href="index.php?del=<?= $data['id']?>">Delete</a></td>
                    </tr>
                    <?php
                }
            } else {

                echo "tidak ada data ";
            }
            ?>
        </tbody>
    </table>
<?php 
if(isset($_GET['del'])) {

    $class->deleteUser($_GET['del']);
    header('Location: index.php');
}
?>
  </body>
</html>


