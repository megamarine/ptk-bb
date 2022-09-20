<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DINO = date('Y-m-d H:i:s');

if(isset($_GET["seq"]))
{
    $DATE       = date("Y-m-d");
    $seq        = $_GET["seq"];
    $ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
    $NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
    $IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];

    $result = $db1->prepare("update t_ptk set app_hrd = '1', app_hrd_date = '$DATE' where seq = '$seq'");
    $result->execute();
    $mail_subject ="PTK Online - HRD Manager Approval for " . $seq;

    if($result)
    {     
            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Approved - $seq', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','Approval HRD Manager'");

        // KIRIM EMAIL
        $result = $db1->prepare("select  a.*,
                                         date_format(a.date_needed, '%d %b %Y') as date_needed,
                                         b.nama_departement,
                                         c.nama_divisi,
                                         e.nama_section,
                                         f.nama_subsection,
                                         g.nama_team,
                                         h.nama_unit,
                                         j.nama_level,
                                         k.nama as work_location,
                                         l.nama_grade,
                                         l.ket_grade,
                                         m.basedsalary_name as based_salary,
                                         CASE 
                                              WHEN a.app_mgr = 0 THEN 'Waiting'
                                              WHEN a.app_mgr = 1 THEN 'Approved'
                                              ELSE 'Rejected'
                                         END AS status_app_mgr,
                                          CASE 
                                              WHEN a.app_dir = 0 THEN 'Waiting'
                                              WHEN a.app_dir = 1 THEN 'Approved'
                                              ELSE 'Rejected'
                                         END AS status_app_dir,
                                          CASE 
                                              WHEN a.app_hrd = 0 THEN 'Waiting'
                                              WHEN a.app_hrd = 1 THEN 'Approved'
                                              ELSE 'Rejected'
                                         END AS status_app_hrd,
                                          CASE 
                                              WHEN a.app_md = 0 THEN 'Waiting'
                                              WHEN a.app_md = 1 THEN 'Approved'
                                              ELSE 'Rejected'
                                         END AS status_app_md
                                    from t_ptk a
                                    left join m_departement b ON a.kode_departement = b.kode_departement
                                    left join m_divisi c ON a.kode_divisi = c.kode_divisi
                                    left join m_section e ON a.kode_section = e.kode_section
                                    left join m_subsection f ON a.kode_subsection = f.kode_subsection
                                    left join m_team g ON a.kode_team = g.kode_team
                                    left join m_unit h ON a.kode_unit = h.kode_unit
                                    left join m_level j ON a.kode_level = j.kode_level
                                    left join m_worklocation k ON a.work_location = k.seq
                                    left join m_grade l ON a.kode_grade = l.kode_grade
                                    left join m_basedsalary m ON a.based_salary = m.basedsalary_code
                                   where a.seq = '$seq'");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $SEQ              = $row["seq"];
            $NAMA_DEPARTEMENT = $row["nama_departement"];
            $KODE_DEPARTEMENT = $row["kode_departement"];
            $KODE_DIVISI      = $row["kode_divisi"];
            $NAMA_DIVISI      = $row["nama_divisi"];
            $NAMA_SECTION     = $row["nama_section"];
            $NAMA_SUBSECTION  = $row["nama_subsection"];
            $NAMA_TEAM        = $row["nama_team"];
            $NAMA_UNIT        = $row["nama_unit"];
            $NAMA_LEVEL       = $row["nama_level"];
            $NAME_GRADE       = $row["nama_grade"];
            $KET_GRADE        = $row["ket_grade"];
            $TYPE_PTK         = $row["type_ptk"];
            // $TYPE_CONTRACT    = $row["type_contract"];
            $DATE_NEEDED      = $row["date_needed"];
            $QTY_SUBMITION    = $row["qty_submition"];
            $BASED_SALARY     = $row["based_salary"];
            $WORK_LOCATION    = $row["work_location"];
            $EMPLOYEE_REMARK  = $row["employee_remark"];
            $KRITERIA         = $row["kriteria"];
            $JOBDESC          = $row["jobdesc"];
            $SAPP_MGR         = $row["status_app_mgr"];
            $SAPP_DIR         = $row["status_app_dir"];
            $SAPP_HRD         = $row["status_app_hrd"];
            $SAPP_MD          = $row["status_app_md"];
        }

        // EMAIL DIR
        $query = $db1->prepare("select a.email,
                                       a.nama_user,
                                       b.head
                                  from m_user a
                                  join m_departement b ON a.kode_user = b.head
                                 where b.kode_departement = '$KODE_DEPARTEMENT' and a.status='aktif'");
        $query->execute();
        while ($row_query = $query->fetch(PDO::FETCH_ASSOC))
        {
            $EMAIL_DIR = $row_query["email"];
        }

        //EMAIL MGR 
        $query2 = $db1->prepare("select a.email,
                                        a.nama_user,
                                        b.head
                                   from m_user a
                                   join m_divisi b ON a.kode_user = b.head
                                  where b.kode_divisi = '$KODE_DIVISI' and a.status='aktif'");
        $query2->execute();
        while ($row_query2 = $query2->fetch(PDO::FETCH_ASSOC))
        {
            $EMAIL_MGR = $row_query2["email"];
        }

        // EMAIL HRD
        $query3 = $db1->prepare("select email from m_user where kode_departement = '05' and akses = 'manager' and status='aktif'");
        $query3->execute();
        while ($row_query3 = $query3->fetch(PDO::FETCH_ASSOC))
        {
            $EMAIL_HRD = $row_query3["email"];
        }

        // EMAIL MD
        $query4 = $db1->prepare("select email from m_user where akses = 'MD' and status='aktif'");
        $query4->execute();
        while ($row_query4 = $query4->fetch(PDO::FETCH_ASSOC))
        {
            $EMAIL_MD = $row_query4["email"];
        }

        require 'assets/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSendmail();
        set_time_limit(120); // set the time limit to 120 seconds

        $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
        $mail->addAddress($EMAIL_MD);
        $mail->addCC($EMAIL_MGR);
        $mail->addCC($EMAIL_DIR);
        $mail->addCC($EMAIL_HRD);
        $mail->Subject = $mail_subject;
        $mail->msgHTML("<h4> Dear Managing Director,</h4>
                        <p>This is auto generate email from PTK Online System that asking approval for below employee request :</p>
                        <table style='border-collapse:collapse'>
                        <tr>
                            <td>
                                &bull; Nomor PTK
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $SEQ
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Department
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_DEPARTEMENT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Divisi
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_DIVISI
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Section
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_SECTION
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Sub Section
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_SUBSECTION
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Team
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_TEAM
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Unit
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_UNIT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Level
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAMA_LEVEL
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Grade
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $NAME_GRADE $KET_GRADE
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Jumlah Permintaan
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $QTY_SUBMITION
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Tanggal Dibutuhkan
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $DATE_NEEDED
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Basis Penggajian
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $BASED_SALARY
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Type PTK
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $TYPE_PTK
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Lokasi Kerja
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $WORK_LOCATION
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &bull; Identitas Penggantian Karyawan
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $EMPLOYEE_REMARK
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                &bull; Kriteria
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $KRITERIA
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                &bull; Jobdesc
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $JOBDESC
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <u>Status Approval</u>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Manager
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $SAPP_MGR
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Director
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $SAPP_DIR
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Manager HRD
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $SAPP_HRD
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Managing Director
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                $SAPP_MD
                            </td>
                        </tr>
                        </table>
                        <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
                        Regards, <br>
                        Recruitment Team <br>
                        PT. Baramuda Bahari");
        if($mail->send())
        { 
            echo "Message has been"; 
        }
        else
        { 
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
    ?><script>document.location.href='ptk';</script><?php
    die(0);
}
?>