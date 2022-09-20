<?php
	require_once("module/model/koneksi/koneksi.php");
	if(!empty($_POST["TYPE_WORKER"])) 
	{
		$TYPE_WORKER = $_POST["TYPE_WORKER"];
		$results = getQuery("select * from m_typeworker where worktype_code = '$TYPE_WORKER' order by worktype_code asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["worktype_code"]; ?>">
					<?php echo $rowz["worktype_name"]; ?>
				</option>
			<?php
		}
	}
?>
