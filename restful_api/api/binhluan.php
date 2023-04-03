

<?php
    
    function getbinhluanbyid($idtruyen){
        global $objConn;
        try{

            $sql_getbyid = "SELECT tb_binh_luan.*, tb_truyen.ten_truyen, tb_user.username
            FROM tb_binh_luan 
            INNER JOIN tb_truyen ON tb_binh_luan.id_truyen = tb_truyen.id
            INNER JOIN tb_user ON tb_binh_luan.id_user = tb_user.id
            WHERE tb_binh_luan.id_truyen =? ";
            $stmt = $objConn->prepare($sql_getbyid);
            $stmt -> bindParam(1,$idtruyen);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_ASSOC);
            $binhluan = $stmt -> fetchAll();

            $dataRes = [
                'status' => 1,
                'msg'    => 'thanh cong',
                'data'   => $binhluan
            ];
            echo json_encode($dataRes);

            
        }catch(Exception $e){
            die('loi thuc hien truy va co so du lieu' .$e->getMessage());
        }
    }

    function addbinhluan(){
        global $objConn;
        
        $id_truyen = $_POST['idtruyen'];
        $id_user = $_POST['iduser'];
        $noi_dung = $_POST['noidung'];
        $ngay_gio = date('Y-m-d H:i:s');
        if(empty($id_truyen) || empty($id_user) || empty($noi_dung) || empty($ngay_gio)){
            $dataRes = [
                'status' => 1,
                'msg'    => 'khong de trong thong tin'
            ];
        }else{

            try{
                $query = "INSERT INTO tb_binh_luan(id_truyen, id_user, noi_dung, ngay_gio)
                VALUES (:tham_so_idtruyen, :tham_so_iduser, :tham_so_noidung, :tham_so_ngaygio)";

                $stmt = $objConn -> prepare($query);
                
                $stmt -> bindParam(":tham_so_idtruyen", $id_truyen);
                $stmt -> bindParam(":tham_so_iduser", $id_user);
                $stmt -> bindParam(":tham_so_noidung", $noi_dung);
                $stmt -> bindParam(":tham_so_ngaygio", $ngay_gio);

                $stmt ->execute();
                $dataRes = [
                    'status' => 1,
                    'msg'    => 'them thanh cong binhluan'
                ];

            }catch(Exception $e){
                $dataRes =[
                    'status'=>0,
                    'msg'=> 'Lỗi '. $e->getMessage()
                ];
            }
        
        echo json_encode($dataRes);

    }
}
function update_binhluan($idbinhluan){
    global $objConn;
    $noidung = $_POST['noidung'];
   
        try{
            $query = "UPDATE `tb_binh_luan` set noi_dung=:tham_so_noidung
            WHERE id=:tham_so_id ";

            $stmt = $objConn -> prepare($query);

            $stmt -> bindParam(":tham_so_id",$idbinhluan);
            $stmt -> bindParam(":tham_so_noidung", $noidung);
           
            
            $stmt ->execute();
            $dataRes = [
                'status' => 1,
                'msg'    => 'update thanh cong binh luan'
            ];

        }catch(Exception $e){
            $dataRes =[
                'status'=>0,
                'msg'=> 'Lỗi '. $e->getMessage()
            ];
        }
    
    echo json_encode($dataRes);

}


$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    if(empty($_GET['id'])){ 
        addbinhluan();
    }
    else{
        update_binhluan($_GET['id']);
    }
}
if ( $method == 'GET'){
    getbinhluanbyid($_GET['id_truyen']);

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>binh luan</title>
</head>
<body>
<H1>binh luan</H1>
    <form action="" method="post" > 
       <li> <input type="text" name="idtruyen" placeholder="idtruyen" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="iduser" placeholder="iduser" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="noidung" placeholder="noidung" style="width: 300px; height: 40px; margin:10px"></li>

       <li> <button type="submit" style="width: 300px; height: 40px; margin:10px">Send</button></li>

    </form>

</body>
</html>