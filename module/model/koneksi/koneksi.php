<?php
	session_start();
	ini_set("date.timezone","Asia/Jakarta");
	ini_set('max_execution_time', 0); //300 seconds = 5 minutes
	$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
	$TGL = date("Y-m-d");

	function kodeAuto($namatabel,$namakolom)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');

		$akhir = 0;
		$stmt  = $db1->query("select max($namakolom) as akhir from $namatabel");
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$akhir = intval($row["akhir"]);
			}
		}
		$akhir = $akhir +1;
		return $akhir;
	}

	function GetQuery($query){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare($query); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
	}

	function GetData($kolom,$from){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare("select $kolom from $from"); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
	}

	function GetData1($kolom,$from,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare("select $kolom from $from where $where"); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
	}

	function UpdateData($from,$kolom,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare("update $from set $kolom where $where"); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
		
	}

	function InsertData($table,$kolom,$values){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare("insert into $table ($kolom) values ($values)"); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
		
	}

	function DeleteData($table,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db1->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		try{
			$result = $db1->prepare("delete from $table where $where"); 
			$result->execute();
			return $result;
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
		
	}

	function createKode($namaTabel,$namaKolom,$awalan,$jumlahAngka)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'personalia_bb', 'personalia_bb');
		$angkaAkhir = 0;
		
		$stmt = $db1->query("select max(right($namaKolom,$jumlahAngka)) as akhir from $namaTabel where $namaKolom like '".$awalan."%' ");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$angkaAkhir = intval($row["akhir"]);
			}
		}
		$angkaAkhir = $angkaAkhir + 1;
		return $awalan.substr("0000000".$angkaAkhir,-1*$jumlahAngka);
	}	
	
	function getIp(){
	    $IP_ADDRESS = $_SERVER['REMOTE_ADDR'];     
	    if($IP_ADDRESS){
	        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	            $IP_ADDRESS = $_SERVER['HTTP_CLIENT_IP'];
	        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            $IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        }
	        return $IP_ADDRESS;
	    }
	    return false;;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////APPROVAL REMINDER
	$reminderday = GetQuery("select reminder from param where reminder != ''");
	while($rowz = $reminderday->fetch(PDO::FETCH_ASSOC))
	{
		$RD = $rowz["reminder"];
	}

	// EMAIL REMINDER MANAGER //
	$remind_mgr = GetQuery("select seq,DATEDIFF('$TGL',date_ptk) as DIFF from t_ptk WHERE app_mgr_date IS NULL AND reminder_mgr=0 and status_hapus=0 and status_approval = 0");
	while ($row1 = $remind_mgr->fetch(PDO::FETCH_ASSOC)) 
	{	
		$DIFF = $row1["DIFF"];
		if($DIFF >= $RD)
		{
			$SEQ = $row1["seq"];
		    $result = $db1->prepare("select kode_divisi from t_ptk where seq = '$SEQ'");
		    $result->execute();
		    while ($row = $result->fetch(PDO::FETCH_ASSOC))
		    { $KODE_DIVISI = $row["kode_divisi"]; }

		    $query = $db1->prepare("select a.email,
		                                   a.nama_user,
		                                   b.head
		                              from m_user a
		                              left join m_divisi b ON a.kode_user = b.head
		                             where b.kode_divisi = '$KODE_DIVISI' and a.status='aktif'");
		    $query->execute();
		    while ($row_query = $query->fetch(PDO::FETCH_ASSOC))
		    { $EMAIL_MGR = $row_query["email"]; }
		    require_once 'assets/phpmailer/PHPMailerAutoload.php';
		    $mail = new PHPMailer;
		    $mail->isSendmail();
		    set_time_limit(120); // set the time limit to 120 seconds
		    $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
		    $mail->addAddress($EMAIL_MGR);
		    $mail->Subject = "PTK Online - Approval Reminder for $SEQ";
		    $mail->msgHTML("<h4> Dear Manager,</h4>
		                    <p>This is auto generate email from PTK Online System that reminds approval for employee request : <h3>$SEQ</h3></p>
		                    <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
		                    Regards, <br>
		                    Recruitment Team <br>
		                    PT. Baramuda Bahari");
		    if($mail->send())
		    {
				UpdateData("t_ptk","reminder_mgr = 1","seq = '$SEQ'");
			}
		}
	}
	
	// EMAIL REMINDER DIRECTOR //
	$remind_dir = GetQuery("select seq,DATEDIFF('$TGL',app_mgr_date) as DIFF2 from t_ptk WHERE app_dir_date IS NULL AND reminder_dir=0 and status_hapus=0 and status_approval = 0");
	while ($row2 = $remind_dir->fetch(PDO::FETCH_ASSOC)) 
	{	
		$DIFF2 = $row2["DIFF2"];
		if($DIFF2 >= $RD)
		{
			$SEQ2 = $row2["seq"];
		    $result2 = $db1->prepare("select kode_departement from t_ptk where seq = '$SEQ2'");
		    $result2->execute();
		    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
		    { $KODE_DEPARTEMENT = $row2["kode_departement"]; }
		    $query2 = $db1->prepare("select a.email,
                                       a.nama_user,
                                       b.head
                                  from m_user a
                                  join m_departement b ON a.kode_user = b.head
                                 where b.kode_departement = '$KODE_DEPARTEMENT' and a.status='aktif'");
	        $query2->execute();
	        while ($row_query2 = $query2->fetch(PDO::FETCH_ASSOC))
	        { $EMAIL_DIR = $row_query2["email"]; }
		    require_once 'assets/phpmailer/PHPMailerAutoload.php';
		    $mail = new PHPMailer;
		    $mail->isSendmail();
		    set_time_limit(120); // set the time limit to 120 seconds
		    $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
		    $mail->addAddress($EMAIL_DIR);
		    $mail->Subject = "PTK Online - Approval Reminder for $SEQ2";
		    $mail->msgHTML("<h4> Dear Director,</h4>
		                    <p>This is auto generate email from PTK Online System that reminds approval for employee request : <h3>$SEQ2</h3></p>
		                    <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
		                    Regards, <br>
		                    Recruitment Team <br>
		                    PT. Baramuda Bahari");
		    if($mail->send())
		    {
				UpdateData("t_ptk","reminder_dir = 1","seq = '$SEQ2'");
			}
		}
	}
	
	// EMAIL REMINDER MGR HRD //
	$remind_hrd = GetQuery("select seq,DATEDIFF('$TGL',app_dir_date) as DIFF3 from t_ptk WHERE app_hrd_date IS NULL AND reminder_hrd=0 and status_hapus=0 and status_approval = 0");
	while ($row3 = $remind_hrd->fetch(PDO::FETCH_ASSOC)) 
	{	
		$DIFF3 = $row3["DIFF3"];
		if($DIFF3 >= $RD)
		{
			$SEQ3 = $row3["seq"];
		    $result3 = $db1->prepare("select email from m_user where kode_departement = '05' and akses = 'manager' and status='aktif'");
		    $result3->execute();
	        while ($row3 = $result3->fetch(PDO::FETCH_ASSOC))
	        { $EMAIL_HRD = $row3["email"]; }
		    require_once 'assets/phpmailer/PHPMailerAutoload.php';
		    $mail = new PHPMailer;
		    $mail->isSendmail();
		    set_time_limit(120); // set the time limit to 120 seconds
		    $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
		    $mail->addAddress($EMAIL_HRD);
		    $mail->Subject = "PTK Online - Approval Reminder for $SEQ3";
		    $mail->msgHTML("<h4> Dear HRD Manager,</h4>
		                    <p>This is auto generate email from PTK Online System that reminds approval for employee request : <h3>$SEQ3</h3></p>
		                    <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
		                    Regards, <br>
		                    Recruitment Team <br>
		                    PT. Baramuda Bahari");
		    if($mail->send())
		    {
				UpdateData("t_ptk","reminder_hrd = 1","seq = '$SEQ3'");
			}
		}
	}

	// EMAIL REMINDER MANAGING DIRECTOR //
	$remind_md  = GetQuery("select seq,DATEDIFF('$TGL',app_hrd_date) as DIFF4 from t_ptk WHERE app_md_date IS NULL AND reminder_md=0 and status_hapus=0 and status_approval = 0");
	while ($row4 = $remind_md->fetch(PDO::FETCH_ASSOC)) 
	{	
		$DIFF4 = $row4["DIFF4"];
		if($DIFF4 >= $RD)
		{
			$SEQ4 = $row4["seq"];
		    $result4 = $db1->prepare("select email from m_user where akses = 'MD' and status='aktif'");
		    $result4->execute();
	        while ($row4 = $result4->fetch(PDO::FETCH_ASSOC))
	        { $EMAIL_MD = $row4["email"]; }
		    require_once 'assets/phpmailer/PHPMailerAutoload.php';
		    $mail = new PHPMailer;
		    $mail->isSendmail();
		    set_time_limit(120); // set the time limit to 120 seconds
		    $mail->setFrom('no-reply@megamarinepride.com','PTK Management System');
		    $mail->addAddress($EMAIL_MD);
		    $mail->Subject = "PTK Online - Approval Reminder for $SEQ4";
		    $mail->msgHTML("<h4> Dear Managing Director,</h4>
		                    <p>This is auto generate email from PTK Online System that reminds approval for employee request : <h3>$SEQ4</h3></p>
		                    <h4>Please do not reply to this email, for more information : IT Department (ext. call : 150)</h4>
		                    Regards, <br>
		                    Recruitment Team <br>
		                    PT. Baramuda Bahari");
		    if($mail->send())
		    {
				UpdateData("t_ptk","reminder_md = 1","seq = '$SEQ4'");
			}
		}
	}
?>