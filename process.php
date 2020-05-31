<?php 

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

$mysqli = new mysqli($servername, $username, $password, $dbname) or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nama = '';
$umur = 0;
$alamat = '';
$status = '';

function totalStatus($a)
{
    $mysqli = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']) or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT COUNT(*) AS Jumlah FROM data WHERE status='$a'") or
    die($mysqli->error);
    while ($row = $result->fetch_assoc()) {
        echo $row['Jumlah'];
    }
}

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $mysqli->query("INSERT INTO data (nama, umur, alamat, status) VALUES ('$nama', '$umur', '$alamat', '$status')") or
            die($mysqli->error);

    $_SESSION['pesan']="Data berhasil disimpan!";
    $_SESSION['tipepesan']="success";
        
    header("location: index.php");
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['pesan']="Data berhasil dihapus!";
    $_SESSION['tipepesan']="danger";

    header("location: index.php");
}

if(isset($_GET['ubah'])){
    $id = $_GET['ubah'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if($result->num_rows){
        $row = $result->fetch_array();
        $nama = $row['nama'];
        $umur = $row['umur'];
        $alamat = $row['alamat'];
        $status = $row['status'];
    }
}

if(isset($_POST['perbarui'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $mysqli->query("UPDATE data SET nama='$nama', umur=$umur, alamat='$alamat', status='$status' WHERE id=$id") or
        die($mysqli->error);

    $_SESSION['pesan']="Data berhasil diperbarui!";
    $_SESSION['tipepesan']="warning";

    header("location: index.php");
}

?>