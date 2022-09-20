<?php
include "module/controller/master/jenis_karyawan/t_jeniskaryawan.php";
?>
<script type="text/javascript">
    function getUSER(val) {
      $.ajax({
      type: "POST",
      url: "cek_user.php",
      data:'KODE_USER='+val,
      success: function(data){
        $("#DATA_USER").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-tie"></i> Tambah Jenis Karyawan</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_jeniskaryawan"><i class="fas fa-user-tie"></i> Jenis Karyawan</a></li>
                <li class="active"><i class="ico-plus2"></i> Tambah Jenis Karyawan</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>             
            <div id="DATA_USER"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMA_JENIS">Nama Jenis Karyawan <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="NAMA_JENIS" name="NAMA_JENIS" value="<?php echo $NAMA_JENIS; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fas fa-save fa-lg"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="m_jeniskaryawan" type="button" class="btn btn-danger"><i class="fas fa-times fa-lg"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
