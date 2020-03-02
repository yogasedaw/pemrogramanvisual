<?php
include_once "library/inc.seslogin.php";

if($_GET) {
	if(isset($_POST['btnSave'])){
		# Validasi form, jika kosong sampaikan pesan error
		$pesanError = array();
		if (trim($_POST['cmbTanggal'])=="") {
			$pesanError[] = "Data <b>Tanggal Pemesanan</b> belum diisi, pilih pada combo !";		
		}
		if (trim($_POST['txtJam'])=="") {
			$pesanError[] = "Data <b>Jam Makan</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtNoMeja'])=="") {
			$pesanError[] = "Data <b>Nomor Meja</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtJumlahOrg'])=="") {
			$pesanError[] = "Data <b>Jumlah Orang</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtNamaPesan'])=="") {
			$pesanError[] = "Data <b>Nama pemesanan</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtKeterangan'])=="") {
			$pesanError[] = "Data <b>keterangan Lengkap</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtTelepon'])=="") {
			$pesanError[] = "Data <b>No Telpon</b> tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$cmbTanggal 	= InggrisTgl($_POST['cmbTanggal']);
		$txtJam			= $_POST['txtJam'];
		$txtNoMeja		= $_POST['txtNoMeja'];
		$txtJumlahOrg	= $_POST['txtJumlahOrg'];
		$txtNamaPesan	= $_POST['txtNamaPesan'];
		$txtTelepon		= $_POST['txtTelepon'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		
		# JIKA ADA PESAN ERROR DARI VALIDASI
		if (count($pesanError)>=1 ){
            echo "<div class='mssgBox'>";
			echo "<img src='images/attention.png'> <br><hr>";
				$noPesan=0;
				foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
					echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
				} 
			echo "</div> <br>"; 
		}
		else {
			# SIMPAN DATA KE DATABASE. 
			// Jika tidak menemukan error, simpan data ke database	
			$mySql	= "INSERT INTO pemesanan (tanggal, jam, nomor_meja, jumlah_orang, nama_pemesan, no_telepon, keterangan) 
						VALUES ('$cmbTanggal', '$txtJam', '$txtNoMeja', '$txtJumlahOrg', '$txtNamaPesan', '$txtTelepon', '$txtKeterangan')";
			$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
			if($myQry){
				echo "<meta http-equiv='refresh' content='0; url=?page=Pemesanan-Data'>";
			}
			exit;
		}	
	} // Penutup POST
		
	# MASUKKAN DATA KE VARIABEL
	$dataTanggal 	= isset($_POST['cmbTanggal']) ? $_POST['cmbTanggal'] : date('d-m-Y');
	$dataJam		= isset($_POST['txtJam']) ? $_POST['txtJam'] : '';
	$dataNoMeja		= isset($_POST['txtNoMeja']) ? $_POST['txtNoMeja'] : '';
	$dataJumlahOrg	= isset($_POST['txtJumlahOrg']) ? $_POST['txtJumlahOrg'] : '';
	$dataNama		= isset($_POST['txtNamaPesan']) ? $_POST['txtNamaPesan'] : '';
	$dataTelepon 	= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
	$dataKeterangan = isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
}// Penutup GET
?>
<form action="?page=Pemesanan-Add" method="post" name="frmadd">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list" style="margin-top:0px;">
	<tr>
	  <th colspan="3">PEMESANAN TEMPAT</th>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td align="right">[ <a href="?page=Pemesanan-Data" target="_self">Daftar Pesanan</a> ] </td>
    </tr>
	<tr class="table-common">
      <td><b>Tanggal Makan</b></td>
	  <td><b>:</b></td>
	  <td><?php echo form_tanggal("cmbTanggal",$dataTanggal); ?></td>
    </tr>
	<tr>
      <td><b>Jam Makan </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtJam" value="<?php echo $dataJam; ?>" size="60" maxlength="40"/></td>
    </tr>
	<tr>
      <td><b>Nomor Meja </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNoMeja" value="<?php echo $dataNoMeja; ?>" size="60" maxlength="40"/></td>
    </tr>
	<tr>
	  <td width="15%"><b>Jumlah Orang </b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="txtJumlahOrg" value="<?php echo $dataJumlahOrg; ?>" size="60" maxlength="40"/></td></tr>
	<tr>
	  <td><b>Nama Pemesan </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNamaPesan" value="<?php echo $dataNama; ?>" size="60" maxlength="60" /></td>
	</tr>
	<tr>
      <td><b>No Telpon </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
	<tr>
      <td><b>Keterangan (Menu) </b></td>
	  <td><b>:</b></td>
	  <td><textarea name="txtKeterangan" cols="45" rows="3"><?php echo $dataKeterangan; ?></textarea></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
