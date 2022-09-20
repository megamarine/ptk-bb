<?php
$options = [
    'cost' => 12,
];

$DINO                = date('Y-m-d H:i:s');
$ID_USER1            = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS          = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME             = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER           = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$USERNAME            = "";
$NAMA                = "";
$PASSWORD            = "";
$DEPARTEMENT         = "";
$DIVISI              = "";
$AKSES               = "";
$EMAIL               = "";
$STATUS              = "";
$PTK_VIEW            = "";
$mod_muser_c         = "";
$mod_muser_r         = "";
$mod_muser_u         = "";
$mod_muser_d         = "";
$mod_mperusahaan_c   = "";
$mod_mperusahaan_r   = "";
$mod_mperusahaan_u   = "";
$mod_mperusahaan_d   = "";
$mod_mdept_c         = "";
$mod_mdept_r         = "";
$mod_mdept_u         = "";
$mod_mdept_d         = "";
$mod_mdiv_c          = "";
$mod_mdiv_r          = "";
$mod_mdiv_u          = "";
$mod_mdiv_d          = "";
// $mod_msubdiv_c    = "";
// $mod_msubdiv_r    = "";
// $mod_msubdiv_u    = "";
// $mod_msubdiv_d    = "";
$mod_msec_c          = "";
$mod_msec_r          = "";
$mod_msec_u          = "";
$mod_msec_d          = "";
$mod_msubsec_c       = "";
$mod_msubsec_r       = "";
$mod_msubsec_u       = "";
$mod_msubsec_d       = "";
$mod_mteam_c         = "";
$mod_mteam_r         = "";
$mod_mteam_u         = "";
$mod_mteam_d         = "";
$mod_munit_c         = "";
$mod_munit_r         = "";
$mod_munit_u         = "";
$mod_munit_d         = "";
$mod_mjab_c          = "";
$mod_mjab_r          = "";
$mod_mjab_u          = "";
$mod_mjab_d          = "";
$mod_mgrade_c        = "";
$mod_mgrade_r        = "";
$mod_mgrade_u        = "";
$mod_mgrade_d        = "";
$mod_mlevel_c        = "";
$mod_mlevel_r        = "";
$mod_mlevel_u        = "";
$mod_mlevel_d        = "";
$mod_mworklocation_c = "";
$mod_mworklocation_r = "";
$mod_mworklocation_u = "";
$mod_mworklocation_d = "";
$mod_mworkexp_c      = "";
$mod_mworkexp_r      = "";
$mod_mworkexp_u      = "";
$mod_mworkexp_d      = "";
$mod_mshift_c        = "";
$mod_mshift_r        = "";
$mod_mshift_u        = "";
$mod_mshift_d        = "";
$mod_mjamkerja_c     = "";
$mod_mjamkerja_r     = "";
$mod_mjamkerja_u     = "";
$mod_mjamkerja_d     = "";
$mod_mplacement_c    = "";
$mod_mplacement_r    = "";
$mod_mplacement_u    = "";
$mod_mplacement_d    = "";
$mod_mtypesalary_c   = "";
$mod_mtypesalary_r   = "";
$mod_mtypesalary_u   = "";
$mod_mtypesalary_d   = "";
$mod_ptk_c           = "";
$mod_ptk_r           = "";
$mod_ptk_u           = "";
$mod_ptk_d           = "";
$mod_appmgr          = "";
$mod_appdir          = "";
$mod_apphrd          = "";
$mod_appmd           = "";
$mod_pemenuhanptk    = "";
$mod_laporanptk      = "";


