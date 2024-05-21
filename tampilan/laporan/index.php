<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Laporan</h1>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <h3 class="center">TRANSAKSI PENJUALAN</h3>
  <div class="row">
    <form name="myform" action="sukses_penjualan.php" method="post">
      <div class="col s12">
        No. Transaksi :
        <div class="input-field inline">
          <input type="text" id="no_transaksi" name="no_transaksi" class="validate" value="" readonly />
        </div>
      </div>
      <div class="col s12">
        Tanggal :
        <div class="input-field inline">
          <input type="text" class="klik" id="datepicker" name="tanggal" autocomplete="off" readonly />
        </div>
      </div>
      <div class="col s12">
        Masukkan Nama Konsumen :
        <div class="input-field inline">
          <input type="text" id="nama" name="nama" class="validate" onkeyup="firstUpperF(this)" autocomplete="off" />
        </div>
      </div>
      <div class="col s12">
        Masukkan Alamat Konsumen :
        <div class="input-field inline">
          <input type="text" id="alamat" name="alamat" style="width:320px;" class="validate" onkeyup="firstUpperF(this)" autocomplete="off" />
        </div>
      </div>
      <div class="row"></div>
      <div class="col s12">
        Masukkan Penjualan :
      </div>
      <div class="row"></div>
      <div id="gruppenjualan">
        <div id="penjualan1">
          <div class="col s4">
            <center><label>No. Barang #1</label></center>
            <input type="text" name="no1" id="no1" class="center autocomplete" onkeyup="autofill(this), autohitung(), upperCaseF(this)" onblur="autofill(this), autohitung(), upperCaseF(this)" />
          </div>
          <div class="col s4">
            <center><label>Nama Barang</label></center>
            <input type="text" name="barang1" id="barang1" class="center validate" readonly />
          </div>
          <div class="col s4">
            <center><label for="jumlah1">Jumlah Barang</label></center>
            <input type="text" name="jumlah1" id="jumlah1" class="center validate" onkeyup="autohitung()" autocomplete="off" />
          </div>
          <div class="col s12">
            <input type="text" name="harga1" id="harga1" hidden/>
          </div>
          <div class="col s12">
            <input type="text" name="stok1" id="stok1" hidden />
          </div>
        </div>
        <input type="text" name="counter" id="counter" value=2 hidden />
      </div>
      <div class="col s12 m4 push-m2 l4 push-l2 center">
        <a class="waves-effect waves-light btn blue darken-1" id="tambah"><i class="material-icons left">add</i>Tambah</a>
      </div>
      <div class="col s12 m4 l4">&nbsp;</div>
      <div class="col s12 m4 pull-m2 l4 pull-l2 center">
        <a class="waves-effect waves-light btn blue darken-1" id="hapus"><i class="material-icons left">delete</i>Hapus</a>
      </div>
      <div class="row"></div>
      <div class="col s12">
        Pilih Kurir :
        <div class="inline">
          <input name="kurir" type="radio" id="kurir1" value="" checked />
          <label for="kurir1" style="color:black;">TIDAK ADA</label>
          <br />
          <input name="kurir" type="radio" id="kurir2" value="JNE REGULER" />
          <label for="kurir2" style="color:black;">JNE REGULER</label>
          <br />
          <input name="kurir" type="radio" id="kurir3" value="JNE YES" />
          <label for="kurir3" style="color:black;">JNE YES</label>
          <br />
          <input name="kurir" type="radio" id="kurir4" value="POS KILAT" />
          <label for="kurir4" style="color:black;">POS KILAT</label>
          <br />
          <input name="kurir" type="radio" id="kurir5" value="TIKI" />
          <label for="kurir5" style="color:black;">TIKI</label>
        </div>
      </div>
      <div class="col s12">
        Ongkos Kirim : Rp.
        <div class="input-field inline">
          <input type="text" id="ongkir" name="ongkir" class="validate" value=0 autocomplete="off" />
        </div>
      </div>
      <div class="col s12">
        Masukkan No. Resi :
        <div class="input-field inline">
          <input type="text" id="resi" name="resi" class="validate" onkeydown="upperCaseF(this)" autocomplete="off" />
        </div>
      </div>
      <div class="col s12">
        Total Harga : Rp.
        <div class="input-field inline">
          <input type="text" id="total" name="total" class="validate" value="0" readonly />
        </div>
      </div>
      <div class="row"></div>
      <div class="row"></div>
      <div class="col s12 m5 l5 center">
        <a class="waves-effect waves-light btn green accent-4" id="konfirmasi"><i class="material-icons left">done</i>Konfirmasi</a>
      </div>
      <div class="col s12 m2 l2">&nbsp;</div>
      <div class="col s12 m5 l5 center">
        <a class="waves-effect waves-light btn red" id="gajadi"><i class="material-icons left">cancel</i>Kembali</a>
      </div>
      <div class="row"></div>
      <div class="row"></div>
      <div class="row"><strong>Pastikan data yang diinput sudah benar.</strong></div>
    </form>
  </div>
