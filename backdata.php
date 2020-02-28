<?php
    require './fun.php';
    // $mysqli->close();
    $sql = "select * from total";
    $q = $mysqli->query($sql);
    $a = returnArray($q);


    $todo = $_GET['todo'];
    if(strcmp($todo,'savetotal')==0){
        extract($_POST);
        $sql = "select * from total where date_time = '$date_time'";
        $rs = returnArray($mysqli->query($sql));
        if(is_array($rs) and count($rs)>0){
            $r = [
                'code' =>400,
                'msg' =>'不能重复插入本日数据'
            ];
            die(json_encode($r));
        }
        $sql = "insert into total (city,province,five_province,other_province,big,little,gua,xin,hubei,hunan,guangdong,zhejiang,henan,date_time,add_time,edit_time)
        values ($city,$province,$five_province,$other_province,$big,$little,$gua,$xin,$e,$x,$y,$z,$yu,'$date_time',now(),now())";
        if($mysqli->query($sql)){
            $r = [
                'code' => 200,
                'msg' => '添加数据成功'
            ];
           
        }else{
            $r = [
                'code' =>400,
                'msg' =>'插入数据失败'
            ];
        } 
        echo json_encode($r);
    }

    if(strcmp($todo,'updatetotal')==0){
        extract($_POST);
        // $sql = "insert into total (city,province,five_province,other_province,big,little,gua,xin,hubei,hunan,guangdong,zhejiang,henan,date_time,add_time,edit_time)
        // values ($city,$province,$five_province,$other_province,$big,$little,$gua,$xin,$e,$x,$y,$z,$yu,'$date_time',now(),now())";
        $sql = "update total set city = $city,province= $province,five_province= $five_province,other_province=$other_province,
        big=$big,little=$little,gua=$gua,xin=$xin,hunan=$x,hubei=$e,guangdong=$y,zhejiang=$z,henan=$yu,edit_time=now() where id = $id";
        // echo $sql;
        if($mysqli->query($sql)){
            $r = [
                'code' => 200,
                'msg' => '更新数据成功'
            ];
           
        }else{
            $r = [
                'code' =>400,
                'msg' =>'更新数据失败'
            ];
        } 
        echo json_encode($r);
    }

    if(strcmp($todo,'data')==0){
        $sql = "select * from total order by id asc";
        $q = $mysqli->query($sql);
        $arr = returnArray($q);
        if(is_array($arr) and count($arr)>0){
            $r = [
                'code' => 200,
                'msg' => '获取数据成功',
                'data' => $arr
            ];
        }else{
            $r = [
                'code' =>400,
                'msg' =>'获取数据失败'
            ];
        }
        echo json_encode($r);
    }
?>