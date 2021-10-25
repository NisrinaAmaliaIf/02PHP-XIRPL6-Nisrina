<?php
//koneksi
$conn = mysqli_connect("localhost","root","","sekolah");

if (!$conn){
  echo "koneksi gagal" . mysqli_connect_error();
}
?>

<!doctype html>
<html>
  <head>
    <title></title>
    </head>
      <body>
        <h1>Data Siswa</h1>

          
          <form method="get" action="">
          <label for="cari">Cari Siswa</label>
            <input type="text" name= "cari"></form> <br/>


            <table border= "1"> 
              <thead>
                <tr>
                    <td>No</td>
                    <td>NIS</td>
                    <td>Nama</td>
                    <td>Jenis Kelamin</td>
                    <td>Alamat</td>
                    <td>ID Jurusan</td>
                    <td>Nama Jurusan</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  //tampilkan data tabel produk
                  $query = mysqli_query($conn, "SELECT * FROM datasiswa");

                if(isset($_GET['cari'])){
                  $query = mysqli_query($conn, "SELECT * FROM datasiswa
                  WHERE nama_siswa LIKE '%".
                    $_GET['cari']. "%'");
                }

                  while ($dt = mysqli_fetch_assoc($query)){
                
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dt['nis']; ?></td>
                    <td><?= $dt['nama_siswa']; ?></td>
                    <td><?= $dt['jenis_kelamin']; ?></td>
                    <td><?= $dt['alamat']; ?></td>
                    <td><?= $dt['id_jurusan']; ?></td>
                    <td><?= $dt['nama_jurusan']; ?></td>

                  </tr>

                <?php }
                ?>

              </tbody>
            </table>        
        </body>
    
  </html>