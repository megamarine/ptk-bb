<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<?php
	if(!empty($_POST["SHIFT"])) 
	{
		$SHIFT = $_POST["SHIFT"];
		$results = getQuery("select * from m_jamkerja where shift_code = '$SHIFT' order by jamkerja_code asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["jamkerja_code"]; ?>">
					<?php echo $rowz["jamkerja_name"]; ?>
				</option>
			<?php
		}
	}
?>
