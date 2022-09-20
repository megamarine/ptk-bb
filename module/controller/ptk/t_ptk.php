<?php
$T                       = date("Ym");
$DATE                    = date("Y-m-d");
$DINO                    = date('Y-m-d H:i:s');
$ID_USER1                = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$NAMA_USER               = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
$IP_ADDRESS              = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME                 = $_SESSION["PC_NAME_PERSONALIA_BB"];
$SEQ                     = createKode("t_ptk","seq", "PTK-$T-",4);

$DEPARTEMENT             = "";
$DIVISI                  = "";
$SECTION                 = "";
$SUBSECTION              = "";
$TEAM                    = "";
$UNIT                    = "";
$GRADE                   = "";
$LEVEL                   = "";

$TYPE_PTK                = "";
$SO_NUMBER               = "";
$FILE                    = "";
$EDUCATION               = "";
$MAJOR                   = "";
$WORK_EXPERIENCE         = "";
$QTY_SUBMITION           = "";
$DATE_NEEDED             = "";
$PLACEMENT               = "";
$BASED_SALARY            = "";
$TYPE_SALARY             = "";
// $TYPE_CONTRACT           = "";
$TYPE_WORKER             = "";
$WORK_LOCATION           = "";
$TYPE_APD                = "";
$TYPE_MCU                = "";
$ITFAC_PC                = "";
$inpITFAC_PC             = "";
$ITFAC_LAPTOP            = "";
$inpITFAC_LAPTOP         = "";
$ITFAC_EMAIL             = "";
$inpITFAC_EMAIL          = "";
$ITFAC_EXTDISK           = "";
$inpITFAC_EXTDISK        = "";
$ITFAC_CCTV_ACCESS       = "";
$inpITFAC_CCTV_ACCESS    = "";
$ITFAC_FINGER_ACCESS     = "";
$inpITFAC_FINGER_ACCESS  = "";
$ITFAC_GPS_ACCESS        = "";
$inpITFAC_GPS_ACCESS     = "";
$ITFAC_FACEREC_ACCESS    = "";
$inpITFAC_FACEREC_ACCESS = "";
$ITFAC_VPN               = "";
$inpITFAC_VPN            = "";
$ITFAC_WIFI              = "";
$inpITFAC_WIFI           = "";
$ITFAC_FILESERV          = "";
$inpITFAC_FILESERV       = "";
$ITFAC_MOBILEPHONE       = "";
$inpITFAC_MOBILEPHONE    = "";
$ITFAC_ACTS              = "";
$inpITFAC_ACTS           = "";
$ITFAC_HRMS              = "";
$inpITFAC_HRMS           = "";
$ITFAC_CAS               = "";
$inpITFAC_CAS            = "";
$ITFAC_WEBBC             = "";
$inpITFAC_WEBBC          = "";
$ITFAC_TPB               = "";
$inpITFAC_TPB            = "";
$ITFAC_PTK               = "";
$inpITFAC_PTK            = "";
$ITFAC_SHIPMENT          = "";
$inpITFAC_SHIPMENT       = "";
$ITFAC_TICKETING         = "";
$inpITFAC_TICKETING      = "";
$ITFAC_SPEC              = "";
$inpITFAC_SPEC           = "";
$ITFAC_RECRUITMENT       = "";
$inpITFAC_RECRUITMENT    = "";
$ITFAC_VMS               = "";
$inpITFAC_VMS            = "";
$HARI_KERJA              = "";
$JAM_KERJA               = array();
$EMPLOYEE_REMARK         = "";
$KRITERIA                = "";
$JOBDESC                 = "";