</div>

<script>
    var counter = parseInt(myform.counter.value); //Variabel untuk dynamic input box
var stok;

function upperCaseF(a) { //Fungsi untuk membuat input kapital secara otomatis
  setTimeout(function() {
    a.value = a.value.toUpperCase();
  }, 1);
}

function firstUpperF(a) { //Fungsi untuk membuat huruf pertama menjadi kapital
  setTimeout(function() {
    a.value = a.value.charAt(0).toUpperCase() + a.value.slice(1);
  }, 1);
}

$(".klik").keypress(function(event) { //Fungsi untuk mencegah user menekan keyboard pada Tanggal
    return false;
});

$(function() { //Fungsi tanggal
  $("#datepicker").datepicker({
    dateFormat: "dd MM yy",
    showButtonPanel: true
  });
});

$(function() { //Fungsi untuk mengambil daftar barang dari database
  $("#no1").autocomplete({ //dan mempopulasikannya di input kode barang secara otomatis
    source: 'search_barang_penjualan.php'
  });
});

function autofill(x) { //Fungsi untuk mengisi input nama barang secara otomatis berdasarkan input kode barang
  var angka = x.id.substr(2); //Mengambil nomor terakhir dari id input kode barang yang sedang aktif
  var no = $("#no" + angka).val();
  if ($("#jumlah" + angka).val().length == 0) {
    $("#jumlah" + angka).val(1); //Mengisi input jumlah secara otomatis
  }
  $.ajax({
    url: 'ajax_barang.php',
    dataType: "html",
    data: "no=" + no,
  }).success(function(data) {
    var untung;
    var json = data,
      obj = JSON.parse(json);
    if (obj.harga == null) { //Karena menggunakan fungsi onkeyup,
      obj.harga = 0; //maka selama input belum sesuai dengan isi tabel daftar barang, return value berupa nilai null
    }
    $('#barang' + angka).val(obj.nama_barang);
    if (obj.harga > 300000) untung = 30000; else untung = obj.harga * 0.1;
    $('#harga' + angka).val(obj.harga + untung);
    $('#stok' + angka).val(obj.stok);
  });
}

function autohitung() { //Fungsi untuk mengisi input total secara otomatis
  var total = 0;
  for (var n = 1; n < counter; n++) {
    if (($('#harga' + n).val() == 0) || ($('#harga' + n).val() == undefined)) { //Jika Kode Barang tidak terisi / tersedia di database
      break;
    } else {
      total = total + (parseInt($('#harga' + n).val()) * parseInt($('#jumlah' + n).val()));
      $('#total').val(total.toLocaleString('id-ID')); //Membuat format uang indonesia
    }
  }
}