//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];

    $result  = GetQuery("select * from m_user where kode_user='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $USERNAME    = $row["kode_user"];
        $NAMA        = $row["nama_user"];
        $DEPARTEMENT = $row["kode_departement"];
        $DIVISI      = $row["kode_divisi"];
        $AKSES       = $row["akses"];
        $EMAIL       = $row["email"];
        $STATUS      = $row["status"];
        $PTK_VIEW    = $row["ptk_view"];
    }

    //MODULE 1 / Master User
    $result1  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '1'");
    while ($row1 = $result1->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_muser_c = $row1["xcreate"];
        $mod_muser_r = $row1["xread"];
        $mod_muser_u = $row1["xupdate"];
        $mod_muser_d = $row1["xdelete"];
    }

    //MODULE 2 / Master Grade
    $result1  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '2'");
    while ($row1 = $result1->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mgrade_c = $row1["xcreate"];
        $mod_mgrade_r = $row1["xread"];
        $mod_mgrade_u = $row1["xupdate"];
        $mod_mgrade_d = $row1["xdelete"];
    }

    //MODULE 3 / Master Perusahaan
    $result3  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '3'");
    while ($row3 = $result3->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mperusahaan_c = $row3["xcreate"];
        $mod_mperusahaan_r = $row3["xread"];
        $mod_mperusahaan_u = $row3["xupdate"];
        $mod_mperusahaan_d = $row3["xdelete"];
    }

    //MODULE 4 / Master Departement
    $result4  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '4'");
    while ($row4 = $result4->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mdept_c = $row4["xcreate"];
        $mod_mdept_r = $row4["xread"];
        $mod_mdept_u = $row4["xupdate"];
        $mod_mdept_d = $row4["xdelete"];
    }

    //MODULE 5 / Master Divisi
    $result5  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '5'");
    while ($row5 = $result5->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mdiv_c = $row5["xcreate"];
        $mod_mdiv_r = $row5["xread"];
        $mod_mdiv_u = $row5["xupdate"];
        $mod_mdiv_d = $row5["xdelete"];
    }

    //MODULE 6 / Master Sub Divisi
    // $result6  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '6'");
    // while ($row6 = $result6->fetch(PDO::FETCH_ASSOC))  
    // {
    //     $mod_msubdiv_c = $row6["xcreate"];
    //     $mod_msubdiv_r = $row6["xread"];
    //     $mod_msubdiv_u = $row6["xupdate"];
    //     $mod_msubdiv_d = $row6["xdelete"];
    // }

    //MODULE 7 / Master Section
    $result7  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '7'");
    while ($row7 = $result7->fetch(PDO::FETCH_ASSOC))
    {
        $mod_msec_c = $row7["xcreate"];
        $mod_msec_r = $row7["xread"];
        $mod_msec_u = $row7["xupdate"];
        $mod_msec_d = $row7["xdelete"];
    }

    //MODULE 8 / Master Sub Section
    $result8  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '8'");
    while ($row8 = $result8->fetch(PDO::FETCH_ASSOC))
    {
        $mod_msubsec_c = $row8["xcreate"];
        $mod_msubsec_r = $row8["xread"];
        $mod_msubsec_u = $row8["xupdate"];
        $mod_msubsec_d = $row8["xdelete"];
    }

    //MODULE 9 / Master Team
    $result9  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '9'");
    while ($row9 = $result9->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mteam_c = $row9["xcreate"];
        $mod_mteam_r = $row9["xread"];
        $mod_mteam_u = $row9["xupdate"];
        $mod_mteam_d = $row9["xdelete"];
    }

    //MODULE 10 / Master Unit
    $result10  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '10'");
    while ($row10 = $result10->fetch(PDO::FETCH_ASSOC))
    {
        $mod_munit_c = $row10["xcreate"];
        $mod_munit_r = $row10["xread"];
        $mod_munit_u = $row10["xupdate"];
        $mod_munit_d = $row10["xdelete"];
    }

    //MODULE 11 / Master Jabatan
    $result11  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '11'");
    while ($row11 = $result11->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mjab_c = $row11["xcreate"];
        $mod_mjab_r = $row11["xread"];
        $mod_mjab_u = $row11["xupdate"];
        $mod_mjab_d = $row11["xdelete"];
    }

    //MODULE 12 / Master Level
    $result12  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '12'");
    while ($row12 = $result12->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mlevel_c = $row12["xcreate"];
        $mod_mlevel_r = $row12["xread"];
        $mod_mlevel_u = $row12["xupdate"];
        $mod_mlevel_d = $row12["xdelete"];
    }

    //MODULE 13 / PTK
    $result13  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '13'");
    while ($row13 = $result13->fetch(PDO::FETCH_ASSOC))
    {
        $mod_ptk_c = $row13["xcreate"];
        $mod_ptk_r = $row13["xread"];
        $mod_ptk_u = $row13["xupdate"];
        $mod_ptk_d = $row13["xdelete"];
    }

    //MODULE 14 / Approval Manager
    $result14  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '14'");
    while ($row14 = $result14->fetch(PDO::FETCH_ASSOC))
    {
        $mod_appmgr = $row14["xcreate"];
    }

    //MODULE 15 / Approval Director
    $result15  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '15'");
    while ($row15 = $result15->fetch(PDO::FETCH_ASSOC))
    {
        $mod_appdir = $row15["xcreate"];
    }

    //MODULE 16 / Approval HRD
    $result16  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '16'");
    while ($row16 = $result16->fetch(PDO::FETCH_ASSOC))
    {
        $mod_apphrd = $row16["xcreate"];
    }

    //MODULE 17 / Approval MD
    $result17  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '17'");
    while ($row17 = $result17->fetch(PDO::FETCH_ASSOC))
    {
        $mod_appmd = $row17["xcreate"];
    }

    //MODULE 18 / Pemenuhan PTK
    $result18  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '18'");
    while ($row18 = $result18->fetch(PDO::FETCH_ASSOC))
    {
        $mod_pemenuhanptk = $row18["xcreate"];
    }

    //MODULE 19 / Laporan PTK
    $result19  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '19'");
    while ($row19 = $result19->fetch(PDO::FETCH_ASSOC))
    {
        $mod_laporanptk = $row19["xcreate"];
    }

    //MODULE 20 / Master Work Location
    $result20  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '20'");
    while ($row20 = $result20->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mworklocation_c = $row20["xcreate"];
        $mod_mworklocation_r = $row20["xread"];
        $mod_mworklocation_u = $row20["xupdate"];
        $mod_mworklocation_d = $row20["xdelete"];
    }

    //MODULE 21 / Master Work Experience
    $result21  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '21'");
    while ($row21 = $result21->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mworkexp_c = $row21["xcreate"];
        $mod_mworkexp_r = $row21["xread"];
        $mod_mworkexp_u = $row21["xupdate"];
        $mod_mworkexp_d = $row21["xdelete"];
    }

    //MODULE 22 / Master Jam Kerja
    $result22  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '22'");
    while ($row22 = $result22->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mjamkerja_c = $row22["xcreate"];
        $mod_mjamkerja_r = $row22["xread"];
        $mod_mjamkerja_u = $row22["xupdate"];
        $mod_mjamkerja_d = $row22["xdelete"];
    }

    //MODULE 23 / Master Placement
    $result23  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '23'");
    while ($row23 = $result23->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mplacement_c = $row23["xcreate"];
        $mod_mplacement_r = $row23["xread"];
        $mod_mplacement_u = $row23["xupdate"];
        $mod_mplacement_d = $row23["xdelete"];
    }

    //MODULE 24 / Master Type Salary
    $result24  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '24'");
    while ($row24 = $result24->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mtypesalary_c = $row24["xcreate"];
        $mod_mtypesalary_r = $row24["xread"];
        $mod_mtypesalary_u = $row24["xupdate"];
        $mod_mtypesalary_d = $row24["xdelete"];
    }

    //MODULE 25 / Master Shift
    $result25  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '25'");
    while ($row25 = $result25->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mshift_c = $row25["xcreate"];
        $mod_mshift_r = $row25["xread"];
        $mod_mshift_u = $row25["xupdate"];
        $mod_mshift_d = $row25["xdelete"];
    }

    if(isset($_POST["simpan"]))
    {
        $USERNAME            = $_POST["USERNAME"];
        $NAMA                = $_POST["NAMA"];
        $DEPARTEMENT         = $_POST["DEPARTEMENT"];
        $DIVISI              = $_POST["DIVISI"];
        $AKSES               = $_POST["AKSES"];
        $EMAIL               = $_POST["EMAIL"];
        $STATUS              = $_POST["STATUS"];
        $PTK_VIEW            = $_POST["PTK_VIEW"];

        $mod_muser_c         = isset($_POST["mod_muser_c"]) ? 1 : 0;
        $mod_muser_r         = isset($_POST["mod_muser_r"]) ? 1 : 0;
        $mod_muser_u         = isset($_POST["mod_muser_u"]) ? 1 : 0;
        $mod_muser_d         = isset($_POST["mod_muser_d"]) ? 1 : 0;

        $mod_mperusahaan_c   = isset($_POST["mod_mperusahaan_c"]) ? 1 : 0;
        $mod_mperusahaan_r   = isset($_POST["mod_mperusahaan_r"]) ? 1 : 0;
        $mod_mperusahaan_u   = isset($_POST["mod_mperusahaan_u"]) ? 1 : 0;
        $mod_mperusahaan_d   = isset($_POST["mod_mperusahaan_d"]) ? 1 : 0;

        $mod_mdept_c         = isset($_POST["mod_mdept_c"]) ? 1 : 0;
        $mod_mdept_r         = isset($_POST["mod_mdept_r"]) ? 1 : 0;
        $mod_mdept_u         = isset($_POST["mod_mdept_u"]) ? 1 : 0;
        $mod_mdept_d         = isset($_POST["mod_mdept_d"]) ? 1 : 0;

        $mod_mdiv_c          = isset($_POST["mod_mdiv_c"]) ? 1 : 0;
        $mod_mdiv_r          = isset($_POST["mod_mdiv_r"]) ? 1 : 0;
        $mod_mdiv_u          = isset($_POST["mod_mdiv_u"]) ? 1 : 0;
        $mod_mdiv_d          = isset($_POST["mod_mdiv_d"]) ? 1 : 0;

        // $mod_msubdiv_c    = isset($_POST["mod_msubdiv_c"]) ? 1 : 0;
        // $mod_msubdiv_r    = isset($_POST["mod_msubdiv_r"]) ? 1 : 0;
        // $mod_msubdiv_u    = isset($_POST["mod_msubdiv_u"]) ? 1 : 0;
        // $mod_msubdiv_d    = isset($_POST["mod_msubdiv_d"]) ? 1 : 0;

        $mod_msec_c          = isset($_POST["mod_msec_c"]) ? 1 : 0;
        $mod_msec_r          = isset($_POST["mod_msec_r"]) ? 1 : 0;
        $mod_msec_u          = isset($_POST["mod_msec_u"]) ? 1 : 0;
        $mod_msec_d          = isset($_POST["mod_msec_d"]) ? 1 : 0;

        $mod_msubsec_c       = isset($_POST["mod_msubsec_c"]) ? 1 : 0;
        $mod_msubsec_r       = isset($_POST["mod_msubsec_r"]) ? 1 : 0;
        $mod_msubsec_u       = isset($_POST["mod_msubsec_u"]) ? 1 : 0;
        $mod_msubsec_d       = isset($_POST["mod_msubsec_d"]) ? 1 : 0;

        $mod_mteam_c         = isset($_POST["mod_mteam_c"]) ? 1 : 0;
        $mod_mteam_r         = isset($_POST["mod_mteam_r"]) ? 1 : 0;
        $mod_mteam_u         = isset($_POST["mod_mteam_u"]) ? 1 : 0;
        $mod_mteam_d         = isset($_POST["mod_mteam_d"]) ? 1 : 0;

        $mod_munit_c         = isset($_POST["mod_munit_c"]) ? 1 : 0;
        $mod_munit_r         = isset($_POST["mod_munit_r"]) ? 1 : 0;
        $mod_munit_u         = isset($_POST["mod_munit_u"]) ? 1 : 0;
        $mod_munit_d         = isset($_POST["mod_munit_d"]) ? 1 : 0;

        $mod_mjab_c          = isset($_POST["mod_mjab_c"]) ? 1 : 0;
        $mod_mjab_r          = isset($_POST["mod_mjab_r"]) ? 1 : 0;
        $mod_mjab_u          = isset($_POST["mod_mjab_u"]) ? 1 : 0;
        $mod_mjab_d          = isset($_POST["mod_mjab_d"]) ? 1 : 0;

        $mod_mgrade_c        = isset($_POST["mod_mgrade_c"]) ? 1 : 0;
        $mod_mgrade_r        = isset($_POST["mod_mgrade_r"]) ? 1 : 0;
        $mod_mgrade_u        = isset($_POST["mod_mgrade_u"]) ? 1 : 0;
        $mod_mgrade_d        = isset($_POST["mod_mgrade_d"]) ? 1 : 0;

        $mod_mlevel_c        = isset($_POST["mod_mlevel_c"]) ? 1 : 0;
        $mod_mlevel_r        = isset($_POST["mod_mlevel_r"]) ? 1 : 0;
        $mod_mlevel_u        = isset($_POST["mod_mlevel_u"]) ? 1 : 0;
        $mod_mlevel_d        = isset($_POST["mod_mlevel_d"]) ? 1 : 0;

        $mod_ptk_c           = isset($_POST["mod_ptk_c"]) ? 1 : 0;
        $mod_ptk_r           = isset($_POST["mod_ptk_r"]) ? 1 : 0;
        $mod_ptk_u           = isset($_POST["mod_ptk_u"]) ? 1 : 0;
        $mod_ptk_d           = isset($_POST["mod_ptk_d"]) ? 1 : 0;

        $mod_appmgr          = isset($_POST["mod_appmgr"]) ? 1 : 0;
        $mod_appdir          = isset($_POST["mod_appdir"]) ? 1 : 0;
        $mod_apphrd          = isset($_POST["mod_apphrd"]) ? 1 : 0;
        $mod_appmd           = isset($_POST["mod_appmd"]) ? 1 : 0;
        $mod_pemenuhanptk    = isset($_POST["mod_pemenuhanptk"]) ? 1 : 0;
        $mod_laporanptk      = isset($_POST["mod_laporanptk"]) ? 1 : 0;

        $mod_mworklocation_c = isset($_POST["mod_mworklocation_c"]) ? 1 : 0;
        $mod_mworklocation_r = isset($_POST["mod_mworklocation_r"]) ? 1 : 0;
        $mod_mworklocation_u = isset($_POST["mod_mworklocation_u"]) ? 1 : 0;
        $mod_mworklocation_d = isset($_POST["mod_mworklocation_d"]) ? 1 : 0;

        $mod_mworkexp_c      = isset($_POST["mod_mworkexp_c"]) ? 1 : 0;
        $mod_mworkexp_r      = isset($_POST["mod_mworkexp_r"]) ? 1 : 0;
        $mod_mworkexp_u      = isset($_POST["mod_mworkexp_u"]) ? 1 : 0;
        $mod_mworkexp_d      = isset($_POST["mod_mworkexp_d"]) ? 1 : 0;

        $mod_mjamkerja_c     = isset($_POST["mod_mjamkerja_c"]) ? 1 : 0;
        $mod_mjamkerja_r     = isset($_POST["mod_mjamkerja_r"]) ? 1 : 0;
        $mod_mjamkerja_u     = isset($_POST["mod_mjamkerja_u"]) ? 1 : 0;
        $mod_mjamkerja_d     = isset($_POST["mod_mjamkerja_d"]) ? 1 : 0;

        $mod_mplacement_c    = isset($_POST["mod_mplacement_c"]) ? 1 : 0;
        $mod_mplacement_r    = isset($_POST["mod_mplacement_r"]) ? 1 : 0;
        $mod_mplacement_u    = isset($_POST["mod_mplacement_u"]) ? 1 : 0;
        $mod_mplacement_d    = isset($_POST["mod_mplacement_d"]) ? 1 : 0;

        $mod_mtypesalary_c   = isset($_POST["mod_mtypesalary_c"]) ? 1 : 0;
        $mod_mtypesalary_r   = isset($_POST["mod_mtypesalary_r"]) ? 1 : 0;
        $mod_mtypesalary_u   = isset($_POST["mod_mtypesalary_u"]) ? 1 : 0;
        $mod_mtypesalary_d   = isset($_POST["mod_mtypesalary_d"]) ? 1 : 0;

        $mod_mshift_c        = isset($_POST["mod_mshift_c"]) ? 1 : 0;
        $mod_mshift_r        = isset($_POST["mod_mshift_r"]) ? 1 : 0;
        $mod_mshift_u        = isset($_POST["mod_mshift_u"]) ? 1 : 0;
        $mod_mshift_d        = isset($_POST["mod_mshift_d"]) ? 1 : 0;

        //UPDATE M_USER
        $update = UpdateData(
        "m_user",
        "kode_user = '$USERNAME', nama_user='$NAMA', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI' , akses='$AKSES', email='$EMAIL', ptk_view='$PTK_VIEW', status='$STATUS', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_user = '$KODE'");

        if($update)
        {
            //INSERT TO TABLE M_USERMODULE SESUAI JUMLAH MODULE YG ADA DI TABLE M_MODULE, SKIP JIKA MODULE USER SUDAH ADA DI M_USERMODULE
            $result2 = GetQuery(
            "insert into m_usermodule (kode_user,id_module) 
             SELECT '$USERNAME', a.id_module FROM m_module a WHERE NOT EXISTS (SELECT id_module FROM m_usermodule b WHERE a.id_module = b.id_module AND '$USERNAME' = b.kode_user)");


            //UPDATE M_USERMODULE SESUAI MODULE YG DICENTANG
            
            //MODULE 1 / Master User
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_muser_c',
                                     xread   = '$mod_muser_r',
                                     xupdate = '$mod_muser_u',
                                     xdelete = '$mod_muser_d'
                               where kode_user = '$KODE' and
                                     id_module = '1' ");

            //MODULE 2 / Master Grade
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mgrade_c',
                                     xread   = '$mod_mgrade_r',
                                     xupdate = '$mod_mgrade_u',
                                     xdelete = '$mod_mgrade_d'
                               where kode_user = '$KODE' and
                                     id_module = '2' ");

            //MODULE 3 / Master Perusahaan
            $M3 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mperusahaan_c',
                                     xread   = '$mod_mperusahaan_r',
                                     xupdate = '$mod_mperusahaan_u',
                                     xdelete = '$mod_mperusahaan_d'
                               where kode_user = '$KODE' and
                                     id_module = '3' ");

            //MODULE 4 / Master Departement
            $M4 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdept_c',
                                     xread   = '$mod_mdept_r',
                                     xupdate = '$mod_mdept_u',
                                     xdelete = '$mod_mdept_d'
                               where kode_user = '$KODE' and
                                     id_module = '4' ");

            //MODULE 5 / Master Divisi
            $M5 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdiv_c',
                                     xread   = '$mod_mdiv_r',
                                     xupdate = '$mod_mdiv_u',
                                     xdelete = '$mod_mdiv_d'
                               where kode_user = '$KODE' and
                                     id_module = '5' ");

            //MODULE 6 / Master Sub Divisi
            // $M6 = GetQuery(
            // "update m_usermodule set xcreate = '$mod_msubdiv_c',
            //                          xread   = '$mod_msubdiv_r',
            //                          xupdate = '$mod_msubdiv_u',
            //                          xdelete = '$mod_msubdiv_d'
            //                    where kode_user = '$KODE' and
            //                          id_module = '6' ");

            //MODULE 7 / Master Section
            $M7 = GetQuery(
            "update m_usermodule set xcreate = '$mod_msec_c',
                                     xread   = '$mod_msec_r',
                                     xupdate = '$mod_msec_u',
                                     xdelete = '$mod_msec_d'
                               where kode_user = '$KODE' and
                                     id_module = '7' ");

            //MODULE 8 / Master Sub Section
            $M8 = GetQuery(
            "update m_usermodule set xcreate = '$mod_msec_c',
                                     xread   = '$mod_msec_r',
                                     xupdate = '$mod_msec_u',
                                     xdelete = '$mod_msec_d'
                               where kode_user = '$KODE' and
                                     id_module = '8' ");

            //MODULE 9 / Master Team
            $M9 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mteam_c',
                                     xread   = '$mod_mteam_r',
                                     xupdate = '$mod_mteam_u',
                                     xdelete = '$mod_mteam_d'
                               where kode_user = '$KODE' and
                                     id_module = '9' ");

            //MODULE 10 / Master Unit
            $M10 = GetQuery(
            "update m_usermodule set xcreate = '$mod_munit_c',
                                     xread   = '$mod_munit_r',
                                     xupdate = '$mod_munit_u',
                                     xdelete = '$mod_munit_d'
                               where kode_user = '$KODE' and
                                     id_module = '10' ");

            //MODULE 11 / Master Jabatan
            $M11 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mjab_c',
                                     xread   = '$mod_mjab_r',
                                     xupdate = '$mod_mjab_u',
                                     xdelete = '$mod_mjab_d'
                               where kode_user = '$KODE' and
                                     id_module = '11' ");

            //MODULE 12 / Master Level
            $M12 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mlevel_c',
                                     xread   = '$mod_mlevel_r',
                                     xupdate = '$mod_mlevel_u',
                                     xdelete = '$mod_mlevel_d'
                               where kode_user = '$KODE' and
                                     id_module = '12' ");

            //MODULE 13 / PTK
            $M13 = GetQuery(
            "update m_usermodule set xcreate = '$mod_ptk_c',
                                     xread   = '$mod_ptk_r',
                                     xupdate = '$mod_ptk_u',
                                     xdelete = '$mod_ptk_d'
                               where kode_user = '$KODE' and
                                     id_module = '13' ");

            //MODULE 14 / Approval Manager
            $M14 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appmgr'
                               where kode_user = '$KODE' and
                                     id_module = '14' ");

            //MODULE 15 / Approval Director
            $M15 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appdir'
                               where kode_user = '$KODE' and
                                     id_module = '15' ");

            //MODULE 16 / Approval HRD
            $M16 = GetQuery(
            "update m_usermodule set xcreate = '$mod_apphrd'
                               where kode_user = '$KODE' and
                                     id_module = '16' ");

            //MODULE 17 / Approval MD
            $M17 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appmd'
                               where kode_user = '$KODE' and
                                     id_module = '17' ");

            //MODULE 18 / Pemenuhan PTK
            $M18 = GetQuery(
            "update m_usermodule set xcreate = '$mod_pemenuhanptk'
                               where kode_user = '$KODE' and
                                     id_module = '18' ");

            //MODULE 18 / Laporan PTK
            $M19 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanptk'
                               where kode_user = '$KODE' and
                                     id_module = '19' ");

            //MODULE 20 / Master Work Location
            $M20 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mworklocation_c',
                                     xread   = '$mod_mworklocation_r',
                                     xupdate = '$mod_mworklocation_u',
                                     xdelete = '$mod_mworklocation_d'
                               where kode_user = '$KODE' and
                                     id_module = '20' ");

            //MODULE 21 / Master Work Experience
            $M21 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mworkexp_c',
                                     xread   = '$mod_mworkexp_r',
                                     xupdate = '$mod_mworkexp_u',
                                     xdelete = '$mod_mworkexp_d'
                               where kode_user = '$KODE' and
                                     id_module = '21' ");

            //MODULE 22 / Master Jam Kerja
            $M22 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mjamkerja_c',
                                     xread   = '$mod_mjamkerja_r',
                                     xupdate = '$mod_mjamkerja_u',
                                     xdelete = '$mod_mjamkerja_d'
                               where kode_user = '$KODE' and
                                     id_module = '22' ");

            //MODULE 23 / Master Placement
            $M23 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mplacement_c',
                                     xread   = '$mod_mplacement_r',
                                     xupdate = '$mod_mplacement_u',
                                     xdelete = '$mod_mplacement_d'
                               where kode_user = '$KODE' and
                                     id_module = '23' ");

            //MODULE 24 / Master Type Salary
            $M24 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mtypesalary_c',
                                     xread   = '$mod_mtypesalary_r',
                                     xupdate = '$mod_mtypesalary_u',
                                     xdelete = '$mod_mtypesalary_d'
                               where kode_user = '$KODE' and
                                     id_module = '24' ");

            //MODULE 25 / Master Shift
            $M25 = GetQuery(
                  "update m_usermodule set xcreate = '$mod_mshift_c',
                                           xread   = '$mod_mshift_r',
                                           xupdate = '$mod_mshift_u',
                                           xdelete = '$mod_mshift_d'
                                     where kode_user = '$KODE' and
                                           id_module = '25' ");                         
        }

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit User - $USERNAME', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('User has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_user.php';</script><?php
        die(0);
    }
}


//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $USERNAME            = $_POST["USERNAME"];
    $NAMA                = $_POST["NAMA"];
    $PASSWORD            = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);
    $DEPARTEMENT         = $_POST["DEPARTEMENT"];
    $DIVISI              = $_POST["DIVISI"];
    $AKSES               = $_POST["AKSES"];
    $EMAIL               = $_POST["EMAIL"];
    $PTK_VIEW            = $_POST["PTK_VIEW"];

    $mod_muser_c         = isset($_POST["mod_muser_c"]) ? 1 : 0;
    $mod_muser_r         = isset($_POST["mod_muser_r"]) ? 1 : 0;
    $mod_muser_u         = isset($_POST["mod_muser_u"]) ? 1 : 0;
    $mod_muser_d         = isset($_POST["mod_muser_d"]) ? 1 : 0;

    $mod_mperusahaan_c   = isset($_POST["mod_mperusahaan_c"]) ? 1 : 0;
    $mod_mperusahaan_r   = isset($_POST["mod_mperusahaan_r"]) ? 1 : 0;
    $mod_mperusahaan_u   = isset($_POST["mod_mperusahaan_u"]) ? 1 : 0;
    $mod_mperusahaan_d   = isset($_POST["mod_mperusahaan_d"]) ? 1 : 0;

    $mod_mdept_c         = isset($_POST["mod_mdept_c"]) ? 1 : 0;
    $mod_mdept_r         = isset($_POST["mod_mdept_r"]) ? 1 : 0;
    $mod_mdept_u         = isset($_POST["mod_mdept_u"]) ? 1 : 0;
    $mod_mdept_d         = isset($_POST["mod_mdept_d"]) ? 1 : 0;

    $mod_mdiv_c          = isset($_POST["mod_mdiv_c"]) ? 1 : 0;
    $mod_mdiv_r          = isset($_POST["mod_mdiv_r"]) ? 1 : 0;
    $mod_mdiv_u          = isset($_POST["mod_mdiv_u"]) ? 1 : 0;
    $mod_mdiv_d          = isset($_POST["mod_mdiv_d"]) ? 1 : 0;

    // $mod_msubdiv_c    = isset($_POST["mod_msubdiv_c"]) ? 1 : 0;
    // $mod_msubdiv_r    = isset($_POST["mod_msubdiv_r"]) ? 1 : 0;
    // $mod_msubdiv_u    = isset($_POST["mod_msubdiv_u"]) ? 1 : 0;
    // $mod_msubdiv_d    = isset($_POST["mod_msubdiv_d"]) ? 1 : 0;

    $mod_msec_c          = isset($_POST["mod_msec_c"]) ? 1 : 0;
    $mod_msec_r          = isset($_POST["mod_msec_r"]) ? 1 : 0;
    $mod_msec_u          = isset($_POST["mod_msec_u"]) ? 1 : 0;
    $mod_msec_d          = isset($_POST["mod_msec_d"]) ? 1 : 0;

    $mod_msubsec_c       = isset($_POST["mod_msubsec_c"]) ? 1 : 0;
    $mod_msubsec_r       = isset($_POST["mod_msubsec_r"]) ? 1 : 0;
    $mod_msubsec_u       = isset($_POST["mod_msubsec_u"]) ? 1 : 0;
    $mod_msubsec_d       = isset($_POST["mod_msubsec_d"]) ? 1 : 0;

    $mod_mteam_c         = isset($_POST["mod_mteam_c"]) ? 1 : 0;
    $mod_mteam_r         = isset($_POST["mod_mteam_r"]) ? 1 : 0;
    $mod_mteam_u         = isset($_POST["mod_mteam_u"]) ? 1 : 0;
    $mod_mteam_d         = isset($_POST["mod_mteam_d"]) ? 1 : 0;

    $mod_munit_c         = isset($_POST["mod_munit_c"]) ? 1 : 0;
    $mod_munit_r         = isset($_POST["mod_munit_r"]) ? 1 : 0;
    $mod_munit_u         = isset($_POST["mod_munit_u"]) ? 1 : 0;
    $mod_munit_d         = isset($_POST["mod_munit_d"]) ? 1 : 0;

    $mod_mjab_c          = isset($_POST["mod_mjab_c"]) ? 1 : 0;
    $mod_mjab_r          = isset($_POST["mod_mjab_r"]) ? 1 : 0;
    $mod_mjab_u          = isset($_POST["mod_mjab_u"]) ? 1 : 0;
    $mod_mjab_d          = isset($_POST["mod_mjab_d"]) ? 1 : 0;

    $mod_mgrade_c        = isset($_POST["mod_mgrade_c"]) ? 1 : 0;
    $mod_mgrade_r        = isset($_POST["mod_mgrade_r"]) ? 1 : 0;
    $mod_mgrade_u        = isset($_POST["mod_mgrade_u"]) ? 1 : 0;
    $mod_mgrade_d        = isset($_POST["mod_mgrade_d"]) ? 1 : 0;

    $mod_mlevel_c        = isset($_POST["mod_mlevel_c"]) ? 1 : 0;
    $mod_mlevel_r        = isset($_POST["mod_mlevel_r"]) ? 1 : 0;
    $mod_mlevel_u        = isset($_POST["mod_mlevel_u"]) ? 1 : 0;
    $mod_mlevel_d        = isset($_POST["mod_mlevel_d"]) ? 1 : 0;

    $mod_ptk_c           = isset($_POST["mod_ptk_c"]) ? 1 : 0;
    $mod_ptk_r           = isset($_POST["mod_ptk_r"]) ? 1 : 0;
    $mod_ptk_u           = isset($_POST["mod_ptk_u"]) ? 1 : 0;
    $mod_ptk_d           = isset($_POST["mod_ptk_d"]) ? 1 : 0;

    $mod_appmgr          = isset($_POST["mod_appmgr"]) ? 1 : 0;
    $mod_appdir          = isset($_POST["mod_appdir"]) ? 1 : 0;
    $mod_apphrd          = isset($_POST["mod_apphrd"]) ? 1 : 0;
    $mod_appmd           = isset($_POST["mod_appmd"]) ? 1 : 0;
    $mod_pemenuhanptk    = isset($_POST["mod_pemenuhanptk"]) ? 1 : 0;
    $mod_laporanptk      = isset($_POST["mod_laporanptk"]) ? 1 : 0;

    $mod_mworklocation_c = isset($_POST["mod_mworklocation_c"]) ? 1 : 0;
    $mod_mworklocation_r = isset($_POST["mod_mworklocation_r"]) ? 1 : 0;
    $mod_mworklocation_u = isset($_POST["mod_mworklocation_u"]) ? 1 : 0;
    $mod_mworklocation_d = isset($_POST["mod_mworklocation_d"]) ? 1 : 0;

    $mod_mworkexp_c      = isset($_POST["mod_mworkexp_c"]) ? 1 : 0;
    $mod_mworkexp_r      = isset($_POST["mod_mworkexp_r"]) ? 1 : 0;
    $mod_mworkexp_u      = isset($_POST["mod_mworkexp_u"]) ? 1 : 0;
    $mod_mworkexp_d      = isset($_POST["mod_mworkexp_d"]) ? 1 : 0;

    $mod_mjamkerja_c     = isset($_POST["mod_mjamkerja_c"]) ? 1 : 0;
    $mod_mjamkerja_r     = isset($_POST["mod_mjamkerja_r"]) ? 1 : 0;
    $mod_mjamkerja_u     = isset($_POST["mod_mjamkerja_u"]) ? 1 : 0;
    $mod_mjamkerja_d     = isset($_POST["mod_mjamkerja_d"]) ? 1 : 0;

    $mod_mplacement_c    = isset($_POST["mod_mplacement_c"]) ? 1 : 0;
    $mod_mplacement_r    = isset($_POST["mod_mplacement_r"]) ? 1 : 0;
    $mod_mplacement_u    = isset($_POST["mod_mplacement_u"]) ? 1 : 0;
    $mod_mplacement_d    = isset($_POST["mod_mplacement_d"]) ? 1 : 0;

    $mod_mtypesalary_c   = isset($_POST["mod_mtypesalary_c"]) ? 1 : 0;
    $mod_mtypesalary_r   = isset($_POST["mod_mtypesalary_r"]) ? 1 : 0;
    $mod_mtypesalary_u   = isset($_POST["mod_mtypesalary_u"]) ? 1 : 0;
    $mod_mtypesalary_d   = isset($_POST["mod_mtypesalary_d"]) ? 1 : 0;

    $mod_mshift_c        = isset($_POST["mod_mshift_c"]) ? 1 : 0;
    $mod_mshift_r        = isset($_POST["mod_mshift_r"]) ? 1 : 0;
    $mod_mshift_u        = isset($_POST["mod_mshift_u"]) ? 1 : 0;
    $mod_mshift_d        = isset($_POST["mod_mshift_d"]) ? 1 : 0;

    //INSERT TO TABLE M_USER
    $result = GetQuery(
    "insert into m_user (kode_user,nama_user,password,kode_departement,kode_divisi,akses,email,ptk_view,created_by,created_date)     
                values ('$USERNAME','$NAMA','$PASSWORD','$DEPARTEMENT','$DIVISI','$AKSES','$EMAIL','$PTK_VIEW','$ID_USER1','$DINO')");

    if($result)
    {
        //INSERT TO TABLE M_USERMODULE SESUAI JUMLAH MODULE YG ADA DI TABLE M_MODULE
        $result2 = GetQuery(
        "insert into m_usermodule (kode_user,id_module) SELECT '$USERNAME', id_module FROM m_module");

        if($result2)
        {
            //UPDATE M_USERMODULE SESUAI MODULE YG DICENTANG
            
            //MODULE 1 / Master User
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_muser_c',
                                     xread   = '$mod_muser_r',
                                     xupdate = '$mod_muser_u',
                                     xdelete = '$mod_muser_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '1' ");

            //MODULE 2 / Master Grade
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mgrade_c',
                                     xread   = '$mod_mgrade_r',
                                     xupdate = '$mod_mgrade_u',
                                     xdelete = '$mod_mgrade_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '2' ");

            //MODULE 3 / Master Perusahaan
            $M3 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mperusahaan_c',
                                     xread   = '$mod_mperusahaan_r',
                                     xupdate = '$mod_mperusahaan_u',
                                     xdelete = '$mod_mperusahaan_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '3' ");

            //MODULE 4 / Master Departement
            $M4 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdept_c',
                                     xread   = '$mod_mdept_r',
                                     xupdate = '$mod_mdept_u',
                                     xdelete = '$mod_mdept_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '4' ");

            //MODULE 5 / Master Divisi
            $M5 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdiv_c',
                                     xread   = '$mod_mdiv_r',
                                     xupdate = '$mod_mdiv_u',
                                     xdelete = '$mod_mdiv_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '5' ");

            //MODULE 6 / Master Sub Divisi
            // $M6 = GetQuery(
            // "update m_usermodule set xcreate = '$mod_msubdiv_c',
            //                          xread   = '$mod_msubdiv_r',
            //                          xupdate = '$mod_msubdiv_u',
            //                          xdelete = '$mod_msubdiv_d'
            //                    where kode_user = '$USERNAME' and
            //                          id_module = '6' ");

            //MODULE 7 / Master Section
            $M7 = GetQuery(
            "update m_usermodule set xcreate = '$mod_msec_c',
                                     xread   = '$mod_msec_r',
                                     xupdate = '$mod_msec_u',
                                     xdelete = '$mod_msec_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '7' ");

            //MODULE 8 / Master Sub Section
            $M8 = GetQuery(
            "update m_usermodule set xcreate = '$mod_msec_c',
                                     xread   = '$mod_msec_r',
                                     xupdate = '$mod_msec_u',
                                     xdelete = '$mod_msec_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '8' ");

            //MODULE 9 / Master Team
            $M9 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mteam_c',
                                     xread   = '$mod_mteam_r',
                                     xupdate = '$mod_mteam_u',
                                     xdelete = '$mod_mteam_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '9' ");

            //MODULE 10 / Master Unit
            $M10 = GetQuery(
            "update m_usermodule set xcreate = '$mod_munit_c',
                                     xread   = '$mod_munit_r',
                                     xupdate = '$mod_munit_u',
                                     xdelete = '$mod_munit_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '10' ");

            //MODULE 11 / Master Jabatan
            $M11 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mjab_c',
                                     xread   = '$mod_mjab_r',
                                     xupdate = '$mod_mjab_u',
                                     xdelete = '$mod_mjab_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '11' ");

            //MODULE 12 / Master Level
            $M12 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mlevel_c',
                                     xread   = '$mod_mlevel_r',
                                     xupdate = '$mod_mlevel_u',
                                     xdelete = '$mod_mlevel_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '12' ");

            //MODULE 13 / Master PTK
            $M13 = GetQuery(
            "update m_usermodule set xcreate = '$mod_ptk_c',
                                     xread   = '$mod_ptk_r',
                                     xupdate = '$mod_ptk_u',
                                     xdelete = '$mod_ptk_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '13' ");

            //MODULE 14 / Approval Manager
            $M14 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appmgr'
                               where kode_user = '$USERNAME' and
                                     id_module = '14' ");

            //MODULE 15 / Approval Director
            $M15 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appdir'
                               where kode_user = '$USERNAME' and
                                     id_module = '15' ");

            //MODULE 16 / Approval HRD
            $M16 = GetQuery(
            "update m_usermodule set xcreate = '$mod_apphrd'
                               where kode_user = '$USERNAME' and
                                     id_module = '16' ");

            //MODULE 17 / Approval MD
            $M17 = GetQuery(
            "update m_usermodule set xcreate = '$mod_appmd'
                               where kode_user = '$USERNAME' and
                                     id_module = '17' ");

            //MODULE 18 / Pemenuhan PTK
            $M18 = GetQuery(
            "update m_usermodule set xcreate = '$mod_pemenuhanptk'
                               where kode_user = '$USERNAME' and
                                     id_module = '18' ");

            //MODULE 19 / Laporan PTK
            $M19 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanptk'
                               where kode_user = '$USERNAME' and
                                     id_module = '19' ");

            //MODULE 20 / Master Work Location
            $M20 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mworklocation_c',
                                     xread   = '$mod_mworklocation_r',
                                     xupdate = '$mod_mworklocation_u',
                                     xdelete = '$mod_mworklocation_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '20' ");

            //MODULE 21 / Master Work Experience
            $M21 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mworkexp_c',
                                     xread   = '$mod_mworkexp_r',
                                     xupdate = '$mod_mworkexp_u',
                                     xdelete = '$mod_mworkexp_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '21' ");

            //MODULE 22 / Master Jam Kerja
            $M22 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mjamkerja_c',
                                     xread   = '$mod_mjamkerja_r',
                                     xupdate = '$mod_mjamkerja_u',
                                     xdelete = '$mod_mjamkerja_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '22' ");

            //MODULE 23 / Master Placement
            $M23 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mplacement_c',
                                     xread   = '$mod_mplacement_r',
                                     xupdate = '$mod_mplacement_u',
                                     xdelete = '$mod_mplacement_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '23' ");

            //MODULE 24 / Master Type Salary
            $M24 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mtypesalary_c',
                                     xread   = '$mod_mtypesalary_r',
                                     xupdate = '$mod_mtypesalary_u',
                                     xdelete = '$mod_mtypesalary_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '24' ");

            //MODULE 25 / Master Shift
            $M25 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mshift_c',
                                     xread   = '$mod_mshift_r',
                                     xupdate = '$mod_mshift_u',
                                     xdelete = '$mod_mshift_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '25' ");                         
        }
        else
        {
            ?><script>alert('Failed to assign module! Try again ');</script><?php
            ?><script>document.location.href='m_user';</script><?php
            die(0);
        }

        // INSERT TO TABLE USERS_LOG
        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Master User - $USERNAME', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

        ?><script>alert('User has been added! Thank you! ');</script><?php
        ?><script>document.location.href='m_user';</script><?php
        die(0);       
    }
    else
    {
        ?><script>alert('Failed to add user! Try again ');</script><?php
        ?><script>document.location.href='m_user';</script><?php
        die(0);
    }

}
?>
