<?php 

class controller{

    //fungsi login

    function login($con, $tabel, $username, $password, $redirect){
        $sql = "SELECT * FROM $tabel WHERE username ='$username' and password='$password '";
        $jalan = mysqli_query($con,$sql);

        $cek = mysqli_num_rows($jalan);

        if($cek > 0){
            echo "<script>alert('Selamat Datang $username');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Username atau Password Salah!');document.location.href='login.php'</script>";
        }
    }

    //fungsi simpan 
    function simpan($con, $tabel, array $field, $redirect){
        $sql = "INSERT INTO $tabel SET ";
        //$sql-> insert into login set

        foreach($field as $key => $value){
            $sql.= " $key = '$value',";
        }
        //$sql-> insert into set username = '$_POST[username]', password = '$_POST[password]',

        $sql = rtrim($sql, ',');
        //$sql-> insert into set username = '$_POST[username]', password = '$_POST[password]',

        $jalan = mysqli_query($con, $sql);
        if($jalan){
            echo "<script>alert('Berhasil disimpan');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal tersimpan');document.location.href='$redirect'</script>";
        }
    }

    //fungsi tampil
    function tampil ($con, $tabel) {
        $sql ="SELECT * FROM $tabel";
        $jalan = mysqli_query($con,$sql);
        while($data = mysqli_fetch_assoc($jalan)) 
            $isi[] = $data;
            return @$isi;  
        
    }

    //fungsi hapus
    function hapus ($con, $tabel, $where, $redirect){
        $sql ="DELETE FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        if ($jalan){
            echo "<script>alert('Berhasil dihapus');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal dihapus');document.location.href='$redirect'</script>";
        }
    }

    //fungsi edit
    function edit ($con, $tabel,  $where) {
        $sql = "SELECT * FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        $tampung = mysqli_fetch_assoc($jalan) ;
        return $tampung;
     }
     
    //fungsi ubah
     function ubah($con, $tabel, array $field, $where, $redirect){
        $sql = "UPDATE $tabel SET ";
        foreach($field as $key => $value){
            $sql.=" $key = '$value',";
        }
        $sql = rtrim($sql, ',');
        $sql.="WHERE $where";

        //$sql-> UPDATE login SET username='budi', password='123' WHERE id=1;

        $jalan = mysqli_query($con, $sql);

        if($jalan){
            echo "<script>alert('Berhasil diubah');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal diubah');document.location.href='$redirect'</script>";
        }
    }

    //fungsi upload foto
    function upload($foto, $tempat){
        $alamat = $foto['tmp_name'];
        $namafile = $foto['name'];
        move_uploaded_file($alamat, "$tempat/$namafile");
        return $namafile;

    }



}



?>