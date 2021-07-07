/* Ubah Users */
$(document).on("click", "#ubahdatausers", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    var idusers = $(this).data('idusers'); //data dari tombol edit barang yang data-id
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   
    var namausers = $(this).data('namausers'); //data dari tombol edit barang yang data-nama

    $("#modal-edit #idusers").val(idusers); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #namausers").val(namausers);
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputusers").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahusers.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});


/* Ubah Pelanggan */
$(document).on("click", "#ubahdatapl", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    var idpl = $(this).data('idpl'); //data dari tombol edit barang yang data-id
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   
    var emailpl = $(this).data('emailpl'); //data dari tombol edit barang yang data-nama
    var namapl = $(this).data('namapl'); //data dari tombol edit barang yang data-nama
    var notelppl = $(this).data('notelppl'); //data dari tombol edit barang yang data-nama

    $("#modal-edit #idpl").val(idpl); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #emailpl").val(emailpl);
    $("#modal-edit #namapl").val(namapl);
    $("#modal-edit #notelppl").val(notelppl);
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputpelanggan").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahpelanggan.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});





// Ubah Lapangan
$(document).on("click", "#ubahdatalapangan", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    var idlapangan = $(this).data('idlapangan'); //data dari tombol edit barang yang data-id
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   
    var namalapangan = $(this).data('namalapangan'); //data dari tombol edit barang yang data-nama
    var hargasewa = $(this).data('hargasewa'); //data dari tombol edit barang yang data-nama
    var gambar = $(this).data('gbr'); //data dari tombol edit barang yang data-nama

    $("#modal-edit #idlapangan").val(idlapangan); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #namalapangan").val(namalapangan);
    $("#modal-edit #hargasewa").val(hargasewa);
    $("#modal-edit #pict").attr("src", "../assets/img/"+gambar);
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputlapangan").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahlapangan.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});


// Ubah Jadwal Sewa
$(document).on("click", "#ubahdatajadwalsewa", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    var idjadwalsewa = $(this).data('idjadwalsewa'); //data dari tombol edit barang yang data-id
    var jamsewa = $(this).data('jamsewa'); //data dari tombol edit barang yang data-id
    
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   

    $("#modal-edit #idjadwalsewa").val(idjadwalsewa); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #jamsewa").val(jamsewa); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputjadwalsewa").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahjadwalsewa.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});

// Ubah Transaksi
$(document).on("click", "#ubahdatatransaksi", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    // var idpenyewaan = $(this).data('idpenyewaan'); //data dari tombol edit barang yang data-id
    var idpelanggan = $(this).data('idpelanggan'); //data dari tombol edit barang yang data-id
    var tgl = $(this).data('tgl'); //data dari tombol edit barang yang data-id
    var status = $(this).data('status'); //data dari tombol edit barang yang data-id
    // var btsdp = $(this).data('btsdp'); //data dari tombol edit barang yang data-id
    
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   

    // $("#modal-edit #idtransaksi").val(idpenyewaan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #idpelanggan").val(idpelanggan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #tgl").val(tgl); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #status").val(status); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #batasdp").val(btsdp); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputtransaksi").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahtransaksi.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});

// Ubah Perubahan Jadwal
$(document).on("click", "#ubahdataperubahanjadwal", function () { // javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
    // var idpenyewaan = $(this).data('idpenyewaan'); //data dari tombol edit barang yang data-id
    var idperubahan = $(this).data('idperubahan'); //data dari tombol edit barang yang data-id
    var pelanggan = $(this).data('pelanggan'); //data dari tombol edit barang yang data-id
    var lapangan = $(this).data('lapangan'); //data dari tombol edit barang yang data-id
    var jamberubah = $(this).data('jamberubah'); //data dari tombol edit barang yang data-id
    
    // var kdbrg = $(this).data('kdbrg'); //data dari tombol edit barang yang data-id
   

    // $("#modal-edit #idtransaksi").val(idpenyewaan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #idperubahan").val(idperubahan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #pl").val(pelanggan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #lapangan").val(lapangan); //#modal-edit/id modal edit diambil dari div modal-body
    $("#modal-edit #jamberubah").val(jamberubah); //#modal-edit/id modal edit diambil dari div modal-body
    // $("#modal-edit #kode_barang").val(kdbrg); //#modal-edit/id modal edit diambil dari div modal-body
 

});


$(document).ready(function (e) { //javascript siap jalankan
    $("#forminputperubahanjadwal").on("submit", (function (e) { //javascript carikan id form yang ketika disubmit jalankan sebagai berikut
        e.preventDefault();
        $.ajax({
            url: 'views/modalproses/modalprosesubahperubahanjadwal.php',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (msg) { //kalau sukses tampilkan sebagai berikut
                $('.table').html(msg); //javascript carikan yang classnya table dihtml
            }
        });
    }));
});