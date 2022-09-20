<?php
$result = GetQuery("select *, date_format(date, '%d %b %Y') as date_version from version order by seq desc")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><span class="figure"><i class="ico-home2"></i></span> Dashboards </h4>
    </div>
</div>
<?php 
if($_SESSION['LOGINAKS_PERSONALIA_BB'] == "Administrator")
{
?>
    <div class="row">
        <div class="col-lg-12" align="left">
            <button data-toggle="modal" data-target="#modalTambah" class="btn btn-success"><i class="fas fa-plus"></i> Add Version</button>
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
                <h3 class="panel-title"><i class="fa fa-info-circle fa-lg"></i></span> Version Change Log</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Version</th>
                        <th style="white-space:nowrap">Date Changed</th>
                        <th style="white-space:nowrap">Request From</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php if($_SESSION['LOGINAKS_PERSONALIA_BB'] == "Administrator")
                                    { ?>
                                        <button data-toggle="modal" title="Edit" data-target="#modalEdit" class="btn btn-teal open-edit" data-seq="<?=$row['seq'];?>" data-version="<?=$row['version'];?>" data-date="<?=$row['date'];?>" data-change_log="<?=$row['change_log'];?>" data-req_by="<?=$row['req_by'];?>"><i class="fas fa-pencil-alt"></i></button>
                                    
                                        <a href="hapus_versi?seq=<?php echo $row["seq"]; ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Confirm delete version <?php echo " : ".$row["version"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php } ?>
                                        <button title="Detail" style="border-width: 0" class="btn btn-success" data-toggle="modal" data-target="#modalDetail" id="open-detail" data-version="<?=$row['version'];?>" data-change_log="<?=$row['change_log'];?>"><i class="fas fa-search"></i>
                                    </button>                                    
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["version"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["date_version"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["req_by"]; ?></td>
                            </tr>
                            <?php
                        }                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#86C3D0;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-plus"></span> Version Change Log</h4>
      </div>
      <form role="form" action="tambah_versi" method="post" data-parsley-validate>
          <div class="modal-body">
            <div class="form-group">
                <label for="VERSION">Version <span class="text-danger">*</span></label>
                <input type="text" required="" autocomplete="off" class="form-control" id="VERSION" name="VERSION">
            </div>
            <div class="form-group">
                <label for="VERSION_DATE">Date <span class="text-danger">*</span></label>
                <input type="date" required="" class="form-control" id="VERSION_DATE" name="VERSION_DATE">
            </div>
            <div class="form-group">
                <label for="REQ_BY">Request By <span class="text-danger">*</span></label>
                <input type="text" required="" autocomplete="off" class="form-control" id="REQ_BY" name="REQ_BY">
            </div>
            <div class="form-group">                
                <label for="VERSION_REMARK">Update Remark <span class="text-danger">*</span></label>
                <textarea class="form-control" autocomplete="off" required="" id="VERSION_REMARK" name="VERSION_REMARK" style="width:100%; height: 15em;"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Simpan</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#86C3D0;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-pencil-alt"></span> Edit Version Log</h4>
      </div>
      <form role="form" action="tambah_versi" method="post" data-parsley-validate>
          <div class="modal-body">
            
            <input type="hidden" required="" autocomplete="off" class="form-control" id="SEQ" name="SEQ">

            <div class="form-group">
                <label for="VERSION">Versi Program <span class="text-danger">*</span></label>
                <input type="text" required="" autocomplete="off" class="form-control" id="VERSION" name="VERSION">
            </div>
            <div class="form-group">
                <label for="VERSION_DATE">Tanggal <span class="text-danger">*</span></label>
                <input type="date" required="" class="form-control" id="VERSION_DATE" name="VERSION_DATE">
            </div>
            <div class="form-group">
                <label for="REQ_BY">Diminta Oleh <span class="text-danger">*</span></label>
                <input type="text" required="" autocomplete="off" class="form-control" id="REQ_BY" name="REQ_BY">
            </div>
            <div class="form-group">                
                <label for="VERSION_REMARK">Update Remark <span class="text-danger">*</span></label>
                <textarea class="form-control" autocomplete="off" required="" id="VERSION_REMARK" name="VERSION_REMARK" style="width:100%; height: 15em;"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Simpan</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#86C3D0;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-info-circle"></span> Version Log - <b id="version"></b></h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <textarea class="form-control" disabled id="change_log" style="width:100%; height: 15em;"></textarea>
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//open-detail
$(document).on("click", "#open-detail", function ()
{
    $(".modal-header #version").html( $(this).data('version'));
    $(".modal-body #change_log").val( $(this).data('change_log'));
});

//open-edit
$(document).on("click", ".open-edit", function ()
{
    $(".modal-body #SEQ").val( $(this).data('seq'));
    $(".modal-body #VERSION").val( $(this).data('version'));
    $(".modal-body #VERSION_DATE").val( $(this).data('date'));
    $(".modal-body #REQ_BY").val( $(this).data('req_by'));
    $(".modal-body #VERSION_REMARK").val( $(this).data('change_log'));
});
</script>