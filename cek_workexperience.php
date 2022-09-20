<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<!-- <option value="">Choose Work Experience</option> -->
<?php
	if(!empty($_POST["GRADE"])) 
	{
		$GRADE = $_POST["GRADE"];
		$results = getQuery("select a.workexp_code,
						 		 	a.workexp_name,
						 		 	b.kode_grade
						  	   from m_workexperience a
						  left join m_grade b ON a.workexp_code = b.workexp_code
							  where b.kode_grade = '$GRADE'
						   order by a.workexp_code asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["workexp_code"]; ?>">
					<?php echo $rowz["workexp_name"]; ?>
				</option>
			<?php
		}
	}
?>
