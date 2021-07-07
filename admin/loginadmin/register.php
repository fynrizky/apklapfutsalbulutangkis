<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="../../assets/js/jquery-1.10.2.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="js/style.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Enter the email you signed up with</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                   Daftar</p>
                <form class="login" action="prosesregister.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nama_user" autocomplete="off" class="form-control" placeholder="Masukan Nama User" required="" />
                <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username" required="" />
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                <input type="password" name="password2" class="form-control" placeholder="Password Confirm" required="" />
                <select name="level" id="level" class="form-control" required="" >
                    <option value="1" selected >Admin</option>
                    <option value="2">Pimpinan</option>
                </select>
                <input type="submit" value="Sign Up" name="daftar" class="btn btn-success btn-sm" />
                <!-- <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot-pass-content">
                            <a href="javascript:void(0)" class="forgot-pass">Forgot Password</a>
                        </div>
                    </div>
                </div> -->
                <div class="row">

                    <div class="col-md-6 forgot-pass-content">
                        <a href="loginadmin.php">Back</a>
                    </div>
            </div>
            </form>
            </div>
        </div>
    </div>
    <div class="posted-by">Posted By: <a href="#">Fiyannur</a></div>
</div>