$(document).ready(function() {
  $("#tambah").click(function() {
      if (counter > 10) {
        swal("BARANG TERLALU BANYAK!", "Hanya dapat menjual 10 barang!", "error");
        return false;
      }
      var newPenjualan = $(document.createElement('div'))
          .attr("id", 'penjualan' + counter);
      newPenjualan.after().html('<div class="row"></div>' + //Menambahkan input group ke div yang baru dibuat barusan
        '<div class="col s4">' +
          '<center>' +
            '<label>No. Barang #' + counter + '</label>' +
            '</center>' +
            '<input type="text" name="no' + counter + '" id="no' + counter + '" class="center autocomplete" onkeyup="autofill(this), autohitung(), upperCaseF(this)" />' +
        '</div>' +
        '<div class="col s4">' +
          '<center>' +
            '<label>Nama Barang</label>' +
          '</center>' +
          '<input type="text" name="barang' + counter + '" id="barang' + counter + '" class="center validate" readonly />' +
        '</div>' +
        '<div class="col s4">' +
          '<center>' +
            '<label>Jumlah Barang</label>' +
          '</center>' +
          '<input type="text" name="jumlah' + counter + '" id="jumlah' + counter + '" class="center validate" onkeyup="autohitung()" autocomplete="off" />' +
        '</div>' +
        '<div class="col s12">' +
          '<input type="text" name="harga' + counter + '" id="harga' + counter + '" class="center validate" hidden />' +
        '</div>' +
        '<div class="col s12">' +
          '<input type="text" name="stok' + counter + '" id="stok' + counter + '" hidden />' +
        '</div>');
      newPenjualan.appendTo("#gruppenjualan"); //Menggabungkan div tadi ke dalam input group yang sudah ada
      $("#no" + counter).autocomplete({ //Sama seperti fungsi di baris 17
        source: 'search_barang_penjualan.php'
      });
      counter++;
  });

  $("#hapus").click(function() {
    if (counter == 2) { //Mengecek apakah user menghapus satu-satunya input group barang
      swal("Error", "Minimal menjual 1 barang!", "error");
      return false;
    }
    counter--;
    $("#penjualan" + counter).remove(); //Menghapus dynamic textbox terakhir
    autohitung();
  });

  $("#gajadi").click(function() {
    //Mengecek apakah ada data barang yang diisi
    var kosong = true;
    for (var y = 1; y < counter; y++) {
      if ($("#harga" + y).val() != 0) {
        kosong = false;
      }
    }

    if ((myform.tanggal.value != "") || (myform.nama.value != "") || (myform.alamat.value != "")
    || ((myform.kurir2.checked != false) || (myform.kurir3.checked != false) || (myform.kurir4.checked != false) || (myform.kurir5.checked != false))
    || (myform.ongkir.value != 0) || (myform.resi.value != "") || (kosong == false)) {
      swal({
        title: "Anda yakin?",
        text: "Semua data yang telah dimasukkan akan hilang!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, saya yakin!",
        cancelButtonText: "Batal",
        closeOnConfirm: false
      }, function(isConfirm) {
        if (isConfirm) {
          window.location = 'index.php';
        }
      });
    } else window.location = 'index.php';
  });

  $("#konfirmasi").click(function() {
    //Mengecek apakah ada barang yang sama atau tidak
    var sama = false;
    var e, r; //Variabel untuk menampung No. Barang yang sama
    var q, w;
    for (q = 1; q < counter; q++) {
      for (w = 1; w < counter; w++) {
        if (q == w) break;
        if ($("#no" + q).val() == $("#no" + w).val()) {
          sama = true;
          e = q;
          r = w;
        }
      }
    }

    for (var x = 1; x < counter; x++) {
      if ((myform.tanggal.value == "") || (myform.nama.value == "")) {
        swal({
          title: "Error!",
          text: "Harap mengisi data Tanggal, Nama Konsumen, dan Barang!",
          type: "error"
        });
        break;
      } else if (((myform.kurir2.checked == true) || (myform.kurir3.checked == true) || (myform.kurir4.checked == true) || (myform.kurir5.checked == true))
      && ((myform.alamat.value == "") || (myform.ongkir.value == 0) || (myform.resi.value == ""))) {
      swal({
        title: "Error!",
        text: "Harap mengisi Alamat, Ongkos Kirim, dan No. Resi jika menggunakan Kurir!",
        type: "error"
      });
      break;
      } else if ((myform.kurir1.checked == true) && ((myform.ongkir.value != 0) || (myform.resi.value != ""))) {
        swal({
          title: "Error!",
          text: "Harap gunakan kurir jika mengisi Ongkos Kirim dan No. Resi!",
          type: "error"
        });
      break;
    } else if ($('#harga' + x).val() == "") {
        swal({
          title: "BARANG TIDAK ADA DI DATABASE!",
          text: "Pastikan Barang #" + x + " terisi atau tersedia di database!",
          type: "error"
        });
        break;
      } else if (sama == true) {
        swal({
          title: "BARANG DUPLIKAT!",
          text: "Pastikan Barang No. #" + r + " dan Barang No. #" + e + " tidak sama!",
          type: "error"
        });
        break;
      } else if (parseInt($('#jumlah' + x).val()) > parseInt($('#stok' + x).val())) {
        swal({
          title: "Error!",
          text: "Barang #" + x +" hanya tersedia " + $('#stok' + x).val() + " unit di gudang!",
          type: "error"
        });
        break;
      } else {
        autohitung();
        swal({
          title: "Anda yakin?",
          text: "Semua data akan dimasukkan ke database!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, saya yakin!",
          cancelButtonText: "Batal",
          closeOnConfirm: false
        }, function(isConfirm) {
          if (isConfirm) {
            $("#counter").val(counter);
            document.forms["myform"].submit();
          }
        });
      }
    }
  });
});

</script>