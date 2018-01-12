<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/Public/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/admin/js/action.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jCalendar.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jquery.XYTipsWindow.min.2.8.js"></script>
    <script type="text/javascript" src="/Public/admin/js/mydate.js"></script>
    <link href="/Public/admin/css/order.css" rel="stylesheet" type="text/css" />

    <title>全部订单</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 全部订单 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <!--<div>-->
        <!--<div class="aaa_pts_4"><a href="<?php echo U('order_count');?>?shop_id=<?php echo ($shop_id); ?>" class="btn btn-success">销售统计</a></div>-->

    <!--</div>-->
    <!--<br>-->
    <!--<div style="border-bottom:1px solid #333;"></div>-->
    <!--<br>-->
    <form name='form' action="<?php echo U('index');?>" method='get'>
        <div class="pro_4 bord_1">
            <div class="pro_5">
                支付类型：
                <select class="inp_1 inp_6" name="pay_type" id="type">
                    <option value="">全部类型</option>
                    <option value="weixin" <?php echo $pay_type=='weixin' ? 'selected="selected"' : NULL ?>>微信支付</option>
                    <option value="cash" <?php echo $pay_type=='cash' ? 'selected="selected"' : NULL ?>>现金支付</option>
                </select>
            </div>

            <div class="pro_5">
                订单状态：
                <select class="inp_1 inp_6" name="pay_status" id="status">
                    <option value="">全部状态</option>
                    <?php foreach ($order_status as $key => $val) { ?>
                    <option value="<?php echo $key; ?>" <?php if ($pay_status==$key) { ?>selected="selected"<?php } ?> ><?php echo $val; ?></option>
                    <?php } ?>
                    <option value="1" <?php if ($pay_status==1) { ?>selected="selected"<?php } ?> >退款中</option>
                    <option value="2" <?php if ($pay_status==2) { ?>selected="selected"<?php } ?> >已退款</option>
                </select>
            </div>

            <div class="pro_5">
                购买时间：
                <input class="inp_1 inp_6" id="start_time" name="start_time" value="<?php echo $start_time ?>" onfocus="MyCalendar.SetDate(this)">
                <input class="inp_1 inp_6" id="end_time" name="end_time" value="<?php echo $end_time ?>" onfocus="MyCalendar.SetDate(this)">
                <input class="btn btn-success" type="button"  value="搜 索" style="margin-left: 20px;" onclick="product_option();">
            </div>
            <div class="pro_6">


            </div>
        </div>
    </form>
    <br>
    <table class="table table-border table-bordered table-bg">
        <thead>

        <tr class="text-c">
            <th width="40">订单ID</th>
            <th width="150">买家</th>
            <th width="130">总金额</th>
            <th width="80">支付类型</th>
            <th width="100">订单状态</th>
            <th width="100">订单时间</th>
            <th width="100">操作</th>
        </tr>
        </thead>



        <?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($order["id"]); ?>" data-name="<?php echo ($order["name"]); ?>" class="text-c">
                <td><?php echo ($order["id"]); ?></td>
                <td><?php echo ($order["u_name"]); ?></td>
                <td><?php echo ($order["price"]); ?></td>
                <td><?php if($order["type"] == 'alipay'): ?>支付宝<?php elseif($order["type"] == 'weixin'): ?>微信支付<?php else: ?>现金支付<?php endif; ?></td>
                <td class="status">
                    <?php if($order["back"] == 1): ?><font style="color:red">申请退款</font>
                        <?php elseif($order["back"] == 2): ?><font style="color:#900">已退款</font>
                        <?php else: ?>
                        <font class='font_color'><?php echo $order_status[$order['status']]; ?></font><?php endif; ?>
                </td>
                <td><?php echo (date('Y-m-d H:i',$order["addtime"])); ?></td>
                <td>
                    <a href="<?php echo U('show');?>?oid=<?php echo ($order["id"]); ?>">查看</a> |
                    <a onclick="del_id_url(<?php echo ($order["id"]); ?>)">删除</a>
                    <?php if($order["back"] == 1): ?>| <a href="<?php echo U('back');?>?oid=<?php echo ($order["id"]); ?>">确认退款</a><?php endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr class="text-c">
            <td colspan="10" class="td_2">
                <?php echo ($page); ?>
            </td>
        </tr>
    </table>
</div>

<script>
    //搜索按钮点击事件
    function product_option(){
        $('form').submit();
    }

    function openDialog(){
        //alert('aaa');die();
        location="<?php echo U('Inout/expOrder');?>";
    }

    function openDialog2(){
        var shop_id = $('#shop_id').val();
        var type = $('#type').val();
        var status = $('#status').val();
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        //alert('aaa');die();
        location="<?php echo U('Inout/expOrder');?>?shop_id="+shop_id+"&type="+type+"&status="+status+"&start_time="+start_time+'&end_time='+end_time;
    }

    //订单状态字体颜色设置
    $('.font_color').each(function(index, element) {
        var obj = $(this);
        switch(obj.html()){
            case '待发货':
            case '交易完成':
            case '待收货':
                obj.css('color','#090');
                break;
            case '交易关闭':
            case '已退款':
                obj.css('color','#900');
                break;
            case '申请退款':
                obj.css('color','#f00');
            default:
                obj.css('color','#063559');
                break;
        }
    });

    //选择商家按钮事件
    function win_open(url,width,height){

        height==null ? height=600 : height;
        width==null ?  width=800 : width;
        var myDate=new Date()
        window.open(url,'newwindow'+myDate.getSeconds(),'height='+height+',width='+width);
    }

    //订单删除方法
    function del_id_url(id){
        if(confirm("确认删除吗？"))
        {
            location='<?php echo U("del");?>?did='+id;
        }
    }
</script>

</body>
</html>