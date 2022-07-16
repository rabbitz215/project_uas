

$('#btnsubmit').click(function () {
    let stock = $('#stock').val();
    if (stock < 1) {
        alert('Stock tidak boleh 0');
    } else {
        $('#modalsubmit').modal("show");
    }
})

$('#btnya').click(function () {
    $('#formkomik').attr("action", "?modul=mod_komik&action=save");
    $('#formkomik').submit();
})

$(document).ready(function () {
    $(".dropdown-toggle").dropdown();
});

$("#txtsimpan").click(function () {
    let ckmenu = $("input[type='checkbox']:checked");
    if (ckmenu.length == "") {
        alert("Centang pilihan menu terlebih dahulu");
    } else {
        $("#konfirmasi1").modal("show");
    }
});

if (document.getElementById("formuserlogin")) {
    $("#btnsubmit").click(function () {
        let user = $("#user").val();
        let nama = $("#nama").val();
        let pass = $("#pass").val();
        let passkonfirm = $("#passkonfirm").val();
        let active = $("input[type='radio']:checked");
        if (user == "" || nama == null) {
            alert("username Wajib diisi!!");
        } else if (nama == "" || nama == null) {
            alert("nama lengkap wajib diisi");
        } else if (pass == "" || pass == null) {
            alert("password wajib diisi!");
        } else if (passkonfirm == "" || passkonfirm == null) {
            alert("silahkan konfirmasi password anda");
        } else if (pass != passkonfirm) {
            alert("password yang anda inputkan tidak sama!");
        } else if (active.length == "") {
            alert("silahkahn pilih keaktifan");
        } else {
            $("#btnkonfirm").modal("show");
        }
    });

    $("#btnsimpan").click(function () {
        $("#formuserlogin").attr("action", "?modul=mod_userlogin&action=save");
        $("#formuserlogin").submit();
    });
};

if (document.getElementById("formdaftar")) {
    $("#btndaftar").click(function () {
        let nama = $("#txtnama").val();
        let email = $("#txtemail").val();
        let password = $("#txtpass").val();
        let passwordkonfirm = $("#txtpasscon").val();
        let tgllhr = $("#tgllhr").val();
        let notelp = $("#notelp").val();
        let alamat = $("#alamat").val();
        let jk = $("#jk").val();
        let foto = $("#foto").val();
          if (nama == ""||nama==null) {
            alert("nama Wajib diisi!!");
          }else if(email==""||email==null){
            alert("email wajib diisi");
          }else if(password==""||password==null){
            alert("password wajib diisi!");
          }else if(passwordkonfirm==""||passwordkonfirm==null){
            alert("silahkan konfirasi password anda!");
          }else if(password!=passwordkonfirm){
            alert("password yang anda masukkan tidak sama");
          }else if (tgllhr==""||tgllhr==null){
            alert("silahkan masukkan tanggal lahir anda !!");
          }else if(notelp==""||notelp==null){
            alert("silahkan masukkan no telp anda");
          }else if(alamat==""||alamat==null){
            alert("silahkan masukkan alamat anda");
          }else if(jk==""||jk==null){
            alert("silahkan pilih jenis kelamin anda");
          }else if(foto==""||foto==null){
            alert("silahkan upload foto");
          }else{
            $("#konfirmasi").modal("show");
          }
      });

      $("#btnsimpan").click(function () {
        $("#formdaftar").attr("action", "memberCtrl.php");
        $("#formdaftar").submit();
        $(location).attr("href","?page=daftarmember");
      });
};

