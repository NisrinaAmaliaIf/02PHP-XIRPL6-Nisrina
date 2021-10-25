<?php 
//koneksi db
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "sekolah";

    $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_connect($koneksi));


    //jk button simpan diklik
    if(isset($_POST['bsimpan'])){

        //pengujian data akan diedit atau simpan baru
        if($_GET['hal']== "edit")
        {
            //data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE datasiswa SET  
            nis = '$_POST[tnis]',
            nama_siswa = '$_POST[tnamasiswa]',
            jenis_kelamin = '$_POST[tjenis_kelamin]',
            alamat = '$_POST[talamat]',
            id_jurusan = '$_POST[tidjurusan]',
            nama_jurusan = '$_POST[tnamajurusan]' WHERE id_siswa = '$_GET[id]'
            
            ");
                    if($edit)
                    {
                        echo "<script>
                                alert('selamat, ubah data berhasil');
                                document.location= 'index.php';
                            </script>";
                    }
                    else{
                        echo "<script>
                                alert('maaf,ubah data gagal');
                                document.location= 'index.php';
                            </script>";
                    }
            
        }else{
            //data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO datasiswa
            (nis,nama_siswa,jenis_kelamin,alamat,id_jurusan,nama_jurusan) VALUES 
            ('$_POST [tnis]', 
            '$_POST [tnamasiswa]',
            '$_POST [tjeniskelamin]' ,
            '$_POST [talamat]',
            '$_POST [tidjurusan]',
            '$_POST [tnamajurusan]' )");
                    if($simpan)
                    {
                        echo "<script>
                                alert('selamat, simpan data berhasil');
                                document.location= 'index.php';
                            </script>";
                    }
                    else{
                        echo "<script>
                                alert('maaf,simpan data gagal');
                                document.location= 'index.php';
                            </script>";
                    }
                }
        }
    //pengujian jika tombol edit/hapus diklik
    if(isset($_GET['hal']))
    {
        //pengujian edit data
        if($_GET['hal'] == "edit")
        {
            //tampilkan data
            $tampil = mysqli_query($koneksi, "SELECT * FROM datasiswa WHERE id_siswa = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jk data ditemukan, mk data ditampung duluke dlm variabel
                $vnis = $data['nis'];
                $vnamasiswa = $data['nama_siswa'];
                $vjeniskelamin = $data['jenis_kelamin'];
                $valamat = $data['alamat'];
                $vidjurusan = $data['id_jurusan'];
                $vnamajurusan = $data['nama_jurusan'];
            }
        }
        else if ($_GET['hal']== "hapus")
        {
            //mau hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM datasiswa WHERE id_siswa = '$_GET[id]'");
            if($hapus){
                echo "<script>
                                alert('hapus data berhasil');
                                document.location= 'index.php';
                            </script>";
            }
        }
    }

?>

<!DOCTYPE HTML>
<html>
    <head>
        <body>
            <title>DATA SISWA STEMATEL 28</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        </head>
        </body>
        <div class="container">
                <h1 class= "text-center">Data Siswa SMK Telkom Purwokerto</h1>
                <h2 class= "text-center">TS'28</h2>

                <!--awal card form-->
                <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    Form Input Data Siswa Stematel
                </div>
                <div class="card-body">
                    <form method= "post" action="">
                            <div class="form-group">
                                <label>NIS</label>
                                    <input type="text" name= "tnis" value="<?=@$vnis?>" class="form-control" placeholder="Input NIS Anda di sini" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                    <input type="text" name= "tnamasiswa" value="<?=@$vnamasiswa?>"class="form-control" placeholder="Input Nama Anda di sini" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                    <input type="text" name= "tjeniskelamin" value="<?=@$vjeniskelamin?>" class="form-control" placeholder="Input Jenis Kelamin Anda di sini" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                    <textarea class="form-control" name="talamat" placeholder="Input Alamat Anda di sini"><?=@$valamat?></textarea>
                            </div>
                            <div class="form-group">
                                <label>ID Jurusan</label>
                                    <input type="text" name= "tidjurusan" value="<?=@$vidjurusan?>" class="form-control" placeholder="Input ID Jurusan Anda di sini" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Jurusan</label>
                                    <input type="text" name= "tnamajurusan" value="<?=@$vnamajurusan?>" class="form-control" placeholder="Input Jurusan Anda di sini" required>
                            </div>

                            <button type="submit" class= "btn btn-success" name="bsimpan">Simpan</button>
                            
                    </form>
                </div>
                </div>
                    <!--akhir card form-->  

                    <!--awal card tabel-->
                <div class="card mt-3">
                <div class="card-header bg-success text-white">
                   Daftar Data Siswa Stematel
                </div>
                <div class="card-body">
                    <table class= "table table-bordered table-striped">
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>ID Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $no = 1;
                            $tampil = mysqli_query($koneksi,"SELECT * FROM datasiswa order by id_siswa DESC");
                            while($data = mysqli_fetch_array($tampil)) :
                                ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$data['nis'] ?></td>
                            <td><?=$data['nama_siswa'] ?></td>
                            <td><?=$data['jenis_kelamin'] ?></td>
                            <td><?=$data['alamat'] ?></td>
                            <td><?=$data['id_jurusan'] ?></td>
                            <td><?=$data['nama_jurusan'] ?></td>
                            <td><a href="index.php?hal=edit&id=$data['id_siswa']?>" class= "btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus&id=$data['id_siswa']?>" onclick="
                                return confirm('Apakah yakin ingin menghapus data ini?'>" class = "btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; //penutup looping while ?>
                    </table>
                    
                </div>
                </div>
                    <!--akhir card tabel--> 
</div>     
                <script type="text/javascript" src="js/bootstrap.min.js"></script>
        </body>

    
</html>