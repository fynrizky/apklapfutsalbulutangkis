<!-- Carousel/jumbotron -->
<section>
<!-- <div class="container mt-4">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" src="..." alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div> -->

<div class="container mt-4">
<!-- jumbotron -->
<!-- <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div> -->
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  <?php 
  
  $qry = $koneksi->query("SELECT COUNT(*) FROM lapangan"); //hitung semua lapangan
  $data = $qry->fetch_array();
  // perbedaan fetch_array fetch_row fetch_assoc dan fetch_object
  // fetch_array = menghasilkan array berupa numeric dan associative array(berbentuk sebuah nama)
  // fetch_row = menghasilkan array numeric saja
  // fetch_assoc = menghasilkan array associative saja
  // fetch_object = menghasilkan array berbentuk associative object

  $count = $data[0];//mulai dari index field ke 0
  
  for($i=1; $i < $count; $i++){
  // for($i=0; $i < $count; $i++){
      echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" ';if($i==1){ echo 'class="active"'; } echo '></li>';
    
  }
  ?>
   
  </ol>
  <div class="carousel-inner">
  <?php 
    $sql = $koneksi->query("SELECT * FROM lapangan ORDER BY id_lapangan DESC LIMIT 3");
    while($data = $sql->fetch_object()){
    echo '
      <div class="carousel-item '; if($data->id_lapangan == 4){ echo 'active'; } echo '">
          <img class="cgbr" src="assets/img/'.$data->gambar.'"/>
      </div>

    '; 
    }
  
  ?>
    
    <!-- <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
</section>

<section>
<div class="container mt-4">
    <h3 style="color: white;"><strong>Daftar Lapangan</strong></h3>
</div>
<?php
$qry = $koneksi->query("SELECT * FROM lapangan ORDER BY id_lapangan");

?>
<div class="container">
    <div class="row">
<?php 
  while($data = $qry->fetch_object()){
?>
        <div class="col-md-3">
          <div class="card text-white bg-dark mb-4 mt-4 card-lapangan" style="max-width: 18rem;">
            <div class="card-header">Daftar Lapangan</div>
            <img class="card-img-top" src="assets/img/<?= $data->gambar; ?>" alt="Card image cap" height="120px">
            <div class="card-body">
              <a href="?page=pesanlapangan&id=<?= $data->id_lapangan; ?>" class="card-link">
              <h5 class="card-title namalapangan">
              <?= $data->nama_lapangan; ?>
              </h5>
              <?php if(!@$_SESSION['pelanggan']){ ?>
              <?php true; ?>
              <?php }else{ ?>
              <h6 class="card-subtitle mb-2 text-muted">Rp. <?= number_format($data->harga_sewa); ?>,-/Jam</h6>
              <?php } ?>
              </a>
              <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
            </div>
          </div>
        </div>
  <?php } ?>
    </div>
</div>
</section>