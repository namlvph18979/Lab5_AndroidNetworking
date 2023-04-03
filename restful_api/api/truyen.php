

<?php
    
    function ListAlltruyen(){
        global $objConn;
        try{

            $sql_get = "SELECT * FROM tb_truyen";
            $stmt = $objConn->prepare($sql_get);
            $stmt-> execute();
            $stmt-> setFetchMode(PDO::FETCH_ASSOC);
            $danh_sach = $stmt -> fetchAll();
            
            $dataRes = [
                'status' => 1,
                'msg'    => 'thanh cong',
                'data'   => $danh_sach
            ];
            echo json_encode($dataRes);
            
        }catch(Exception $e){
            die('Loi thuc hien truy van co so du lieu' .$e->getMessage());
        }
    }


    function gettruyenbyid($idtruyen){
        global $objConn;
        try{

            $sql_getbyid = "SELECT * FROM tb_truyen WHERE id =? LiMIT 1";
            $stmt = $objConn->prepare($sql_getbyid);
            $stmt -> bindParam(1,$idtruyen);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_ASSOC);
            $truyen = $stmt -> fetch();

            echo json_encode($truyen);
            
        }catch(Exception $e){
            die('loi thuc hien truy va co so du lieu' .$e->getMessage());
        }
    }

    function addtruyen(){
        global $objConn;
        
        $ten_truyen = $_POST['tentruyen'];
        $tac_gia = $_POST['tacgia'];
        $nam_xb = $_POST['namxb'];
        $anh_bia = $_POST['anhbia'];
        if(empty($ten_truyen) || empty($tac_gia) || empty($nam_xb) || empty($anh_bia)){
            $dataRes = [
                'status' => 1,
                'msg'    => 'khong de trong thong tin'
            ];
        }else{

            try{
                $query = "INSERT INTO tb_truyen(ten_truyen, tac_gia, nam_xb, anh_bia)
                VALUES (:tham_so_ten, :tham_so_tg, :tham_so_xb, :tham_so_anh)";

                $stmt = $objConn -> prepare($query);
                
                $stmt -> bindParam(":tham_so_ten", $ten_truyen);
                $stmt -> bindParam(":tham_so_tg", $tac_gia);
                $stmt -> bindParam(":tham_so_xb", $nam_xb);
                $stmt -> bindParam(":tham_so_anh", $anh_bia);

                $stmt ->execute();
                $dataRes = [
                    'status' => 1,
                    'msg'    => 'them thanh cong truyen'
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

function update_truyen($idtru){
    global $objConn;
    $idtruyen = $idtru;
    $tentruyen = $_POST['tentruyen'];
    $tacgia = $_POST['tacgia'];
    $namxb = $_POST['namxb'];
    $anhbia = $_POST['anhbia'];

        try{
            $query = "UPDATE `tb_truyen` set ten_truyen=:tham_so_ten, tac_gia=:tham_so_tg, nam_xb=:tham_so_xb, anh_bia=:tham_so_bia
            WHERE id=:tham_so_id ";

            $stmt = $objConn -> prepare($query);

            $stmt -> bindParam(":tham_so_id",$idtruyen);
            $stmt -> bindParam(":tham_so_ten", $tentruyen);
            $stmt -> bindParam(":tham_so_tg", $tacgia);
            $stmt -> bindParam(":tham_so_xb", $namxb);
            $stmt -> bindParam(":tham_so_bia", $anhbia);
            
            $stmt ->execute();
            $dataRes = [
                'status' => 1,
                'msg'    => 'update thanh cong truyen'
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
if ( $method == 'GET'){
    if(empty($_GET['id'])){
        ListAlltruyen();
    }
    else{
        gettruyenbyid($_GET['id']);
    }

}
if($method == 'POST'){
    if(empty($_GET['id'])){
        addtruyen();
    }
    else{
        update_truyen($_GET['id']);
    }
}

?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>truyen</title>
</head>
<body>
<H1 style="margin-left: 100px;">Truyen</H1>
    <form action="" method="post" > 
       <li> <input type="text" name="tentruyen" placeholder="tentruyen" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="tacgia" placeholder="tacgia" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="namxb" placeholder="namxb" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="url" name="anhbia" placeholder="link anh" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <button type="submit" style="width: 300px; height: 40px; margin:10px">Send</button></li>

    </form>

</body>
</html>