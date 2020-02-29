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
        var date_time,city,province,five_province,other_province,big,little,gua,xin,ee,x,y,z,yu;
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
                        big = map.call(totalData,(x)=>{return x.big})
                        little = map.call(totalData,(x)=>{return x.little})
                        gua = map.call(totalData,(x)=>{return x.gua})
                        xin = map.call(totalData,(x)=>{return x.xin})
                        ee = map.call(totalData,(x)=>{return x.hubei})
                        x = map.call(totalData,(x)=>{return x.hunan})
                        y = map.call(totalData,(x)=>{return x.guangdong})
                        z = map.call(totalData,(x)=>{return x.zhejiang})
                        yu = map.call(totalData,(x)=>{return x.henan})
                    } 

                    var option = null,option_f=null,option_c=null;
                    option = {
                        title: {
                            text: '疫情期间市外车辆新进我市来源趋势图'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['市外新进', '省内市外', '重点五省', '其它外省'],
                            x: 'right', // 'center' | 'left' | {number},
                            y: 'top', // 'center' | 'bottom' | {number}
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
                                // stack: '车辆总数',
                                data: city,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '省内市外',
                                type: 'line',
                                // stack: '车辆总数',
                                data: province,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '重点五省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: five_province,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '其它外省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: other_province,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                        ]
                    }
                    option_c = {
                        title: {
                            text: '疫情期间市外车辆新进我市构成趋势图'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['大型汽车', '小型汽车', '挂车', '新能源汽车'],
                            x: 'right', // 'center' | 'left' | {number},
                            y: 'top', // 'center' | 'bottom' | {number}
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
                                name: '大型汽车',
                                type: 'line',
                                // stack: '车辆总数',
                                data: big, 
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '小型汽车',
                                type: 'line',
                                // stack: '车辆总数',
                                data: little,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '挂车',
                                type: 'line',
                                // stack: '车辆总数',
                                data: gua,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '新能源汽车',
                                type: 'line',
                                // stack: '车辆总数',
                                data: xin,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                        ]
                    }
                    option_f = {
                        title: {
                            text: '疫情期间重点五省车辆新进我市趋势图'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['湖北省', '湖南省', '广东省', '浙江省','河南省'],
                            x: 'right', // 'center' | 'left' | {number},
                            y: 'top', // 'center' | 'bottom' | {number}
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
                                name: '湖北省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: ee, 
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '湖南省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: x,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '广东省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: y,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '浙江省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: z,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                            {
                                name: '河南省',
                                type: 'line',
                                // stack: '车辆总数',
                                data: yu,
                                itemStyle:{ normal: {label : {show: true}}}
                            },
                        ]
                    }
                <?php
                    if(strcmp($todo,'ori')==0){
                ?>
                    renderCharts('ori',option)
                <?php
                    }
                ?>
                    <?php
                    if(strcmp($todo,'con')==0){
                ?>
                    renderCharts('ori',option_c)
                <?php
                    }
                ?>
                <?php
                    if(strcmp($todo,'five')==0){
                ?>
                    console.log(ee,x,y,z,yu)
                    renderCharts('ori',option_f)
                <?php
                    }
                ?>
                })
            </script>
        </div>
    </div>
</body>

</html>