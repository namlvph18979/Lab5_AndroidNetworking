
<?php
function delete_truyen(){
    $idtry = $_POST['idtruyen'];
    global $objConn;
        try{
            $query = "DELETE FROM tb_binh_luan WHERE id_truyen=:tham_so_idtruyen";
            $stmt = $objConn -> prepare($query);
            $stmt -> bindParam(":tham_so_idtruyen",$idtry);
            $stmt -> execute();

            $query = "DELETE FROM tb_img_content WHERE id_truyen=:tham_so_idtruyen";
            $stmt1 = $objConn -> prepare($query);
            $stmt1 -> bindParam(":tham_so_idtruyen",$idtry);
            $stmt1 -> execute();

            $query2 = "DELETE FROM tb_truyen WHERE id=:tham_so_id";
            $stmt2 = $objConn ->prepare($query2);
            $stmt2 -> bindParam(":tham_so_id",$idtry);
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
    delete_truyen();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete truyen</title>
</head>
<body>

<H1 style="margin-left: 100px;">delete truyen</H1>
    <form action="" method="POST" > 
       <li> <input type="text" name="idtruyen" placeholder="idtruyen" style="width: 300px; height: 40px; margin:10px"></li>   
       <li> <button type="submit" style="width: 300px; height: 40px; margin:10px">Send data</button></li>
    </form>
    


</body>
</html>