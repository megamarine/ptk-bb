<?php
$result = GetQuery("select a.*,
                           b.nama_departement,
                           c.nama_divisi,
                           d.nama_perusahaan,
                           e.nama_user
                      from m_subdivisi a
                      join m_departement b ON a.kode_departement = b.kode_departement
                      join m_divisi c ON a.kode_divisi = c.kode_divisi
                      join m_perusahaan d ON a.kode_perusahaan = d.kode_perusahaan
                      left join m_user e ON a.head = e.kode_user");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-university"></i> Master Sub Divisi</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-university"></i> Sub Divisi</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_msubdiv == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_subdivisi" type="button" class="btn btn-success"><i class="ico-plus2"></i> Tambah Sub Divisi</a>
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
                <h3 class="panel-title">Daftar Sub Divisi</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Opsi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>Perusahaan</th>
                        <th>Departement</th>
                        <th>Divisi</th>
                        <th>Kode Sub Divisi</th>
                        <th>Sub Divisi</th>
                        <th>Head</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_msubdiv == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_msubdiv == 1)
                                    {
                                    ?>
                                        <a href="edit_subdivisi?KODE=<?php echo $row["kode_subdivisi"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_msubdiv == 1)
                                    {
                                    ?>
                                        <a href="hapus_subdivisi?KODE=<?php echo $row["kode_subdivisi"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_subdivisi"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td><?php echo $row["nama_perusahaan"]; ?></td>
                                <td><?php echo $row["nama_departement"]; ?></td>
                                <td><?php echo $row["nama_divisi"]; ?></td>
                                <td><?php echo $row["kode_subdivisi"]; ?></td>
                                <td><?php echo $row["nama_subdivisi"]; ?></td>
                                <td><?php echo $row["nama_user"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Perusahaan"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Departement"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Divisi"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Kode Sub Divisi"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sub Divisi"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Head"></th>
                        
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
