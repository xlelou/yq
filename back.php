<?php

require './fun.php';

$todo = $_GET['todo'];
$todo = strlen($todo)>0 ? $todo : 'list';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/my.css">
    <script src="./js/jq-3.1.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <title>车辆数据录入</title>
</head>
<body>
    <div class="row page-body">
        <div class="col-xl-4 page-left">
            <p>车辆数据录入</p>
            <ul>                
                <li>
                    <a href="?todo=list">所有数据</a>
                </li>
                <li>
                    <a href="?todo=add">添加数据</a>
                </li>
            </ul>
        </div>
        <div class="col-xl-8 page-right">
            <?php
                if(strcmp($todo, 'list') == 0){
                    $totalsql = "select * from total";
                    $q = $mysqli->query($totalsql);
                    $totalArr = returnArray($q);
                    if(is_array($totalArr) and count($totalArr)==0){
                        echo '暂时没有数据,请先添加数据';
                    }
                    foreach($totalArr as $v){
                        $time = explode(' ',$v['date_time'])[0];
            ?>
                <p><a href="?todo=showDetail&id=<?=$v['id']?>"><?=$time?>日数据</a></p>
            <?php
                    }
                }
                if(strcmp($todo, 'add') == 0){
            ?>
                <h3>
                   一、 疫情期间市外车辆新进我市数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="city">省内市外进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" id="city" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="province">省内市外进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" id="province" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="five_province">重点五省进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" id="five_province" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="other_province">其它外省进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" id="other_province" >
                </div>
                <hr/>
                <h3>
                   二、 疫情期间市外车辆新进我市构成数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="big">大型车</label>
                    <input type="number" class="form-control col-sm-8" id="big" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="little">小型车</label>
                    <input type="number" class="form-control col-sm-8" id="little" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="gua">挂车</label>
                    <input type="number" class="form-control col-sm-8" id="gua" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="xin">新能源车</label>
                    <input type="number" class="form-control col-sm-8" id="xin" >
                </div>
                <hr>
                <h3>
                   三、 疫情期间重点五省车辆新进我市数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="e">湖北省</label>
                    <input type="number" class="form-control col-sm-8" id="e" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="x">湖南省</label>
                    <input type="number" class="form-control col-sm-8" id="x" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="y">广东省</label>
                    <input type="number" class="form-control col-sm-8" id="y" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="z">浙江省</label>
                    <input type="number" class="form-control col-sm-8" id="z" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="yu">河南省</label>
                    <input type="number" class="form-control col-sm-8" id="yu" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="date_time">选择时间</label>
                    <input type="date" class="form-control col-sm-8" id="date_time" >
                </div>
                <button id='total' class="btn btn-primary">提交保存</button>
            <script>
                function checknull(s){
                    var flag = true
                    if(s.length==0){
                        alert('数据不能为空')
                        flag = false
                    }
                    return flag
                }
                $(function(){
                    $('#total').on('click',function(){
                        var city = $('#city').val()
                        var province = $('#province').val()
                        var five_province = $('#five_province').val()
                        var other_province = $('#other_province').val()
                        var big = $('#big').val()
                        var little = $('#little').val()
                        var gua = $('#gua').val()
                        var xin = $('#xin').val()
                        var e = $('#e').val()
                        var x = $('#x').val()
                        var y = $('#y').val()
                        var z = $('#z').val()
                        var yu = $('#yu').val()
                        var date_time = $('#date_time').val()
                        if(checknull(city) && checknull(province) && checknull(five_province) && checknull(other_province) 
                        && checknull(date_time) && checknull(big) && checknull(little) && checknull(gua)
                            && checknull(xin) && checknull(e) && checknull(x) && checknull(y)
                            && checknull(z) && checknull(yu)){
                            var data = {
                                'city':city,
                                'province':province,
                                'five_province':five_province,
                                'other_province':other_province,
                                'big':big,
                                'little':little,
                                'gua':gua,
                                'xin':xin,
                                'e':e,
                                'x':x,
                                'y':y,
                                'z':z,
                                'yu':yu,
                                'date_time':date_time
                            }
                            console.log(data)
                            $.ajax({
                                url:'./backdata.php?todo=savetotal',
                                type:'post',
                                dataType:'json',
                                data:data,
                                success:(d) => {
                                    // var dd = JSON.parse(d)
                                    if(d.code==200){
                                        alert(d.msg)
                                        $('input[type="number"]').val('')
                                        $('input[type="date"]').val('')
                                    }else{
                                        alert(d.msg)
                                    }
                                },
                                error:(e) => {
                                    alert('接口请求错误，请联系开发人员')
                                }
                            })
                        }
                        
                    })
                })
            </script>        
              
            <?php
                }
                if(strcmp($todo, 'showDetail') == 0){
                    $id = $_GET['id'];
                    if(!$id>0){
                        die('参数传递错误');
                    }
                    $sql = "select * from total where id = $id";
                    $q = $mysqli->query($sql);
                    $arr = returnArray($q)[0];
                    if(is_array($arr) and count($arr)==0){
                        die('没有找到该数据');
                    }
                    $time = explode(' ',$arr['date_time'])[0];
                    // var_dump($arr);
            ?>
                <h3>
                   一、 疫情期间市外车辆新进我市数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="city">省内市外进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)($arr['city'])?>' id="city" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="province">省内市外进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['province']?>' id="province" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="five_province">重点五省进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['five_province']?>' id="five_province" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="other_province">其它外省进入我市机动车数量</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['other_province']?>' id="other_province" >
                </div>
                <hr/>
                <h3>
                   二、 疫情期间市外车辆新进我市构成数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="big">大型车</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['big']?>' id="big" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="little">小型车</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['little']?>' id="little" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="gua">挂车</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['gua']?>' id="gua" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="xin">新能源车</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['xin']?>' id="xin" >
                </div>
                <hr>
                <h3>
                   三、 疫情期间重点五省车辆新进我市数据
                </h3>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="e">湖北省</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['hubei']?>' id="e" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="x">湖南省</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['hunan']?>' id="x" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="y">广东省</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['guangdong']?>' id="y" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="z">浙江省</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['zhejiang']?>' id="z" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38' for="yu">河南省</label>
                    <input type="number" class="form-control col-sm-8" value='<?=(int)$arr['henan']?>' id="yu" >
                </div>
                <div class="form-group row">
                    <label class='col-sm-4 lh38'  for="date_time">选择时间</label>
                    <input type="date" disabled class="form-control col-sm-8" value='<?=$time?>' id="date_time" >
                </div>
                <button id='total' class="btn btn-primary">提交保存</button>
                <input type="hidden" id='id' value='<?=$id?>'>

        </div>
    </div>
    <script>
        function checknull(s){
            var flag = true
            if(s.length==0){
                alert('数据不能为空')
                flag = false
            }
            return flag
        }
        $(function(){
            $('#total').on('click',function(){
                var id = $('#id').val()
                var city = $('#city').val()
                var province = $('#province').val()
                var five_province = $('#five_province').val()
                var other_province = $('#other_province').val()
                var big = $('#big').val()
                var little = $('#little').val()
                var gua = $('#gua').val()
                var xin = $('#xin').val()
                var e = $('#e').val()
                var x = $('#x').val()
                var y = $('#y').val()
                var z = $('#z').val()
                var yu = $('#yu').val()
                var date_time = $('#date_time').val()
                if(checknull(city) && checknull(province) && checknull(five_province) && checknull(other_province) 
                && checknull(date_time) && checknull(big) && checknull(little) && checknull(gua)
                    && checknull(xin) && checknull(e) && checknull(x) && checknull(y)
                    && checknull(z) && checknull(yu) &&checknull(id)){
                    var data = {
                        'city':city,
                        'province':province,
                        'five_province':five_province,
                        'other_province':other_province,
                        'big':big,
                        'little':little,
                        'gua':gua,
                        'xin':xin,
                        'e':e,
                        'x':x,
                        'y':y,
                        'z':z,
                        'yu':yu,
                        'date_time':date_time,
                        'id':id
                    }
                    console.log(data)
                    $.ajax({
                        url:'./backdata.php?todo=updatetotal',
                        type:'post',
                        dataType:'json',
                        data:data,
                        success:(d) => {
                            // var dd = JSON.parse(d)
                            if(d.code==200){
                                alert(d.msg)
                                // window.location.href='?todo=list'
                            }else{
                                alert(d.msg)
                            }
                        },
                        error:(e) => {
                            alert('接口请求错误，请联系开发人员')
                        }
                    })
                }
                
            })
        })
    </script>
<?php
    }
    
?>


</body>
</html>
