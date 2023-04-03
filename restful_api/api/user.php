


<?php
    function ListAllUser(){
        global $objConn;
        try{

            $sql_get = "SELECT * FROM tb_user";
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

    function getUserbyid($iduser){
        global $objConn;
        try{

            $sql_getbyid = "SELECT * FROM tb_user WHERE id =? LiMIT 1";
            $stmt = $objConn->prepare($sql_getbyid);
            $stmt -> bindParam(1,$iduser);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt -> fetch();

            echo json_encode($user);
            $abc = $user;
            
            
        }catch(Exception $e){
            die('loi thuc hien truy va co so du lieu' .$e->getMessage());
        }
    }

    function adduser(){
        global $objConn;
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        if(empty($username) || empty($password) || empty($email) || empty($fullname)){
            $dataRes = [
                'status' => 1,
                'msg'    => 'khong de trong thong tin'
            ];
        }else{

        
            try{
                $query = "INSERT INTO tb_user(username, password, email, fullname)
                VALUES (:tham_so_name, :tham_so_pass, :tham_so_email, :tham_so_fullname)";

                $stmt = $objConn -> prepare($query);
                
                $stmt -> bindParam(":tham_so_name", $username);
                $stmt -> bindParam(":tham_so_pass", $password);
                $stmt -> bindParam(":tham_so_email", $email);
                $stmt -> bindParam(":tham_so_fullname", $fullname);

                $stmt ->execute();
                $dataRes = [
                    'status' => 1,
                    'msg'    => 'them thanh cong user'
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

function update_user($idusr){
    global $objConn;
    $iduser = $idusr;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];

        try{
            $query = "UPDATE `tb_user` set username=:tham_so_name, password=:tham_so_pass, email=:tham_so_mail, fullname=:tham_so_fullname
            WHERE id=:tham_so_id ";

            $stmt = $objConn -> prepare($query);

            $stmt -> bindParam(":tham_so_id",$iduser);
            $stmt -> bindParam(":tham_so_name", $username);
            $stmt -> bindParam(":tham_so_pass", $password);
            $stmt -> bindParam(":tham_so_mail", $email);
            $stmt -> bindParam(":tham_so_fullname", $fullname);
            
            $stmt ->execute();
            $dataRes = [
                'status' => 1,
                'msg'    => 'update thanh cong user'
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
            ListAllUser();
        }
        else{
            getUserbyid($_GET['id']);
        }

    }
    
    if($method == 'POST'){
        if(empty($_GET['id'])){
            adduser();
        }
        else{
            update_user($_GET['id']);
        }
        
    }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
</head>
<body>

<H1 style="margin-left: 100px;">User</H1>
    <form action="" method="post" > 
       <li> <input type="text" name="username" placeholder="username" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="password" placeholder="password" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="email" name="email" placeholder="email" style="width: 300px; height: 40px; margin:10px"></li>
       <li> <input type="text" name="fullname" placeholder="fullname"  style="width: 300px; height: 40px; margin:10px"></li>
       <li> <button type="submit" style="width: 300px; height: 40px; margin:10px">Send data</button></li>
    </form>
    


</body>
</html>