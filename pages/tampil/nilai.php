<?php $data['judul'] = "Data Nilai";
$data['ajax'] = "nilai";
include('templates/header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        include("../../php/koneksi.php");
        $perhalaman = 8;
        $cari = mysqli_query($koneksi, "SELECT * FROM nilai");
        $semuadata = mysqli_num_rows($cari);
        $halaman = ceil($semuadata / $perhalaman);
        $aktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $awal = ($perhalaman * $aktif) - $perhalaman;
        $sql = mysqli_query($koneksi, "SELECT * FROM nilai ORDER by nis asc LIMIT $awal, $perhalaman");
        ?>
        <table border="1" class="table">
            <tbody>
                <tr>
                    <td align="center">
                        <table align="right" style="margin-right:20px; margin-top:10px;">
                            <tbody>
                                <form action="" method="POST">
                                    <tr>
                                        <th>Cari Data : </th>
                                        <th><input type="text" name="cari" id="cari"></th>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                        <div id="bungkus">
                            <table border="1" class="table table-bordered" style="margin-top:50px; margin-bottom:60px;">
                                <tbody>
                                    <tr>
                                        <td align="center" class="header">Nis</td>
                                        <td align="center" class="header">Nama</td>
                                        <td align="center" class="header">Mapel</td>
                                        <td align="center" class="header">Nilai</td>
                                        <td align="center" class="header">Aksi</td>
                                    </tr>
                                    <tr><?php
                                        while ($tampil = mysqli_fetch_array($sql)) {
                                            $kk = $tampil['kode_mapel'];
                                            $aa = $tampil['nis'];
                                            $ambil = mysqli_query($koneksi, "SELECT * from mapel WHERE kode_mapel=$kk");
                                            $ambil2 = mysqli_fetch_array($ambil);
                                            $ambil3 = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * from siswa WHERE nis=$aa")); ?>
                                            <td class="isi" align="center"><?php echo $tampil['nis']; ?></td>
                                            <td class="isi" align="center"><?php echo $ambil3['nama']; ?></td>
                                            <td class="isi" align="center"><?php echo $ambil2['mapel']; ?></td>
                                            <td class="isi" align="center"><?php echo $tampil['nilai']; ?></td>
                                            <td align="center"><a type="button" class="btn btn-info" href="edit/nilai.php?kode=<?php echo $tampil['kode_penilaian']; ?>">Edit</a><a type="button" class="btn btn-danger" href="hapus/nilai.php?kode=<?php echo $tampil['kode_penilaian']; ?>">Hapus</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <!--NAVIGATION-->
                            <div style="margin-bottom:40px; font-size:25px;">
                                <?php
                                if ($aktif > 1) { ?>
                                    <a href="?halaman=<?php echo $aktif - 1; ?>">&laquo</a>
                                <?php } ?>
                                <?php
                                for ($i = 1; $i <= $halaman; $i++) {
                                    if ($i == $aktif) { ?>
                                        <a href="?halaman=<?php echo $i; ?>" style="font-weight:bold; color:aqua;"><?php echo $i; ?> </a> |
                                    <?php } else { ?>
                                        <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?> </a> |
                                    <?php } ?>
                                <?php
                                }
                                ?>
                                <?php
                                if ($aktif < $halaman) { ?>
                                    <a href="?halaman=<?php echo $aktif + 1; ?>">&raquo</a>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php include('templates/footer.php'); ?>