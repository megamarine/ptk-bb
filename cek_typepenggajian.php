<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<option value="">Choose Type Penggajian</option>
<?php
	if(!empty($_POST["PLACEMENT"])) 
	{
		$PLACEMENT = $_POST["PLACEMENT"];
		$results = getQuery("select * from m_typesalary where placement_code = '$PLACEMENT' order by typesalary_code asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["typesalary_code"]; ?>">
					<?php echo $rowz["typesalary_name"]; ?>
				</option>
			<?php
		}
	}
?>
