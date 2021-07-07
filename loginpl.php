
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-4 ml-auto">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Login Pelanggan</h3>
					</div>
					<div class="card-body">
						<form method="post">
							<p>Silahkan Masukan E-mail & Password</p>
							<div class="form-group">
								<label>E-mail</label>
								<input type="text" name="emailpl" class="form-control" placeholder="E-mail" required="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="passwordpl" class="form-control" placeholder="Password" required="">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-xs" name="loginpl">Login</button>
							</div>
						</form>
								<!-- <a href="?page=daftarpl"><button class="btn btn-secondary btn-xs" name="daftar">Daftar Pelanggan</button></a> -->
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php 
//jika ada tombol loginpl(tombol login ditekan)
	if (isset($_POST['loginpl'])) {
		
		$email = $_POST['emailpl'];
		$password = $_POST['passwordpl'];
	//lakukan query untuk mengecek akun ditabel pelanggan di db
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'");
	//ngitung akun yang terambil
		$akunyangcocok = $ambil->num_rows;

	//jika ada 1 akun yang cocok maka diloginkan
		if ($akunyangcocok==1) 
		{
		//anda sudah login
		//mendapatkan akun dalam bentuk array
			$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
			$_SESSION['pelanggan'] = $akun;

			echo "<script>alert('anda sukses login');</script>";
			echo "<script>window.location.href='?page=halutama';</script>";
		}
		else
		{
		//anda gagal login
			echo "<script>alert('anda gagal login, periksa akun Anda');</script>";
			echo "<script>window.location.href='?page=loginpl';</script>";

		}
	}
	?>