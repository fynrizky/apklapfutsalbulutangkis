<?php 
include_once "../config/koneksi.php";


if(isset($_POST['daftar']))
{
    if(register($_POST) > 0)
    {
        echo "<script>alert('username baru berhasil ditambahkan');
        document.location.href = 'loginadmin.php'; </script>";
    }else{
        echo "<script>alert('harap coba lagi..');
        document.location.href = 'loginadmin.php'; </script>";
    }
}

function register($data){
    global $koneksi;

    $nama_user = strtolower(stripcslashes($data["nama_user"]));
    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
    $level = strtolower(stripcslashes($data['level']));

    // cek username sudah ada atau belum
    $res = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($res)){
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;//berhentikan fungsinya sampai disini
    }
    //cek konfirmasi password
    if($password !== $password2){
        echo "<script>
			alert('Password Tidak Cocok !');
			</script>"; //password tidak sesuai
		return false;//berhentikan fungsinya sampai disini
    }

    //enkripsi/amankan password cara1
	$password = password_hash($password, PASSWORD_DEFAULT);
	//enskripsi/amankan password cara2
	//$password = md5($password);
    //var_dump($password); die;
    mysqli_query($koneksi, "INSERT INTO users VALUES('','$nama_user','$username','$password','$level')");

	return mysqli_affected_rows($koneksi);
}

?>