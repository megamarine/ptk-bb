<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<option value="">Choose Jam Kerja</option>
<?php
	if(!empty($_POST["WORK_LOCATION"])) 
	{
		$WORK_LOCATION = $_POST["WORK_LOCATION"];
		$results = getQuery("select * from m_jamkerja where WORK_LOCATION = '$WORK_LOCATION' order by jamkerja_name,jamkerja_code");
		while($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			if(in_array($rowz["jamkerja_code"],$JAM_KERJA))
			{
				?>
				<option value="<?=$rowz["jamkerja_code"]?>" selected ><?=$rowz["jamkerja_name"];?></option>
				<?php
			}   
			else
			{
				?>
				<option value="<?=$rowz["jamkerja_code"]?>"><?=$rowz["jamkerja_name"];?></option>
				<?php
			}
		?>
		<?php 
		} 
	}
?>
