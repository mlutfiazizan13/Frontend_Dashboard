<?php
include "config/koneksi.php";
include "library/controller.php";

$go = new controller();

$tabel = "product";
@$foto = $_POST['foto'];
@$tanggal = date('Y-m-d');
$redirect = "?menu=product";
@$where = "productID = $_GET[id]"; 
@$tempat = "foto";


if(isset($_POST['simpan'])){
    $foto = $_FILES['foto'];
    $upload = $go->upload($foto, $tempat);
    @$field = array('nama'=>$_POST['product'],
                    'jenisID'=>$_POST['jenis'],
                    'foto'=>$upload,
                    'tglInput'=>$tanggal,
                    'ket'=>$_POST['ket']);  
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $sql = "SELECT product .*, jenis FROM product 
            INNER JOIN jenis on product.jenisID = jenis.jenisID
            WHERE $where";
    $jalan = mysqli_query($con, $sql);
    $edit = mysqli_fetch_assoc($jalan);
}

if(isset($_POST['ubah'])){
    $foto = $_FILES['foto'];
    $upload = $go->upload($foto, $tempat);
    if(empty($_FILES['foto']['name'])){
        @$field = array('nama'=>$_POST['product'],
        'jenisID'=>$_POST['jenis'],
        'tglInput'=>$tanggal,
        'ket'=>$_POST['ket']);
        $go->ubah($con, $tabel, $field, $where, $redirect);
    } else {
        @$field = array('nama'=>$_POST['product'],
        'jenisID'=>$_POST['jenis'],
        'foto'=>$upload,
        'tglInput'=>$tanggal,
        'ket'=>$_POST['ket']);
        $go->ubah($con, $tabel, $field, $where, $redirect);
    }
    
}

?>

<h3 class="text-center mb-4">Product</h3>
<form action="" method="post" enctype="multipart/form-data">
    <table align="center" class="table table-borderless w-50">
        <tr>
            <td>Nama Product</td>
            <td>:</td>
            <td><input type="text" class="form-control" name="product" value="<?php echo @$edit['nama'] ?>" required></td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>:</td>
            <td><select name="jenis" class="form-select" required>
                    <option value="<?php echo $edit['jenisID']?>"><?php echo @$edit['jenis'] ?></option>
                    <?php
                    $jenis = $go->tampil($con, "jenis");
                    foreach($jenis as $r){
                    ?>
                    <option value="<?php echo $r['jenisID']?>"><?php echo $r['jenis'] ?></option>
                    <?php } ?>
                <select>
            </td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" class="form-control" name="foto"></td>
        </tr>   
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><textarea name="ket" class="form-control"><?php echo @$edit['ket'] ?></textarea></td>
        </tr>   
        <tr>
            <td></td>
            <td></td>
            <td>
            <?php if(@$_GET['id']==""){ ?>
                <input type="submit" class="btn btn-primary" name="simpan" value="SIMPAN">
            <?php } else{ ?>
                <input type="submit" class="btn btn-primary" name="ubah" value="UBAH">
            <?php } ?>
            </td>
        </tr>   
        
    </table>
</form>

<div class="container-sm py-5">
<table class="table table-bordered display" id="example">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Product</th>
            <th>Jenis</th>
            <th>Foto</th>
            <th>Tanggal INput</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 0;
            $sql = "SELECT product .*, jenis FROM product 
            INNER JOIN jenis on product.jenisID = jenis.jenisID";
            $jalan = mysqli_query($con, $sql);
            while($r = mysqli_fetch_assoc($jalan)) {;
            $no++

        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $r['nama'] ?></td>
            <td><?php echo $r['jenis'] ?></td>
            <td><img src="../foto/<?php echo $r['foto'] ?>" width="50" height="50"></td>
            <td><?php echo $r['tglInput'] ?></td>
            <td><?php echo $r['ket'] ?></td>
            <td><a class="btn btn-danger" href="?menu=product&hapus&id=<?php echo $r['productID']?>" onclick="return confirm('Hapus Data?')"><i class="fas fa-trash-alt me-2"></i>HAPUS</a>  
                <a class="btn btn-warning" href="?menu=product&edit&id=<?php echo $r['productID']?>"><i class="fas fa-edit me-2"></i>EDIT</a></td>
        </tr>
            <?php  } ?>
    </tbody>
</table>
</div>