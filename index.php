<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
    <title>PHP CRUD</title>
</head>
<body>
    <?php require_once 'process.php'; ?>
    
    <?php
        if(isset($_SESSION['pesan'])):
    ?>

    <div class="alert alert-<?=$_SESSION['tipepesan']?>">
        <?php
            echo $_SESSION['pesan'];
            unset($_SESSION['pesan']);
        ?>
    </div>
    <?php endif; ?>
    <div class="container" style="margin-bottom: 7rem; padding-top: 3rem">
    <h1 class="card-title" style="text-align: center;">COVID-19 Dashboard</h1>
    <div class="card text-white bg-primary mb-3" style="width: 19rem; display: inline-block; margin: 1rem;">
        <div class="card-body">
            <h5 class="card-title">ODP</h5>
            <h1 class="card-text"><?php echo totalStatus("ODP"); ?></h1>
        </div>
    </div>
    <div class="card text-white bg-warning mb-3" style="width: 19rem; display: inline-block; margin: 1rem;">
        <div class="card-body">
            <h5 class="card-title">PDP</h5>
            <h1 class="card-text"><?php echo totalStatus("PDP"); ?></h1>
        </div>
    </div>
    <div class="card text-white bg-danger mb-3" style="width: 19rem; display: inline-block; margin: 1rem;">
        <div class="card-body">
            <h5 class="card-title">Positif</h5>
            <h1 class="card-text"><?php echo totalStatus("Positif"); ?></h1>
        </div>
    </div>
    <div class="card text-white bg-success mb-3" style="width: 19rem; display: inline-block; margin: 1rem;">
        <div class="card-body">
            <h5 class="card-title">Sembuh</h5>
            <h1 class="card-text"><?php echo totalStatus("Sembuh"); ?></h1>
        </div>
    </div>
    <div class="card text-white bg-dark mb-3" style="width: 19rem; display: inline-block; margin: 1rem;">
        <div class="card-body">
            <h5 class="card-title">Meninggal</h5>
            <h1 class="card-text"><?php echo totalStatus("Meninggal"); ?></h1>
        </div>
    </div>
    </div>

    <div class="container">
    <?php
        $mysqli = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']) or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
                while($row=$result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['umur']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a href="index.php?ubah=<?php echo $row['id']; ?>"
                        class="btn btn-info">Ubah</a>
                    <a href="process.php?hapus=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Hapus</a>
                </td>
            </tr>
                <?php endwhile; ?>
        </table>
    </div>

    <?php    
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?=$id;?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?=$nama;?>" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label>Umur</label>
                <input type="number" min="0" max="100" name="umur" class="form-control" value="<?=$umur;?>" placeholder="Masukkan Umur">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?=$alamat;?>" placeholder="Masukkan Alamat">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="ODP" <?php if($status=="ODP"){echo "selected";}?> >ODP</option>
                    <option value="PDP" <?php if($status=="PDP"){echo "selected";}?> >PDP</option>
                    <option value="Positif" <?php if($status=="Positif"){echo "selected";}?> >Positif</option>
                    <option value="Sembuh" <?php if($status=="Sembuh"){echo "selected";}?> >Sembuh</option>
                    <option value="Meninggal" <?php if($status=="Meninggal"){echo "selected";}?> >Meninggal</option>
                </select>
            </div>
            <div class="form-group">
                <?php
                    if($update==true): 
                ?>
                <button type="submit" name="perbarui" class="btn btn-info">Perbarui</button>
                <?php else : ?>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    </div>
    <script type="text/javascript" src="bootstap.min.js"></script>
</body>
</html>