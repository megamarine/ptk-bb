<?php

$result = GetQuery("select a.*, 
                           b.nama_departement, 
                           c.nama_divisi 
                      from m_user a 
                      left join m_departement b ON a.kode_departement = b.kode_departement
                      left join m_divisi c ON a.kode_divisi = c.kode_divisi order by a.nama_user")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-user"></i> Master User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-user"></i> User</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_muser == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_user" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add User</a>
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
                <h3 class="panel-title">User List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Username</th>
                        <th style="white-space:nowrap">Name</th>
                        <th style="white-space:nowrap">Department</th>
                        <th style="white-space:nowrap">Division</th>
                        <th style="white-space:nowrap">Access</th>
                        <th style="white-space:nowrap">Email</th>
                        <th style="white-space:nowrap">PTK View Access</th>
                        <th style="white-space:nowrap">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_muser == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_muser == 1)
                                    {
                                    ?>
                                        <a href="edit_user?KODE=<?php echo $row["kode_user"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit User"></i></a>
                                    <?php 
                                    } 
                                    if($delete_muser == 1)
                                    {
                                    ?>
                                      <a href="hapus_user?KODE=<?php echo $row["kode_user"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete User" onclick="return confirm('Confirm delete <?php echo " : ".$row["kode_user"]." - ".$row["nama_user"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                    </td>
                                    <td style="white-space:nowrap"><?php echo $row["kode_user"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["nama_user"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["akses"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["email"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["ptk_view"]; ?></td>
                                    <td style="white-space:nowrap"><?php echo $row["status"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Username"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Department"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Division"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Access"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Email"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="PTK View Access"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Status"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
