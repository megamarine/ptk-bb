<?php 
require_once("module/model/koneksi/koneksi.php");
if(!isset($_SESSION["LOGINIDUS_PERSONALIA"]))
{   
    session_destroy();
    header("Location: index.php");
    die(0);
}

if(isset($_POST["seq"]))
{
    $result2 = $db1->prepare("select a.qty_submition,
                                             a.qty_accepted, 
                                             b.email,
                                             b.nama_user as nama
                                      from t_ptk a
                                      LEFT JOIN m_user b ON a.created_by = b.kode_user
                                     where a.seq = '$seq'");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
            {
                $submition  = $row2["qty_submition"];
                $accepted   = $row2["qty_accepted"];
                $email_user = $row2["email"];
                $nama       = $row2["nama"];
            }
            if($submition == $accepted)
            {
                // send email
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
                                                 l.ket_grade
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
                    $TYPE_CONTRACT    = $row["type_contract"];
                    $DATE_NEEDED      = $row["date_needed"];
                    $QTY_SUBMITION    = $row["qty_submition"];
                    $BASED_SALARY     = $row["based_salary"];
                    $WORK_LOCATION    = $row["work_location"];
                    $EMPLOYEE_REMARK  = $row["employee_remark"];
                    $KRITERIA         = $row["kriteria"];
                    $JOBDESC          = $row["jobdesc"];
                }
                require 'assets/phpmailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->isSendmail();
                set_time_limit(120); // set the time limit to 120 seconds

                $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
                $mail->addAddress($email_user);
                $mail->Subject = "PTK Online - Request Complete " . $seq;
                
                $mail->msgHTML("<h4> Dear $nama,</h4>
                <p>This is auto generate email from PTK Online System to inform that your employee request for :</p>
                <table style='border-collapse:collapse'>
                <tr>
                    <td>
                        &bull; Nomor PTK
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        $seq
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
                        &bull; Type Kontrak
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        $TYPE_CONTRACT
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
                <br><b> Has been fullfilled and complete.</b>
                </table>
                <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
                Regards, <br>
                Recruitment Team <br>
                PT. Mega Marine Pride");
                
                if($mail->send())
                { 
                    echo json_encode(array("success" => true, "message" => "Data Has Been Update & Email Sended", "seq" => $seq));
                    die(0);
                }
                else
                { 
                    echo json_encode(array("success" => true, "message" => "Data Has Been Update & Email not Sended", "seq" => $seq));
                    die(0);
                }
            }
}

?>