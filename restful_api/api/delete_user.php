

<?php
function delete_user(){
    $idusr = $_POST['iduser'];
    global $objConn;
        try{
            $query = "DELETE FROM tb_binh_luan WHERE id_user=:tham_so_iduser";
            $stmt = $objConn -> prepare($query);
            $stmt -> bindParam(":tham_so_iduser",$idusr);
            $stmt -> execute();
            $query2 = "DELETE FROM tb_user WHERE id=:tham_so_id";
            $stmt2 = $objConn ->prepare($query2);
            $stmt2 -> bindParam(":tham_so_id",$idusr);
            $stmt2 -> execute();
            $dataRes = [
                'status' => 1,
                'msg'    => 'xoa thanh cong'
            ];
           
        }catch(Exception $e){
            $dataRes = [
                'status' => 0,
                'msg'    => 'xoa that bai' .$e->getMessage(),
            ];
        }
        echo json_encode($dataRes);
}

$method = $_SERVER['REQUEST_METHOD'];
if($method=="POST"){
    delete_user();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete user</title>
</head>
<body>

<H1 style="margin-left: 100px;">delete user</H1>
    <form action="" method="POST" > 
       <li> <input type="text" name="iduser" placeholder="iduser" style="width: 300px; height: 40px; margin:10px"></li>   
       <li> <button type="submit" style="width: 300px; height: 40px; margin:10px">Send data</button></li>
    </form>
    


</body>
</html>