if (document.getElementById("formorder")) {
  $("#kodekomik").change(function () {
    let kodekomik = $(this).val();
    let namabarang = $(this).find(":selected").data("namabrg");
    let hargabarang = $(this).find(":selected").data("hargabrg");
    $("#nm_barang").val(namabarang);
    $("#harga").val(hargabarang);
  });

  $("#btn_order").prop('disabled', true);

  $("#btn_addbarang").click(function () {
    let kodekomik = $("#kodekomik").val();
    let nmbarang = $("#nm_barang").val();
    let harga = $("#harga").val();
    let qty = $("#jml").val();
    let tanggal = $("#tgl_trans").val();
    let subtotal = 0;
    let total = $("#total").val();
    let stockbarang = $("#kodekomik").find(":selected").data("stock");
    // console.log(total);
    if (kodekomik == "") {
      alert("Barang belum dipilih!!");
    } else if (qty == "" || qty == 0) {
      alert("Jumlah belum diinput!!");
    } else if (tanggal == "") {
      alert("Tanggal belum diinput!!");
    } else if (qty > stockbarang) {
      alert("Stock tidak mencukupi");
    } else {
      subtotal = Number(harga) * Number(qty);
      let listrows = "<tr>";
      listrows += "<td>" + nmbarang + " <input type='hidden' name='row_kodekomik[]' value='" + kodekomik + "'></td>";
      listrows += "<td>" + harga + "<input type='hidden' name='row_harga[]' value='" + harga + "'></td>";
      listrows += "<td>" + qty + "<input type='hidden' name='row_qty[]' value='" + qty + "'></td>";
      listrows += "<td>" + subtotal + "<input type='hidden' name='row_subtotal[]' value='" + subtotal + "'></td>";
      listrows += "</tr>";
      $("#listbarang").append(listrows);
      total = Number(total) + Number(subtotal);

      $("#viewtotalharga").text(total);
      $("#total").val(total);

      $("#btn_order").prop('disabled', false);
    }
  });
  $("#btn_order").click(function () {
    //buat validasi form inputan yang wajib diisi
    $("#konfirmasiorder").modal("show");
  });
  $("#btn_saveorder").click(function () {
    $("#formorder").attr("action", "?page=order&action=ordersave");
    $("#formorder").submit();
    //$(location).attr("href", "?page=order");
  });
}

if (document.getElementById("formorderadmin")) {
  $("#kodekomik").change(function () {
    let kodekomik = $(this).val();
    let namabarang = $(this).find(":selected").data("namabrg");
    let hargabarang = $(this).find(":selected").data("hargabrg");
    $("#nm_barang").val(namabarang);
    $("#harga").val(hargabarang);
  });

  $("#btn_orderadmin").prop('disabled', true);

  $("#btn_addbarang").click(function () {
    let kodekomik = $("#kodekomik").val();
    let nmbarang = $("#nm_barang").val();
    let harga = $("#harga").val();
    let qty = $("#jml").val();
    let subtotal = 0;
    let total = $("#total").val();
    let stockbarang = $("#kodekomik").find(":selected").data("stock");
    // console.log(total);
    if (kodekomik == "") {
      alert("Barang belum dipilih!!");
    } else if (qty == "" || qty == 0) {
      alert("Jumlah belum diinput!!");
    } else if (qty > stockbarang) {
      alert("Stock tidak mencukupi");
    } else {
      subtotal = Number(harga) * Number(qty);
      let listrows = "<tr>";
      listrows += "<td>" + nmbarang + " <input type='hidden' name='row_kodekomik[]' value='" + kodekomik + "'></td>";
      listrows += "<td>" + harga + "<input type='hidden' name='row_harga[]' value='" + harga + "'></td>";
      listrows += "<td>" + qty + "<input type='hidden' name='row_qty[]' value='" + qty + "'></td>";
      listrows += "<td>" + subtotal + "<input type='hidden' name='row_subtotal[]' value='" + subtotal + "'></td>";
      listrows += "</tr>";
      $("#listbarang").append(listrows);
      total1 = Number(total) + Number(subtotal);
      
      $("#total").val(total1);
      $("#viewtotalbayar").text(total1);
      $("#hargalama").text("", total1);

      $("#btn_orderadmin").prop('disabled', false);
    }
  });
  $("#btn_orderadmin").click(function () {
    //buat validasi form inputan yang wajib diisi
    $("#konfirmasiorder").modal("show");
  });
  $("#btn_saveorderadmin").click(function () {
    $("#formorderadmin").attr("action", "?modul=mod_penjualan&action=ordersave");
    $("#formorderadmin").submit();
    //$(location).attr("href", "?page=order");
  });
}

if(document.getElementById("formlupapass")){
  $("#konfirm").click(function () {
    let user = $("#username").val();
    let pass_baru = $("#password").val();
    let konfirmpassbaru = $("#konfirmpassword").val();
    if (user == "" || user == null) {
      alert("Username wajib diisi");
    } else if (pass_baru == "" || pass_baru == null) {
      alert("Password baru wajib diisi");
    } else if (konfirmpassbaru == "" || konfirmpassbaru == null) {
      alert("Konfirmasi Password baru wajib diisi");
    } else {
      $("#konfirmasi").modal("show");
    }
  });

  $("#konfirmpassword").keyup(function (){
    let pass_baru = $("#password").val();
    let konfirmpassbaru = $("#konfirmpassword").val();
    if(pass_baru !== konfirmpassbaru){
      $("#txtkonfirm").text("Password Tidak Sama !!!");
    }else{
      $("#txtkonfirm").text("");
    }
  })
}