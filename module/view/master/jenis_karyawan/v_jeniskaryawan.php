<?php
$result = GetQuery("select * from m_jeniskaryawan")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-tie"></i> Master Jenis Karyawan</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-user-tie"></i> Jenis Karyawan</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mjenkar == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_jeniskaryawan" type="button" class="btn btn-success"><i class="ico-plus2"></i> Tambah Jenis Karyawan</a>
        </div>
    </div>
    <br/>
<?php
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Jenis Karyawan</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi</th>
                        <th>Kode Jenis Karyawan</th>
                        <th>Nama Jenis Karyawan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mjenkar == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mjenkar == 1)
                                    {
                                    ?>
                                        <a href="edit_jeniskaryawan?KODE=<?php echo $row["kode_jenis"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit Jenis Karyawan"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mjenkar == 1)
                                    {
                                    ?>
                                        <a href="hapus_jeniskaryawan?KODE=<?php echo $row["kode_jenis"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete Jenis Karyawan" onclick="return confirm('Confirm delete <?php echo " : ".$row["kode_jenis"]." - ".$row["nama_jenis"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td><?php echo $row["kode_jenis"]; ?></td>
                                <td><?php echo $row["nama_jenis"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Kode Jenis Karyawan"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Nama Jenis Karyawan"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
