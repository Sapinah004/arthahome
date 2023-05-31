<?php
    include("../core/config.php");
    require($_SERVER['DOCUMENT_ROOT'] . '/ArthaHome/Admin/assets/library/fpdf.php');
    // require("../assets/library/fpdf.php");

    class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../assets/images/logo.png',10,8,30);
    
    $this->SetFont('Times','B',12);
    
    // Geser Ke Kanan 35mm
    $this->Cell(35);
    
    // Judul
    $this->Cell(40,5,'Laporan Penjualan Rumah Artha Home',0,1,'L');
    $this->Ln(5);
    // Garis Bawah Double
    $this->Cell(190,1,'','B',1,'L');
    $this->Cell(190,1,'','B',0,'L');
    
    // Line break 5mm
    $this->Ln(5);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Membuat file PDF
$pdf = new PDF();
//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf -> SetFont('Times', 'B', 13);
    $pdf-> Cell(200,10,'DATA PEMBELIAN',0,0,'C');

    $pdf->Cell(10,15,'',0,1);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10,7,'No',1,0,'C');
    $pdf->Cell(20,7,'Tanggal', 1,0,'C');
    $pdf->Cell(40,7,'Pembeli',1,0,'C');
    $pdf->Cell(30,7,'Tipe Rumah',1,0,'C');
    $pdf->Cell(35,7,'Lokasi', 1,0,'C');
    $pdf->Cell(20,7,'No Rumah',1,0,'C');
    $pdf->Cell(35,7,'Harga',1,0,'C');

    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Times','',10);
    $no=1;
    if(isset($_GET['unduh_laporan_bulanan'])){
        $data = mysqli_query($connect,"SELECT tb_user.username, tb_pesanan.id_order, tb_pesanan.telephone, tb_pesanan.tipe, tb_pesanan.tanggal, tb_rumah.lokasi, tb_pesanan.no_rumah, tb_harga_rumah.harga FROM tb_pesanan JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE status_pembelian = 1 AND DATE_FORMAT(tb_pesanan.tanggal, '%Y%m') = '".$_GET['unduh_laporan_bulanan']."' ORDER BY tb_pesanan.tanggal DESC");
    }
    elseif(isset($_GET['unduh_laporan_tahunan'])){
        $data = mysqli_query($connect,"SELECT tb_user.username, tb_pesanan.id_order, tb_pesanan.telephone, tb_pesanan.tipe, tb_pesanan.tanggal, tb_rumah.lokasi, tb_pesanan.no_rumah, tb_harga_rumah.harga FROM tb_pesanan JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE status_pembelian = 1 AND DATE_FORMAT(tb_pesanan.tanggal, '%Y') = '".$_GET['unduh_laporan_tahunan']."' ORDER BY tb_pesanan.tanggal DESC");
    }
    else{
        $data = mysqli_query($connect,"SELECT tb_user.username, tb_pesanan.id_order, tb_pesanan.telephone, tb_pesanan.tipe, tb_pesanan.tanggal, tb_rumah.lokasi, tb_pesanan.no_rumah, tb_harga_rumah.harga FROM tb_pesanan JOIN tb_user ON tb_pesanan.id_user = tb_user.id_user JOIN tb_rumah ON tb_pesanan.id_rumah = tb_rumah.id_rumah JOIN tb_harga_rumah ON tb_pesanan.id_rumahdetail = tb_harga_rumah.id_rumahdetail WHERE status_pembelian = 1  ORDER BY tb_pesanan.tanggal DESC");
    }
    while($d = mysqli_fetch_array($data)){
        $pdf->Cell(10,6, $no++,1,0,'C');
        $pdf->Cell(20,6, date_format(new DateTime($d['tanggal']), "d/m/Y"),1,0);
        $pdf->Cell(40,6, $d['username'],1,0);  
        $pdf->Cell(30,6,  $d['tipe'],1,0);
        $pdf->Cell(35,6, $d['lokasi'],1,0);
        $pdf->Cell(20,6, $d['no_rumah'],1,0);
        $pdf->Cell(35,6,  number_format($d["harga"]),1,1);
    }
//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
   