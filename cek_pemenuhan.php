<script type="text/javascript">
// Function Delete

function rmvData(seq, urut){
	result = confirm('Yakin Delete Pemenuhan ?');
	if (result){
		$.ajax({
            type: "GET",
            url: "hapus_pemenuhan.php",
            data: 'seq='+seq+'&urut='+urut,
            dataType: "json",
            encode: true,
        }).done(function(data) {
			if (data.success == true) {
                $.ajax({
                    type: "POST",
                    url: "cek_pemenuhan.php",
                    data:'seq='+seq,
                    success: function(data){
                        $("#PEMENUHAN").html(data);
                    }
                });
            } else {
                alert(data.message);
            }
		}).fail(function(xhr, status, error) {
            alert("Delete Failed Server Error");
        });
	}
 }
</script>

<?php require_once("module/model/koneksi/koneksi.php");

	if(!empty($_POST["seq"])) 
	{
		$seq = $_POST["seq"];

		$results = getQuery("select seq, qty_submition, qty_accepted, qty_left from t_ptk where seq = '$seq'");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
		{
			$qty_submition  = $rowz["qty_submition"] ;
			$qty_accepted 	= $rowz["qty_accepted"] ;
			$qty_left 		= $rowz["qty_left"] ;
		}
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
		            Qty permintaan : <b><?=$qty_submition;?></b> | Sudah diterima : <b style="color:green"><?=$qty_accepted;?></b> | Qty kekurangan : <b style="color:red"><?=$qty_left;?></b>
		            <hr style="border-width: 1px 1px 0; border-style: solid; border-color: darkgrey;">
		            <input type="hidden" required="" class="form-control" id="seq-ptk" name="seq-ptk" value="<?=$seq;?>">
		        </div>
	    	</div>
	    </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label> Tanggal Alokasi :</label>
                    <input type="date" required="" autocomplete="off" class="form-control" id="date_accepted" name="date_accepted">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label> ID Karyawan :</label>
                    <input type="number" min="0" required="" autocomplete="off" class="form-control" id="id_accepted" name="id_accepted" placeholder="Input ID karyawan">
                </div>
            </div>
			<div class="col-md-2">
                <div class="form-group">
                    <label> Jenis Kelamin :</label>
                    <select id="gender" name="gender" class="form-control" required="">
						<option value="">Choose Gender</option>
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label> Nama Karyawan :</label>
                    <input type="text" required="" autocomplete="off" class="form-control" id="name_accepted" name="name_accepted" placeholder="Input nama karyawan">
                </div>
            </div>
        </div>
        <div class="row">
	        <div class="modal-body table-responsive">
	            <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
	                <tr><td colspan="8" style="background-color:lightgrey;text-align: center;">List Alokasi</td></tr>
	                <tr>
	                    <th style="background-color:lightgrey;text-align: center;">#</th>
	                    <th style="background-color:lightgrey;text-align: center;">Tanggal Alokasi</th>
	                    <th style="background-color:lightgrey;text-align: center;">ID Karyawan</th>
	                    <th style="background-color:lightgrey;text-align: center;">Nama Karyawan</th>
						<th style="background-color:lightgrey;text-align: center;">Jenis Kelamin</th>
	                    <th style="background-color:lightgrey;text-align: center;">Submited By</th>
	                    <th style="background-color:lightgrey;text-align: center;">Submited Date</th>
						<th style="background-color:lightgrey;text-align: center;">Delete</th>
	                </tr>
	                <?php
	                $no = 1;
	                $result_deleted = getQuery("select  a.urut,
														a.seq,
	                                                    date_format(a.date, '%d %b %Y') as date,
	                                                    a.id_accepted,
	                                                    a.name_accepted,
	                                                    a.created_date,
	                                                    b.nama_user,
														case 
															when jenis_kelamin = 'L' then 'Laki-laki'
          													when jenis_kelamin = 'P' then 'Perempuan'
															else 'Undefined' 
														end as jenis_kelamin
	                                               from t_fulfillment a
	                                          LEFT JOIN m_user b ON a.created_by = b.kode_user
	                                          	  where a.seq = '$seq'
	                                           order by a.urut asc");
	                while ($rowd = $result_deleted->fetch(PDO::FETCH_ASSOC))
	                {
						$seq  = $rowd["seq"];
						$urut = $rowd["urut"];
	                ?>
	                    <tr>
	                        <td style="white-space:nowrap;text-align:center;"><?=$no++.".";?></td>
	                        <td style="white-space:nowrap;text-align:left;"><?=$rowd["date"];?></td>
	                        <td style="white-space:nowrap;text-align:left;"><?=$rowd["id_accepted"];?></td>
	                        <td style="white-space:nowrap;text-align:left;"><?=$rowd["name_accepted"];?></td>
							<td style="white-space:nowrap;text-align:left;"><?=$rowd["jenis_kelamin"];?></td>
	                        <td style="white-space:nowrap;text-align:left;"><?=$rowd["nama_user"];?></td>
	                        <td style="white-space:nowrap;text-align:left;"><?=$rowd["created_date"];?></td>
							<td style="white-space:nowrap;text-align:center;">
								<i class="fa fa-trash fa-lg" onclick="rmvData('<?=$seq; ?>','<?=$urut; ?>')" style="color:red"></i>
							</td>
	                    </tr>
	                <?php
	                } 
	                ?>
	            </table>
	        </div>
	    </div>
		<div class="row" align="center">
			<?php
			if($qty_left == 0)
			{ ?>
				<a href="close_pemenuhan?seq=<?=$seq;?>" class="btn btn-primary"><i class="fa fa-check"></i> <b>Close This PTK</b></a>
			<?php } ?>
		</div>
	<?php		
	};
?>