//EDIT PTK /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["seq"]))
{
    $SEQ    = $_GET["seq"];
    $result = GetQuery("select * from t_ptk where seq = '$SEQ'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $DEPARTEMENT             = $row["kode_departement"];
        $DIVISI                  = $row["kode_divisi"];
        $SECTION                 = $row["kode_section"];
        $SUBSECTION              = $row["kode_subsection"];
        $TEAM                    = $row["kode_team"];
        $UNIT                    = $row["kode_unit"];
        $GRADE                   = $row["kode_grade"];
        $LEVEL                   = $row["kode_level"];

        $TYPE_PTK                = $row["type_ptk"];
        $SO_NUMBER               = $row["so_number"];
        $FILE                    = $row["file"];
        $EDUCATION               = $row["education"];
        $MAJOR                   = $row["major"];
        $WORK_EXPERIENCE         = $row["work_experience"];
        $QTY_SUBMITION           = $row["qty_submition"];
        $QTY_ACCEPTED            = $row["qty_accepted"];
        $DATE_NEEDED             = $row["date_needed"];
        $PLACEMENT               = $row["placement"];
        $BASED_SALARY            = $row["based_salary"];
        $TYPE_SALARY             = $row["type_salary"];
        // $TYPE_CONTRACT           = $row["type_contract"];
        $TYPE_WORKER             = $row["type_worker"];
        $WORK_LOCATION           = $row["work_location"];
        $TYPE_APD                = $row["type_apd"];
        $TYPE_MCU                = $row["type_mcu"];
        $ITFAC_PC                = $row["itfac_pc"];
        $inpITFAC_PC             = $row["inpitfac_pc"];
        $ITFAC_LAPTOP            = $row["itfac_laptop"];
        $inpITFAC_LAPTOP         = $row["inpitfac_laptop"];
        $ITFAC_EMAIL             = $row["itfac_email"];
        $inpITFAC_EMAIL          = $row["inpitfac_email"];
        $ITFAC_EXTDISK           = $row["itfac_extdisk"];
        $inpITFAC_EXTDISK        = $row["inpitfac_extdisk"];
        $ITFAC_CCTV_ACCESS       = $row["itfac_cctv_access"];
        $inpITFAC_CCTV_ACCESS    = $row["inpitfac_cctv_access"];
        $ITFAC_FINGER_ACCESS     = $row["itfac_finger_access"];
        $inpITFAC_FINGER_ACCESS  = $row["inpitfac_finger_access"];
        $ITFAC_GPS_ACCESS        = $row["itfac_gps_access"];
        $inpITFAC_GPS_ACCESS     = $row["inpitfac_gps_access"];
        $ITFAC_FACEREC_ACCESS    = $row["itfac_facerec_access"];
        $inpITFAC_FACEREC_ACCESS = $row["inpitfac_facerec_access"];
        $ITFAC_VPN               = $row["itfac_vpn"];
        $inpITFAC_VPN            = $row["inpitfac_vpn"];
        $ITFAC_WIFI              = $row["itfac_wifi"];
        $inpITFAC_WIFI           = $row["inpitfac_wifi"];
        $ITFAC_FILESERV          = $row["itfac_fileserv"];
        $inpITFAC_FILESERV       = $row["inpitfac_fileserv"];
        $ITFAC_MOBILEPHONE       = $row["itfac_mobilephone"];
        $inpITFAC_MOBILEPHONE    = $row["inpitfac_mobilephone"];
        $ITFAC_ACTS              = $row["itfac_acts"];
        $inpITFAC_ACTS           = $row["inpitfac_acts"];
        $ITFAC_HRMS              = $row["itfac_hrms"];
        $inpITFAC_HRMS           = $row["inpitfac_hrms"];
        $ITFAC_CAS               = $row["itfac_cas"];
        $inpITFAC_CAS            = $row["inpitfac_cas"];
        $ITFAC_WEBBC             = $row["itfac_webbc"];
        $inpITFAC_WEBBC          = $row["inpitfac_webbc"];
        $ITFAC_TPB               = $row["itfac_tpb"];
        $inpITFAC_TPB            = $row["inpitfac_tpb"];
        $ITFAC_PTK               = $row["itfac_ptk"];
        $inpITFAC_PTK            = $row["inpitfac_ptk"];
        $ITFAC_SHIPMENT          = $row["itfac_shipment"];
        $inpITFAC_SHIPMENT       = $row["inpitfac_shipment"];
        $ITFAC_TICKETING         = $row["itfac_ticketing"];
        $inpITFAC_TICKETING      = $row["inpitfac_ticketing"];
        $ITFAC_SPEC              = $row["itfac_spec"];
        $inpITFAC_SPEC           = $row["inpitfac_spec"];
        $ITFAC_RECRUITMENT       = $row["itfac_recruitment"];
        $inpITFAC_RECRUITMENT    = $row["inpitfac_recruitment"];
        $ITFAC_VMS               = $row["itfac_vms"];
        $inpITFAC_VMS            = $row["inpitfac_vms"];
        $HARI_KERJA              = $row["hari_kerja"];
        $JAM_KERJA               = explode(",", $row["jam_kerja"]);
        $EMPLOYEE_REMARK         = $row["employee_remark"];
        $KRITERIA                = $row["kriteria"];
        $JOBDESC                 = $row["jobdesc"];
    }

    if(isset($_POST["simpan"]))
    {
        //cek apakah variable ada isinya?
        if($_FILES["FILE"]["tmp_name"] != "")
        {
            $FILE_EXT  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
            // Create Directory sesuai KODE PTK
            if (!file_exists("file/".$SEQ)) 
            {
                if(mkdir("file/".$SEQ, 0755, true))
                {
                echo('<br> success create directory code : '.$SEQ);
                }
                else
                {
                echo('<br> directory already exist : '.$SEQ);
                exit();
                }
            }

            //nama
            $KODE_HISTORY = kodeAuto("t_ptk_history","urut");
            $FILE = "file/".$SEQ."/".$SEQ." ".$KODE_HISTORY.".".$FILE_EXT;
            //upload
            move_uploaded_file($_FILES["FILE"]["tmp_name"],$FILE);
        }
        else
        {
            echo "No file(s) uploaded.";
        }
    
        $DEPARTEMENT             = $_POST["DEPARTEMENT"];
        $DIVISI                  = $_POST["DIVISI"];
        $SECTION                 = $_POST["SECTION"];
        $SUBSECTION              = $_POST["SUBSECTION"];
        $TEAM                    = $_POST["TEAM"];
        $UNIT                    = $_POST["UNIT"];
        $GRADE                   = $_POST["GRADE"];
        $LEVEL                   = $_POST["LEVEL"];

        $TYPE_PTK                = $_POST["TYPE_PTK"];
        $SO_NUMBER               = isset($_POST["SO_NUMBER"]) ? str_replace("'","\'",$_POST["SO_NUMBER"]) : null;
        $EDUCATION               = $_POST["EDUCATION"];
        $MAJOR                   = str_replace("'","\'",$_POST["MAJOR"]);
        $WORK_EXPERIENCE         = str_replace("'","\'",$_POST["WORK_EXPERIENCE"]);
        $QTY_SUBMITION           = $_POST["QTY_SUBMITION"];
        $QTY_LEFT                = $QTY_SUBMITION - $QTY_ACCEPTED;
        $DATE_NEEDED             = $_POST["DATE_NEEDED"];
        $PLACEMENT               = $_POST["PLACEMENT"];
        $BASED_SALARY            = $_POST["BASED_SALARY"];
        $TYPE_SALARY             = $_POST["TYPE_SALARY"];
        // $TYPE_CONTRACT           = $_POST["TYPE_CONTRACT"];
        $TYPE_WORKER             = $_POST["TYPE_WORKER"];
        $WORK_LOCATION           = $_POST["WORK_LOCATION"];
        $TYPE_APD                = $_POST["TYPE_APD"];
        $TYPE_MCU                = $_POST["TYPE_MCU"];
        $ITFAC_PC                = isset($_POST["ITFAC_PC"]) ? 1 : 0;
        $inpITFAC_PC             = str_replace("'","\'",$_POST["inpITFAC_PC"]);
        $ITFAC_LAPTOP            = isset($_POST["ITFAC_LAPTOP"]) ? 1 : 0;
        $inpITFAC_LAPTOP         = str_replace("'","\'",$_POST["inpITFAC_LAPTOP"]);
        $ITFAC_EMAIL             = isset($_POST["ITFAC_EMAIL"]) ? 1 : 0;
        $inpITFAC_EMAIL          = str_replace("'","\'",$_POST["inpITFAC_EMAIL"]);
        $ITFAC_EXTDISK           = isset($_POST["ITFAC_EXTDISK"]) ? 1 : 0;
        $inpITFAC_EXTDISK        = str_replace("'","\'",$_POST["inpITFAC_EXTDISK"]);
        $ITFAC_CCTV_ACCESS       = isset($_POST["ITFAC_CCTV_ACCESS"]) ? 1 : 0;
        $inpITFAC_CCTV_ACCESS    = str_replace("'","\'",$_POST["inpITFAC_CCTV_ACCESS"]);
        $ITFAC_FINGER_ACCESS     = isset($_POST["ITFAC_FINGER_ACCESS"]) ? 1 : 0;
        $inpITFAC_FINGER_ACCESS  = str_replace("'","\'",$_POST["inpITFAC_FINGER_ACCESS"]);
        $ITFAC_GPS_ACCESS        = isset($_POST["ITFAC_GPS_ACCESS"]) ? 1 : 0;
        $inpITFAC_GPS_ACCESS     = str_replace("'","\'",$_POST["inpITFAC_GPS_ACCESS"]);
        $ITFAC_FACEREC_ACCESS    = isset($_POST["ITFAC_FACEREC_ACCESS"]) ? 1 : 0;
        $inpITFAC_FACEREC_ACCESS = str_replace("'","\'",$_POST["inpITFAC_FACEREC_ACCESS"]);
        $ITFAC_VPN               = isset($_POST["ITFAC_VPN"]) ? 1 : 0;
        $inpITFAC_VPN            = str_replace("'","\'",$_POST["inpITFAC_VPN"]);
        $ITFAC_WIFI              = isset($_POST["ITFAC_WIFI"]) ? 1 : 0;
        $inpITFAC_WIFI           = str_replace("'","\'",$_POST["inpITFAC_WIFI"]);
        $ITFAC_FILESERV          = isset($_POST["ITFAC_FILESERV"]) ? 1 : 0;
        $inpITFAC_FILESERV       = str_replace("'","\'",$_POST["inpITFAC_FILESERV"]);
        $ITFAC_MOBILEPHONE       = isset($_POST["ITFAC_MOBILEPHONE"]) ? 1 : 0;
        $inpITFAC_MOBILEPHONE    = str_replace("'","\'",$_POST["inpITFAC_MOBILEPHONE"]);
        $ITFAC_ACTS              = isset($_POST["ITFAC_ACTS"]) ? 1 : 0;
        $inpITFAC_ACTS           = str_replace("'","\'",$_POST["inpITFAC_ACTS"]);
        $ITFAC_HRMS              = isset($_POST["ITFAC_HRMS"]) ? 1 : 0;
        $inpITFAC_HRMS           = str_replace("'","\'",$_POST["inpITFAC_HRMS"]);
        $ITFAC_CAS               = isset($_POST["ITFAC_CAS"]) ? 1 : 0;
        $inpITFAC_CAS            = str_replace("'","\'",$_POST["inpITFAC_CAS"]);
        $ITFAC_WEBBC             = isset($_POST["ITFAC_WEBBC"]) ? 1 : 0;
        $inpITFAC_WEBBC          = str_replace("'","\'",$_POST["inpITFAC_WEBBC"]);
        $ITFAC_TPB               = isset($_POST["ITFAC_TPB"]) ? 1 : 0;
        $inpITFAC_TPB            = str_replace("'","\'",$_POST["inpITFAC_TPB"]);
        $ITFAC_PTK               = isset($_POST["ITFAC_PTK"]) ? 1 : 0;
        $inpITFAC_PTK            = str_replace("'","\'",$_POST["inpITFAC_PTK"]);
        $ITFAC_SHIPMENT          = isset($_POST["ITFAC_SHIPMENT"]) ? 1 : 0;
        $inpITFAC_SHIPMENT       = str_replace("'","\'",$_POST["inpITFAC_SHIPMENT"]);
        $ITFAC_TICKETING         = isset($_POST["ITFAC_TICKETING"]) ? 1 : 0;
        $inpITFAC_TICKETING      = str_replace("'","\'",$_POST["inpITFAC_TICKETING"]);
        $ITFAC_SPEC              = isset($_POST["ITFAC_SPEC"]) ? 1 : 0;
        $inpITFAC_SPEC           = str_replace("'","\'",$_POST["inpITFAC_SPEC"]);
        $ITFAC_RECRUITMENT       = isset($_POST["ITFAC_RECRUITMENT"]) ? 1 : 0;
        $inpITFAC_RECRUITMENT    = str_replace("'","\'",$_POST["inpITFAC_RECRUITMENT"]);
        $ITFAC_VMS               = isset($_POST["ITFAC_VMS"]) ? 1 : 0;
        $inpITFAC_VMS            = str_replace("'","\'",$_POST["inpITFAC_VMS"]);
        $HARI_KERJA              = $_POST["HARI_KERJA"];
        $JAM_KERJA               = implode(",",$_POST["JAM_KERJA"]);
        $EMPLOYEE_REMARK         = str_replace("'","\'",$_POST['EMPLOYEE_REMARK']);
        $KRITERIA                = str_replace("'","\'",$_POST['KRITERIA']);
        $JOBDESC                 = str_replace("'","\'",$_POST['JOBDESC']);

        //UPDATE DATA T_PTK
        $query = UpdateData(
        "t_ptk",
        "kode_departement        = '$DEPARTEMENT',
         kode_divisi             = '$DIVISI',
         kode_section            = '$SECTION',
         kode_subsection         = '$SUBSECTION',
         kode_team               = '$TEAM',
         kode_unit               = '$UNIT',
         kode_grade              = '$GRADE',
         kode_level              = '$LEVEL',
         type_ptk                = '$TYPE_PTK',
         so_number               = '$SO_NUMBER',
         file                    = '$FILE',
         education               = '$EDUCATION',
         major                   = '$MAJOR',
         work_experience         = '$WORK_EXPERIENCE',
         qty_submition           = '$QTY_SUBMITION',
         qty_left                = '$QTY_LEFT',
         date_needed             = '$DATE_NEEDED',
         placement               = '$PLACEMENT',
         based_salary            = '$BASED_SALARY',
         type_salary             = '$TYPE_SALARY',
         type_worker             = '$TYPE_WORKER',
         work_location           = '$WORK_LOCATION',
         type_apd                = '$TYPE_APD',
         type_mcu                = '$TYPE_MCU',
         itfac_pc                = '$ITFAC_PC',
         itfac_laptop            = '$ITFAC_LAPTOP',
         itfac_email             = '$ITFAC_EMAIL',
         itfac_extdisk           = '$ITFAC_EXTDISK',
         itfac_cctv_access       = '$ITFAC_CCTV_ACCESS',
         itfac_finger_access     = '$ITFAC_FINGER_ACCESS',
         itfac_gps_access        = '$ITFAC_GPS_ACCESS',
         itfac_facerec_access    = '$ITFAC_FACEREC_ACCESS',
         itfac_vpn               = '$ITFAC_VPN',
         itfac_wifi              = '$ITFAC_WIFI',
         itfac_fileserv          = '$ITFAC_FILESERV',
         itfac_mobilephone       = '$ITFAC_MOBILEPHONE',
         itfac_acts              = '$ITFAC_ACTS',
         itfac_hrms              = '$ITFAC_HRMS',
         itfac_cas               = '$ITFAC_CAS',
         itfac_webbc             = '$ITFAC_WEBBC',
         itfac_tpb               = '$ITFAC_WEBBC',
         itfac_ptk               = '$ITFAC_PTK',
         itfac_shipment          = '$ITFAC_SHIPMENT',
         itfac_ticketing         = '$ITFAC_TICKETING',
         itfac_spec              = '$ITFAC_SPEC',
         itfac_recruitment       = '$ITFAC_RECRUITMENT',
         itfac_vms               = '$ITFAC_VMS',
         inpitfac_pc             = '$inpITFAC_PC',
         inpitfac_laptop         = '$inpITFAC_LAPTOP',
         inpitfac_email          = '$inpITFAC_EMAIL',
         inpitfac_extdisk        = '$inpITFAC_EXTDISK',
         inpitfac_cctv_access    = '$inpITFAC_CCTV_ACCESS',
         inpitfac_finger_access  = '$inpITFAC_FINGER_ACCESS',
         inpitfac_gps_access     = '$inpITFAC_GPS_ACCESS',
         inpitfac_facerec_access = '$inpITFAC_FACEREC_ACCESS',
         inpitfac_vpn            = '$inpITFAC_VPN',
         inpitfac_wifi           = '$inpITFAC_WIFI',
         inpitfac_fileserv       = '$inpITFAC_FILESERV',
         inpitfac_mobilephone    = '$inpITFAC_MOBILEPHONE',
         inpitfac_acts           = '$inpITFAC_ACTS',
         inpitfac_hrms           = '$inpITFAC_HRMS',
         inpitfac_cas            = '$inpITFAC_CAS',
         inpitfac_webbc          = '$inpITFAC_WEBBC',
         inpitfac_tpb            = '$inpITFAC_WEBBC',
         inpitfac_ptk            = '$inpITFAC_PTK',
         inpitfac_shipment       = '$inpITFAC_SHIPMENT',
         inpitfac_ticketing      = '$inpITFAC_TICKETING',
         inpitfac_spec           = '$inpITFAC_SPEC',
         inpitfac_recruitment    = '$inpITFAC_RECRUITMENT',
         inpitfac_vms            = '$inpITFAC_VMS',
         hari_kerja              = '$HARI_KERJA',
         jam_kerja               = '$JAM_KERJA',
         employee_remark         = '$EMPLOYEE_REMARK',
         kriteria                = '$KRITERIA',
         jobdesc                 = '$JOBDESC',
         modified_date           = '$DINO',
         modified_by             = '$ID_USER1'",
        "seq = '$SEQ'");

        if($query)
        {
            //INSERT INTO T_PTK_HISTORY
            InsertData(
            "t_ptk_history",
            "urut, seq, kode_departement, kode_divisi, kode_section, kode_subsection, kode_team, kode_unit, kode_grade, kode_level, type_ptk, so_number, file, education, major, work_experience, qty_submition, date_needed, placement, based_salary, type_salary, type_worker, work_location, type_apd, type_mcu, itfac_pc, inpitfac_pc, itfac_laptop, inpitfac_laptop, itfac_email, inpitfac_email, itfac_extdisk, inpitfac_extdisk, itfac_cctv_access, inpitfac_cctv_access, itfac_finger_access, inpitfac_finger_access, itfac_gps_access, inpitfac_gps_access, itfac_facerec_access, inpitfac_facerec_access, itfac_vpn, inpitfac_vpn, itfac_wifi, inpitfac_wifi, itfac_fileserv, inpitfac_fileserv, itfac_mobilephone, inpitfac_mobilephone, itfac_acts, inpitfac_acts, itfac_hrms, inpitfac_hrms, itfac_cas, inpitfac_cas, itfac_webbc, inpitfac_webbc, itfac_tpb, inpitfac_tpb, itfac_ptk, inpitfac_ptk, itfac_shipment, inpitfac_shipment, itfac_ticketing, inpitfac_ticketing, itfac_spec, inpitfac_spec, itfac_recruitment, inpitfac_recruitment, itfac_vms, inpitfac_vms, hari_kerja, jam_kerja, employee_remark, kriteria, jobdesc , created_date, created_by",
            "'','$SEQ', '$DEPARTEMENT', '$DIVISI', '$SECTION', '$SUBSECTION', '$TEAM', '$UNIT', '$GRADE', '$LEVEL', '$TYPE_PTK', '$SO_NUMBER', '$FILE', '$EDUCATION', '$MAJOR', '$WORK_EXPERIENCE', '$QTY_SUBMITION', '$DATE_NEEDED', '$PLACEMENT', '$BASED_SALARY', '$TYPE_SALARY', '$TYPE_WORKER', '$WORK_LOCATION', '$TYPE_APD', '$TYPE_MCU', '$ITFAC_PC', '$inpITFAC_PC', '$ITFAC_LAPTOP', '$inpITFAC_LAPTOP', '$ITFAC_EMAIL', '$inpITFAC_EMAIL', '$ITFAC_EXTDISK', '$inpITFAC_EXTDISK', '$ITFAC_CCTV_ACCESS', '$inpITFAC_CCTV_ACCESS', '$ITFAC_FINGER_ACCESS', '$inpITFAC_FINGER_ACCESS', '$ITFAC_GPS_ACCESS', '$inpITFAC_GPS_ACCESS', '$ITFAC_FACEREC_ACCESS', '$inpITFAC_FACEREC_ACCESS', '$ITFAC_VPN', '$inpITFAC_VPN', '$ITFAC_WIFI', '$inpITFAC_WIFI', '$ITFAC_FILESERV', '$inpITFAC_FILESERV', '$ITFAC_MOBILEPHONE', '$inpITFAC_MOBILEPHONE', '$ITFAC_ACTS', '$inpITFAC_ACTS', '$ITFAC_HRMS', '$inpITFAC_HRMS', '$ITFAC_CAS', '$inpITFAC_CAS', '$ITFAC_WEBBC', '$inpITFAC_WEBBC', '$ITFAC_TPB', '$inpITFAC_TPB', '$ITFAC_PTK', '$inpITFAC_PTK', '$ITFAC_SHIPMENT', '$inpITFAC_SHIPMENT', '$ITFAC_TICKETING', '$inpITFAC_TICKETING', '$ITFAC_SPEC', '$inpITFAC_SPEC', '$ITFAC_RECRUITMENT', '$inpITFAC_RECRUITMENT', '$ITFAC_VMS', '$inpITFAC_VMS', '$HARI_KERJA', '$JAM_KERJA', '$EMPLOYEE_REMARK', '$KRITERIA', '$JOBDESC' , '$DINO', '$ID_USER1'");

            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Edit PTK - $SEQ', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','Edit PTK'");

            ?>
            <script>alert('Data PTK has been updated! Thank you! ');</script>
            <script>document.location.href='ptk';</script>
            <?php
            die(0);
        }
        else
        {
            ?>
            <script>alert("Error! Gagal update data");window.history.back();</script>
            <?php
            die(0);
        }

    }
}

