<?php

require './fun.php';

$todo = $_GET['todo'];
$todo = strlen($todo)>0 ? $todo : 'ori';

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
    <script src='./js/echarts.min.js'></script>
    <script>
        var totalData = null;
        var map = Array.prototype.map
        var date_time,city,province,five_province,other_province
        function renderCharts(id,options){
            var dom = document.getElementById(id);
            var myChart = echarts.init(dom);
            if (options && typeof options === "object") {
                myChart.setOption(options, true);
            }
        }
    </script>
    <title>疫情趋势图</title>
</head>
<body>
    <div class="row page-body">
        <div class="col-xl-3" style='border-right:1px solid #f1f1f1;max-width:310px!important;'>
            <p>疫情趋势图展示</p>
            <ul>                
                <li>
                    <a href="?todo=ori">疫情期间市外车辆新进我市来源趋势图</a>
                </li>
                <li>
                    <a href="?todo=con">疫情期间市外车辆新进我市构成趋势图</a>
                </li>
                <li>
                    <a href="?todo=five">疫情期间重点五省车辆新进我市趋势图</a>
                </li>
            </ul>
        </div>
        <div class="col-xl-9">
            <?php
                if(strcmp($todo,'ori')==0){
            ?>
                <!-- <h1>疫情期间市外车辆新进我市来源趋势图</h1> -->
                <div id='ori' class='charts'></div>
                <script>
                  
                    

                     $(function(){
                        $.ajax({
                            url:'./backdata.php?todo=data',
                            type:'get',
                            async:false,
                            dataType:'json',
                            success:(d)=>{
                                if(d.code==200){
                                    totalData = d.data
                                }else{
                                    $('.col-xl-9').html('暂无数据，请先到后台页面添加数据')
                                }
                            },
                            error:()=>{
                                alert('接口请求错误，请联系开发人员')
                            }
                        })
                        if(totalData!=null){
                            date_time = map.call(totalData,(x)=>{return x.date_time.split(' ')[0]})
                            city = map.call(totalData,(x)=>{return x.city})
                            province = map.call(totalData,(x)=>{return x.province})
                            five_province = map.call(totalData,(x)=>{return x.five_province})
                            other_province = map.call(totalData,(x)=>{return x.other_province})
                            console.log(date_time,city,province,five_province,other_province)
                        } 

                        var option = null;
                        option = {
                            title: {
                                text: '疫情期间市外车辆新进我市来源趋势图'
                            },
                            tooltip: {
                                trigger: 'axis'
                            },
                            legend: {
                                data: ['市外新进', '省内市外', '重点五省', '其它外省'],
                                x: 'center', // 'center' | 'left' | {number},
                                y: 'bottom', // 'center' | 'bottom' | {number}
                                // bottom:'50px',
                                fontSize:'20px'
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            // toolbox: {
                            //     feature: {
                            //         saveAsImage: {}
                            //     }
                            // },
                            xAxis: {
                                type: 'category',
                                boundaryGap: true,
                                data: date_time
                            },
                            yAxis: {
                                type: 'value'
                            },
                            series: [
                                {
                                    name: '市外新进',
                                    type: 'line',
                                    stack: '车辆总数',
                                    data: city,
                                    itemStyle:{ normal: {label : {show: true}}}
                                },
                                {
                                    name: '省内市外',
                                    type: 'line',
                                    stack: '车辆总数',
                                    data: province,
                                    itemStyle:{ normal: {label : {show: true}}}
                                },
                                {
                                    name: '重点五省',
                                    type: 'line',
                                    stack: '车辆总数',
                                    data: five_province,
                                    itemStyle:{ normal: {label : {show: true}}}
                                },
                                {
                                    name: '其它外省',
                                    type: 'line',
                                    stack: '车辆总数',
                                    data: other_province,
                                    itemStyle:{ normal: {label : {show: true}}}
                                },
                            ]
                        }
                        renderCharts('ori',option)
                    })
                  
        
                </script>
            <?php
                }
            ?>
        </div>
    </div>
</body>

</html>