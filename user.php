<?php
include "config/koneksi.php";
include "library/controller.php";

$go = new controller();
$tabel = "login";
//enskipsi password
@$password = base64_encode($_POST['pass']);
@$field = array('username'=>$_POST['user'], 'password'=>$password);
$redirect = "?menu=user";
@$where = "id = $_GET[id]";

if(isset($_POST['simpan'])){
    $go->simpan($con, $tabel, $field, $redirect);
}
if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['ubah'])){
    $go->ubah($con, $tabel, $field, $where, $redirect);
}


?>
<h3 class="text-center mb-4">User</h3>
<form action="" method="post">
    <table align="center" class="table table-borderless w-50">
        <tr>
            <td>User</td>
            <td>:</td>
            <td><input type="text" class="form-control" name="user" value="<?php echo @$edit['username'] ?>" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" class="form-control"  name="pass" value="<?php echo base64_decode(@$edit['password']) ?>" required></td>
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

<div class="container-sm mt-5">
<table class="table table-bordered display" id="example">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th class="col-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $data = $go->tampil($con, $tabel);
            $no = 0;

            if($data==""){
                echo "<tr><td colspan='4'>No Record</td></tr>";
            } else {

            foreach($data as $r){
                $no++
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $r['username'] ?></td>
            <td><?php echo base64_decode($r['password']) ?></td>
            <td><a class="btn btn-danger" href="?menu=user&hapus&id=<?php echo $r['id']?>" onclick="return confirm('Hapus Data?')"><i class="fas fa-trash-alt me-2"></i>HAPUS</a>  
            <a class="btn btn-warning" href="?menu=user&edit&id=<?php echo $r['id']?>"><i class="fas fa-edit me-2"></i>EDIT</a></td>
        </tr>
            <?php } } ?>
    </tbody>
</table>
</div>

