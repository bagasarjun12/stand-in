<?php
include 'koneksi.php';

//memanggil method fungsi
require 'fungsi.php';

//query select table stand
$id = $_GET['id'];
$q = "select * from stand where ID_STAND='$id'";
$result = mysqli_query($conn, $q);
$data = mysqli_fetch_array($result);

$idbahan = $data['ID_BAHAN'];
//query select table bahan
$q = "select * from bahan_stand where ID_BAHAN='$idbahan'";
$result = mysqli_query($conn, $q);
$bahan = mysqli_fetch_array($result);

$idjenis = $data['ID_JENIS'];
//query select table jenis
$q = "select * from jenis_stand where ID_JENIS='$idjenis'";
$result = mysqli_query($conn, $q);
$jenis = mysqli_fetch_array($result);

$iduser = $data['ID_USER'];
//query select table user
$q = "select * from user where ID_USER='$iduser'";
$result = mysqli_query($conn, $q);
$user = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/index.css" type="text/css">
    <title>Home <Stand class="in"></Stand>
    </title>

    <style>
        .main {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        label{
            margin-left : 20px;
        }
        .posisi-gambar{
            display: flex;
            float : left;
        }

        .gambar-stand{
                height: 350px;
                width: 400px;
                background-color: white;
        }
        .judul{
            font-size: 30px;
            display: block;
        }
        .ket{
            margin-bottom : 20px;
            font-size: 20px;
        }
        .konten{
            padding: 10px 10px 10px 10px;
            font-size: 17px;
            background-color: white;
            border-radius: 0.5em;
            text-align: center;
            border: 2px solid black;
        }

        td{
            width : 800px;
            text-align : left;
            height : 50px;
        }

        .text-area{
            width : 90%;
            height : 300px;
            padding: 10px 10px 10px 10px;
            font-size: 17px;
            background-color: white;
            border-radius: 0.5em;
            text-align: left;
            border: 2px solid black;
            display: block;
        }
        .deskripsi{
            font-size: 20px;
            display:block;
            display: block;
        }

        .tab-deskripsi{
            width: 50%;
        }

        .wa{
            display: flex;
            float : left;
            margin-left:10px;
            width : 150px;
            height: 70px;
        }
        .width{
            width:60%;
        }
    </style>

</head>

<body>
    <div class="header">
        <nav>
            <h4>Standin</h4>
            <ul class="nav-links">
                <li><a href="">About</a></li>
                <li><a href="">Contacts</a></li>
                <li class="btn"><a href="signup.php">Sign Up</a></li>
                <li class="btn"><a href="login.php">Log In</a></li>
            </ul>
        </nav>
    </div>

    <div>
        <div class="posisi-gambar">
                    <img src="img/<?php echo $data['FOTO_STAND'];?>" class="gambar-stand" border="3"></img> 
        </div>
    <div class= "main">
    <label class="judul"><b><?php echo $data['JUDUL']; ?></b> </label>
        <table>
            <tr>
                <td>
                    <label class="ket"> Ukuran</label>
                </td>
                <td>
                    <label class="ket"> Jenis Stand</label>
                </td>
            </tr>
            <tr>
                <td>
                <label class="konten"><?php echo $data['UKURAN'];?> </label>
                </td>
                <td>
                    <label class="konten"><?php echo $jenis['NAMA_JENIS'];?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="ket"> Harga</label>
                </td>
                <td>
                    <label class="ket"> Bahan Stand</label>
                </td>
            </tr>
            <tr>
                <td>                  
                    <label class="konten">Rp.<?php echo $data['HARGA_STAND'];?> / Bulan</label>
                </td>
                <td>
                    <label class="konten"><?php echo $bahan['NAMA_BAHAN'];?> </label>
                </td>
            </tr>
        </table>  
        <table>
            <tr>
                <td class="tab-deskripsi">
                <label class="deskripsi"> Deskripsi</label>
                </td>
                <td>
                <label class="ket"> Kota</label>
                </td>
            </tr>
            <tr>
                <td class="tab-deskripsi" rowspan="6">
                <label class="text-area"><?php echo $data['DESKRIPSI'];?></label>
                </td>
                <td>
                <label class="konten"><?php echo $data['KOTA'];?> </label>
                </td>
            </tr>
            <tr>
                <td class="width">
                <label class="ket"> Alamat</label>
                </td>
                <td>
            </tr>
            <tr>
                <td class="width">
                <label class="konten"><?php echo $data['ALAMAT'];?> </label>
                </td>
            </tr>
            <tr>
                <td class="width">
                <label class="ket"> No Telp</label>
                </td>
            </tr>
            <tr>
                <td class="width">
                <label class="konten"><?php echo $user['NO_TELP_USER'];?> </label>
                </td>
            </tr>
            <tr>
                <td class="width">
                <?php 
                //ganti angka 0 didepan nomor telp menjadi 62
                $nomor = $user['NO_TELP_USER'];
                $hp = substr_replace($nomor,'62',0,1);
                ?>
                <a href='https://wa.me/<?php echo $hp?>?text=Haloo, saya melihat iklan "<?php echo $data['JUDUL']; ?>" yang anda sewakan di Stand.in, apakah stand tersebut masih tersedia ?' target='_blank'>
                    <img src='public/img/whatsapp-click.png' class="wa"/> 
                </a>
                </td>
            </tr>

    </div>
    </div>
    

</body>
</html>