//SIMPAN BARU////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{
     //cek apakah variable ada isinya?
     if($_FILES["FILE"]["tmp_name"] != "")
     {
        $FILE_EXT  = strtolower(pathinfo($_FILES["FILE"]["name"], PATHINFO_EXTENSION));
        // Create Directory sesuai KODE PTK
        if (!file_exists("pdf/".$SEQ)) 
        {
            if(mkdir("file/".$SEQ, 0755, true))
            {
            echo('<br> success create directory code : '.$SEQ);
            }
            else
            {
            echo('<br> directory already exist : '.$SEQ);
            exit;
            }
        }
        //nama
        $KODE_HISTORY = kodeAuto("t_ptk_history","urut");
        $FILE = "file/".$SEQ."/".$SEQ." ".$KODE_HISTORY.".".$FILE_EXT;
        //upload
        move_uploaded_file($_FILES["FILE"]["tmp_name"],$FILE);
     }
     else
     {
        echo "No file(s) uploaded.";
     }
 
    $DEPARTEMENT             = $_POST["DEPARTEMENT"];
    $DIVISI                  = $_POST["DIVISI"];
    $SECTION                 = $_POST["SECTION"];
    $SUBSECTION              = $_POST["SUBSECTION"];
    $TEAM                    = $_POST["TEAM"];
    $UNIT                    = $_POST["UNIT"];
    $GRADE                   = $_POST["GRADE"];
    $LEVEL                   = $_POST["LEVEL"];

    $TYPE_PTK                = $_POST["TYPE_PTK"];
    $SO_NUMBER               = isset($_POST["SO_NUMBER"]) ? str_replace("'","\'",$_POST["SO_NUMBER"]) : null;
    $EDUCATION               = $_POST["EDUCATION"];
    $MAJOR                   = str_replace("'","\'",$_POST["MAJOR"]);
    $WORK_EXPERIENCE         = str_replace("'","\'",$_POST["WORK_EXPERIENCE"]);
    $QTY_SUBMITION           = $_POST["QTY_SUBMITION"];
    $DATE_NEEDED             = $_POST["DATE_NEEDED"];
    $PLACEMENT               = $_POST["PLACEMENT"];
    $BASED_SALARY            = $_POST["BASED_SALARY"];
    $TYPE_SALARY             = $_POST["TYPE_SALARY"];
    // $TYPE_CONTRACT           = $_POST["TYPE_CONTRACT"];
    $TYPE_WORKER             = $_POST["TYPE_WORKER"];
    $WORK_LOCATION           = $_POST["WORK_LOCATION"];
    $TYPE_APD                = $_POST["TYPE_APD"];
    $TYPE_MCU                = $_POST["TYPE_MCU"];
    $ITFAC_PC                = isset($_POST["ITFAC_PC"]) ? 1 : 0;
    $inpITFAC_PC             = str_replace("'","\'",$_POST["inpITFAC_PC"]);
    $ITFAC_LAPTOP            = isset($_POST["ITFAC_LAPTOP"]) ? 1 : 0;
    $inpITFAC_LAPTOP         = str_replace("'","\'",$_POST["inpITFAC_LAPTOP"]);
    $ITFAC_EMAIL             = isset($_POST["ITFAC_EMAIL"]) ? 1 : 0;
    $inpITFAC_EMAIL          = str_replace("'","\'",$_POST["inpITFAC_EMAIL"]);
    $ITFAC_EXTDISK           = isset($_POST["ITFAC_EXTDISK"]) ? 1 : 0;
    $inpITFAC_EXTDISK        = str_replace("'","\'",$_POST["inpITFAC_EXTDISK"]);
    $ITFAC_CCTV_ACCESS       = isset($_POST["ITFAC_CCTV_ACCESS"]) ? 1 : 0;
    $inpITFAC_CCTV_ACCESS    = str_replace("'","\'",$_POST["inpITFAC_CCTV_ACCESS"]);
    $ITFAC_FINGER_ACCESS     = isset($_POST["ITFAC_FINGER_ACCESS"]) ? 1 : 0;
    $inpITFAC_FINGER_ACCESS  = str_replace("'","\'",$_POST["inpITFAC_FINGER_ACCESS"]);
    $ITFAC_GPS_ACCESS        = isset($_POST["ITFAC_GPS_ACCESS"]) ? 1 : 0;
    $inpITFAC_GPS_ACCESS     = str_replace("'","\'",$_POST["inpITFAC_GPS_ACCESS"]);
    $ITFAC_FACEREC_ACCESS    = isset($_POST["ITFAC_FACEREC_ACCESS"]) ? 1 : 0;
    $inpITFAC_FACEREC_ACCESS = str_replace("'","\'",$_POST["inpITFAC_FACEREC_ACCESS"]);
    $ITFAC_VPN               = isset($_POST["ITFAC_VPN"]) ? 1 : 0;
    $inpITFAC_VPN            = str_replace("'","\'",$_POST["inpITFAC_VPN"]);
    $ITFAC_WIFI              = isset($_POST["ITFAC_WIFI"]) ? 1 : 0;
    $inpITFAC_WIFI           = str_replace("'","\'",$_POST["inpITFAC_WIFI"]);
    $ITFAC_FILESERV          = isset($_POST["ITFAC_FILESERV"]) ? 1 : 0;
    $inpITFAC_FILESERV       = str_replace("'","\'",$_POST["inpITFAC_FILESERV"]);
    $ITFAC_MOBILEPHONE       = isset($_POST["ITFAC_MOBILEPHONE"]) ? 1 : 0;
    $inpITFAC_MOBILEPHONE    = str_replace("'","\'",$_POST["inpITFAC_MOBILEPHONE"]);
    $ITFAC_ACTS              = isset($_POST["ITFAC_ACTS"]) ? 1 : 0;
    $inpITFAC_ACTS           = str_replace("'","\'",$_POST["inpITFAC_ACTS"]);
    $ITFAC_HRMS              = isset($_POST["ITFAC_HRMS"]) ? 1 : 0;
    $inpITFAC_HRMS           = str_replace("'","\'",$_POST["inpITFAC_HRMS"]);
    $ITFAC_CAS               = isset($_POST["ITFAC_CAS"]) ? 1 : 0;
    $inpITFAC_CAS            = str_replace("'","\'",$_POST["inpITFAC_CAS"]);
    $ITFAC_WEBBC             = isset($_POST["ITFAC_WEBBC"]) ? 1 : 0;
    $inpITFAC_WEBBC          = str_replace("'","\'",$_POST["inpITFAC_WEBBC"]);
    $ITFAC_TPB               = isset($_POST["ITFAC_TPB"]) ? 1 : 0;
    $inpITFAC_TPB            = str_replace("'","\'",$_POST["inpITFAC_TPB"]);
    $ITFAC_PTK               = isset($_POST["ITFAC_PTK"]) ? 1 : 0;
    $inpITFAC_PTK            = str_replace("'","\'",$_POST["inpITFAC_PTK"]);
    $ITFAC_SHIPMENT          = isset($_POST["ITFAC_SHIPMENT"]) ? 1 : 0;
    $inpITFAC_SHIPMENT       = str_replace("'","\'",$_POST["inpITFAC_SHIPMENT"]);
    $ITFAC_TICKETING         = isset($_POST["ITFAC_TICKETING"]) ? 1 : 0;
    $inpITFAC_TICKETING      = str_replace("'","\'",$_POST["inpITFAC_TICKETING"]);
    $ITFAC_SPEC              = isset($_POST["ITFAC_SPEC"]) ? 1 : 0;
    $inpITFAC_SPEC           = str_replace("'","\'",$_POST["inpITFAC_SPEC"]);
    $ITFAC_RECRUITMENT       = isset($_POST["ITFAC_RECRUITMENT"]) ? 1 : 0;
    $inpITFAC_RECRUITMENT    = str_replace("'","\'",$_POST["inpITFAC_RECRUITMENT"]);
    $ITFAC_VMS               = isset($_POST["ITFAC_VMS"]) ? 1 : 0;
    $inpITFAC_VMS            = str_replace("'","\'",$_POST["inpITFAC_VMS"]);
    $HARI_KERJA              = $_POST["HARI_KERJA"];
    $JAM_KERJA               = implode(",",$_POST["JAM_KERJA"]);
    $EMPLOYEE_REMARK         = str_replace("'","\'",$_POST['EMPLOYEE_REMARK']);
    $KRITERIA                = str_replace("'","\'",$_POST['KRITERIA']);
    $JOBDESC                 = str_replace("'","\'",$_POST['JOBDESC']);

    //INSERT INTO T_PTK
    $query = InsertData(
            "t_ptk",
            "seq, date_ptk, kode_departement, kode_divisi, kode_section, kode_subsection, kode_team, kode_unit, kode_grade, kode_level, type_ptk, so_number, file, education, major, work_experience, qty_submition, qty_left, date_needed, placement, based_salary, type_salary, type_worker, work_location, type_apd, type_mcu, itfac_pc, inpitfac_pc, itfac_laptop, inpitfac_laptop, itfac_email, inpitfac_email, itfac_extdisk, inpitfac_extdisk, itfac_cctv_access, inpitfac_cctv_access, itfac_finger_access, inpitfac_finger_access, itfac_gps_access, inpitfac_gps_access, itfac_facerec_access, inpitfac_facerec_access, itfac_vpn, inpitfac_vpn, itfac_wifi, inpitfac_wifi, itfac_fileserv, inpitfac_fileserv, itfac_mobilephone, inpitfac_mobilephone, itfac_acts, inpitfac_acts, itfac_hrms, inpitfac_hrms, itfac_cas, inpitfac_cas, itfac_webbc, inpitfac_webbc, itfac_tpb, inpitfac_tpb, itfac_ptk, inpitfac_ptk, itfac_shipment, inpitfac_shipment, itfac_ticketing, inpitfac_ticketing, itfac_spec, inpitfac_spec, itfac_recruitment, inpitfac_recruitment, itfac_vms, inpitfac_vms, hari_kerja, jam_kerja, employee_remark, kriteria, jobdesc , created_date, created_by",
            "'$SEQ', '$DATE', '$DEPARTEMENT', '$DIVISI', '$SECTION', '$SUBSECTION', '$TEAM', '$UNIT', '$GRADE', '$LEVEL', '$TYPE_PTK', '$SO_NUMBER', '$FILE', '$EDUCATION', '$MAJOR', '$WORK_EXPERIENCE', '$QTY_SUBMITION', '$QTY_SUBMITION', '$DATE_NEEDED', '$PLACEMENT', '$BASED_SALARY', '$TYPE_SALARY', '$TYPE_WORKER', '$WORK_LOCATION', '$TYPE_APD', '$TYPE_MCU', '$ITFAC_PC', '$inpITFAC_PC', '$ITFAC_LAPTOP', '$inpITFAC_LAPTOP', '$ITFAC_EMAIL', '$inpITFAC_EMAIL', '$ITFAC_EXTDISK', '$inpITFAC_EXTDISK', '$ITFAC_CCTV_ACCESS', '$inpITFAC_CCTV_ACCESS', '$ITFAC_FINGER_ACCESS', '$inpITFAC_FINGER_ACCESS', '$ITFAC_GPS_ACCESS', '$inpITFAC_GPS_ACCESS', '$ITFAC_FACEREC_ACCESS', '$inpITFAC_FACEREC_ACCESS', '$ITFAC_VPN', '$inpITFAC_VPN', '$ITFAC_WIFI', '$inpITFAC_WIFI', '$ITFAC_FILESERV', '$inpITFAC_FILESERV', '$ITFAC_MOBILEPHONE', '$inpITFAC_MOBILEPHONE', '$ITFAC_ACTS', '$inpITFAC_ACTS', '$ITFAC_HRMS', '$inpITFAC_HRMS', '$ITFAC_CAS', '$inpITFAC_CAS', '$ITFAC_WEBBC', '$inpITFAC_WEBBC', '$ITFAC_TPB', '$inpITFAC_TPB', '$ITFAC_PTK', '$inpITFAC_PTK', '$ITFAC_SHIPMENT', '$inpITFAC_SHIPMENT', '$ITFAC_TICKETING', '$inpITFAC_TICKETING', '$ITFAC_SPEC', '$inpITFAC_SPEC', '$ITFAC_RECRUITMENT', '$inpITFAC_RECRUITMENT', '$ITFAC_VMS', '$inpITFAC_VMS', '$HARI_KERJA', '$JAM_KERJA', '$EMPLOYEE_REMARK', '$KRITERIA', '$JOBDESC' , '$DINO', '$ID_USER1'");

    if($query)
    {
        //INSERT INTO T_PTK_HISTORY
        InsertData(
        "t_ptk_history",
        "urut, seq, kode_departement, kode_divisi, kode_section, kode_subsection, kode_team, kode_unit, kode_grade, kode_level, type_ptk, so_number, file, education, major, work_experience, qty_submition, date_needed, placement, based_salary, type_salary, type_worker, work_location, type_apd, type_mcu, itfac_pc, inpitfac_pc, itfac_laptop, inpitfac_laptop, itfac_email, inpitfac_email, itfac_extdisk, inpitfac_extdisk, itfac_cctv_access, inpitfac_cctv_access, itfac_finger_access, inpitfac_finger_access, itfac_gps_access, inpitfac_gps_access, itfac_facerec_access, inpitfac_facerec_access, itfac_vpn, inpitfac_vpn, itfac_wifi, inpitfac_wifi, itfac_fileserv, inpitfac_fileserv, itfac_mobilephone, inpitfac_mobilephone, itfac_acts, inpitfac_acts, itfac_hrms, inpitfac_hrms, itfac_cas, inpitfac_cas, itfac_webbc, inpitfac_webbc, itfac_tpb, inpitfac_tpb, itfac_ptk, inpitfac_ptk, itfac_shipment, inpitfac_shipment, itfac_ticketing, inpitfac_ticketing, itfac_spec, inpitfac_spec, itfac_recruitment, inpitfac_recruitment, itfac_vms, inpitfac_vms, hari_kerja, jam_kerja, employee_remark, kriteria, jobdesc , created_date, created_by",
        "'','$SEQ', '$DEPARTEMENT', '$DIVISI', '$SECTION', '$SUBSECTION', '$TEAM', '$UNIT', '$GRADE' , '$LEVEL', '$TYPE_PTK', '$SO_NUMBER', '$FILE', '$EDUCATION', '$MAJOR', '$WORK_EXPERIENCE', '$QTY_SUBMITION', '$DATE_NEEDED', '$PLACEMENT', '$BASED_SALARY', '$TYPE_SALARY', '$TYPE_WORKER', '$WORK_LOCATION', '$TYPE_APD', '$TYPE_MCU', '$ITFAC_PC', '$inpITFAC_PC', '$ITFAC_LAPTOP', '$inpITFAC_LAPTOP', '$ITFAC_EMAIL', '$inpITFAC_EMAIL', '$ITFAC_EXTDISK', '$inpITFAC_EXTDISK', '$ITFAC_CCTV_ACCESS', '$inpITFAC_CCTV_ACCESS', '$ITFAC_FINGER_ACCESS', '$inpITFAC_FINGER_ACCESS', '$ITFAC_GPS_ACCESS', '$inpITFAC_GPS_ACCESS', '$ITFAC_FACEREC_ACCESS', '$inpITFAC_FACEREC_ACCESS', '$ITFAC_VPN', '$inpITFAC_VPN', '$ITFAC_WIFI', '$inpITFAC_WIFI', '$ITFAC_FILESERV', '$inpITFAC_FILESERV', '$ITFAC_MOBILEPHONE', '$inpITFAC_MOBILEPHONE', '$ITFAC_ACTS', '$inpITFAC_ACTS', '$ITFAC_HRMS', '$inpITFAC_HRMS', '$ITFAC_CAS', '$inpITFAC_CAS', '$ITFAC_WEBBC', '$inpITFAC_WEBBC', '$ITFAC_TPB', '$inpITFAC_TPB', '$ITFAC_PTK', '$inpITFAC_PTK', '$ITFAC_SHIPMENT', '$inpITFAC_SHIPMENT', '$ITFAC_TICKETING', '$inpITFAC_TICKETING', '$ITFAC_SPEC', '$inpITFAC_SPEC', '$ITFAC_RECRUITMENT', '$inpITFAC_RECRUITMENT', '$ITFAC_VMS', '$inpITFAC_VMS', '$HARI_KERJA', '$JAM_KERJA', '$EMPLOYEE_REMARK', '$KRITERIA', '$JOBDESC' , '$DINO', '$ID_USER1'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Input PTK - $SEQ', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','Tambah PTK'");

        // KIRIM EMAIL KE MANAGER
        $result = $db1->prepare("select  a.*,
                                 date_format(a.date_needed, '%d %b %Y') as date_needed,
                                 b.nama_departement,
                                 c.nama_divisi,
                                 e.nama_section,
                                 f.nama_subsection,
                                 g.nama_team,
                                 h.nama_unit,
                                 j.nama_level,
                                 k.nama_grade,
                                 k.ket_grade,
                                 l.nama as work_location
                            from t_ptk a
                            left join m_departement b ON a.kode_departement = b.kode_departement
                            left join m_divisi c ON a.kode_divisi = c.kode_divisi
                            left join m_section e ON a.kode_section = e.kode_section
                            left join m_subsection f ON a.kode_subsection = f.kode_subsection
                            left join m_team g ON a.kode_team = g.kode_team
                            left join m_unit h ON a.kode_unit = h.kode_unit
                            left join m_level j ON a.kode_level = j.kode_level
                            left join m_grade k ON a.kode_grade = k.kode_grade
                            left join m_worklocation l ON a.work_location = l.seq
                           where a.seq = '$SEQ'");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $SEQ              = $row["seq"];
            $NAMA_DEPARTEMENT = $row["nama_departement"];
            $KODE_DIVISI      = $row["kode_divisi"];
            $NAMA_DIVISI      = $row["nama_divisi"];
            $NAMA_SECTION     = $row["nama_section"];
            $NAMA_SUBSECTION  = $row["nama_subsection"];
            $NAMA_TEAM        = $row["nama_team"];
            $NAMA_UNIT        = $row["nama_unit"];
            $NAMA_GRADE       = $row["nama_grade"];
            $KET_GRADE        = $row["ket_grade"];
            $NAMA_LEVEL       = $row["nama_level"];
            $TYPE_PTK         = $row["type_ptk"];
            // $TYPE_CONTRACT    = $row["type_contract"];
            $DATE_NEEDED      = $row["date_needed"];
            $QTY_SUBMITION    = $row["qty_submition"];
            $BASED_SALARY     = $row["based_salary"];
            $WORK_LOCATION    = $row["work_location"];
            $EMPLOYEE_REMARK  = $row["employee_remark"];
            $KRITERIA         = $row["kriteria"];
            $JOBDESC          = $row["jobdesc"];
        }

        $query = $db1->prepare("select a.email,
                                       a.nama_user,
                                       b.head
                                  from m_user a
                                  left join m_divisi b ON a.kode_user = b.head
                                 where b.kode_divisi = '$KODE_DIVISI'");
        $query->execute();
        while ($row_query = $query->fetch(PDO::FETCH_ASSOC))
        {
            $EMAIL_MGR = $row_query["email"];
        }

        require 'assets/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSendmail();
        set_time_limit(120); // set the time limit to 120 seconds

        $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
        $mail->addAddress($EMAIL_MGR);
        $mail->Subject = "PTK Online - New Employee Request for $SEQ";
        $mail->msgHTML("<h4> Dear Manager,</h4>
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
                                $NAMA_GRADE $KET_GRADE
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
                                Waiting
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
                                Waiting
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
                                Waiting
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
                                Waiting
                            </td>
                        </tr>
                        </table>
                        <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
                        Regards, <br>
                        Recruitment Team <br>
                        PT.  Baramuda Bahari");
        if($mail->send())
        { echo "Message has been"; }
        else
        { echo "Mailer Error: " . $mail->ErrorInfo;}

    }
    else
    {
    ?>
        <script>alert("Error! Gagal simpan");window.history.back();</script>
        <?php
        die(0);
    }
    ?>
    <script>alert('Data PTK has been saved! Thank you! ');</script>
    <script>document.location.href='ptk';</script>
    <?php
    die(0);
}
?>