<?php require_once("../koneksi/koneksi.php");
if ($_GET['seq']){
    $seq = $_GET['seq'];
    $no = 1;
    $result = getQuery("select  
                        a.urut,
                        a.seq,
                        date_format(a.date, '%d %b %Y') as date,
                        a.id_accepted,
                        a.name_accepted,
                        a.created_date,
                        b.nama_user,
                        case 
                            when jenis_kelamin = 'L' then 'Laki-laki'
                            when jenis_kelamin = 'P' then 'Perempuan'
                            else 'Undefined' 
                        end as jenis_kelamin
                    from t_fulfillment a
                LEFT JOIN m_user b ON a.created_by = b.kode_user
                    where a.seq = '$seq'
                order by a.urut asc");
        $data = array(); 
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            array_push($data,array(
                    'urut'=>$row['urut'],
                    'seq' => $row['seq'],
                    'date' => $row['date'],
                    'id_acc' => $row['id_accepted'],
                    'name_acc' => $row['name_accepted'],
                    'created_date' => $row['created_date'],
                    'nama_user' => $row['nama_user'],
                    'jk' => $row['jenis_kelamin']
            ));
        }
        echo json_encode($data);
} else {
    echo json_encode(array());
}
?>