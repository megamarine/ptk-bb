<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<option value="">Choose Type MCU</option>
<?php
	if(!empty($_POST["BASED_SALARY"])) 
	{
		$BASED_SALARY = $_POST["BASED_SALARY"];
		$results = getQuery("select * from m_typemcu where basedsalary_code = '$BASED_SALARY' order by basedsalary_code asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?= $rowz["mcu_code"]; ?>">
					<?= $rowz["mcu_name"]; ?>
				</option>
			<?php
		}
	}
?>
