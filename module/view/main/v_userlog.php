<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><span class="figure"><i class="ico-home2"></i></span> Dashboards </h4>
    </div>
</div>
<script type="text/javascript">
// order data dari query
$(document).ready(function() {
    $('#tes').DataTable( {
        "order": [[ 4, "desc" ]]
    } );
} );
</script>
<?php 
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$where_clause = "";
if($_SESSION['LOGINAKS_PERSONALIA_BB'] != "Administrator")
{
    $where_clause = "where user_id = '$ID_USER1'";
}

$result = GetQuery("select a.*,
                           b.nama_user 
                      from users_log a 
                 left join m_user b ON a.user_id = b.kode_user 
                      $where_clause 
                  order by a.log_id desc");
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle fa-lg"></i></span> User Log Activity</h3>
            </div>
            <table class="table table-striped table-bordered" id="tes">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th>Modul</th>
                        <th>Log</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Nama User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td hidden><?php echo $row["log_id"]; ?></td>
                                <td><?php echo $row["module"]; ?></td>
                                <td><?php echo $row["trans_type"]; ?></td>
                                <td><?php echo $row["description"]; ?></td>
                                <td><?php echo $row["created_date"]; ?></td>
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["nama_user"]; ?></td>
                            </tr>
                            <?php
                        }                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>