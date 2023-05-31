// Tambah dan hapus form no rumah
var no_rumah = '<input id="no_rumah" type="text" name="no_rumah[]" autocomplete="off" required="required" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2" placeholder="A01">'
function tambahNorumah() {
    var newContent = document.createElement('div');
    newContent.innerHTML = no_rumah;
    document.getElementById('no_rumah').appendChild(newContent);
}
function hapusNorumah() {
    document.getElementById('no_rumah').lastChild.remove()
}


// Tambah dan hapus form harga
var form_harga = '<div class="grid grid-cols-4 gap-6 mt-5 border-t border-primary py-5"><label><span class="font-bold">Harga</span><input id="harga" name="harga[]" type="text" autocomplete="off" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="Masukkan hanya angka"></label><label><span class="font-bold">Harga Pemesanan</span><input id="harga_pemesanan" name="harga_pemesanan[]" type="text" autocomplete="off" class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="Masukkan hanya angka"></label><label><span class="font-bold">Harga DP</span><input id="dp" type="text" name="harga_dp[]" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label><label><span class="font-bold">Harga per Bulan</span><input id="harga_bulanan" name="harga_bulanan[]" type="text" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label><label><span class="font-bold">Lama Bayar</span><input id="lama_bayar" name="lama_bayar[]" type="text" autocomplete="off"class="mt-2 w-full bg-slate-200 rounded-sm p-2 placeholder:text-sm text-black placeholder:text-slate-400 focus:outline-none focus:border-slate-600 focus:ring-slate-600 block focus:ring-2"placeholder="masukkan hanya angka"></label></div>';
function tambahHarga() {
    var newContent = document.createElement('div');
    newContent.innerHTML = form_harga;
    document.getElementById('form_harga').appendChild(newContent);
}
function hapusHarga() {
    document.getElementById('form_harga').lastChild.remove()
}

// function agar tidak resubmission ketika refresh browser
if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}

// Show hide No Rumah
let addNewFormNoRumah = document.getElementById("form_add_norumah");
function addNoRumah() {
    addNewFormNoRumah.classList.toggle("!block");
}


// show hide Harga Rumah
let addNewFormHarga = document.getElementById("form_tambah_harga_rumah");
function addHarga() {
    addNewFormHarga.classList.toggle("!block");
}

// show hide Gambar
let addNewPicture = document.getElementById("form_add_picture");
function addPicture() {
    addNewPicture.classList.toggle("!block");
}

function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}

