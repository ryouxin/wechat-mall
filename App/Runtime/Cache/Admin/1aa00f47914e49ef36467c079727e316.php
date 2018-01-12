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

    <title>产品管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 全部产品 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <input type="text" class="input-text" style="width:250px" placeholder="产品名称" id="name" value="<?php echo ($name); ?>">
        <select class="inp_1 inp_6" id="tuijian">
            <option value="">全部产品</option>
            <option value="1" <?php echo $tuijian=='1' ? 'selected="selected"' : NULL ?>>推荐产品</option>
            <option value="0" <?php echo $tuijian=='0' ? 'selected="selected"' : NULL ?>>非推荐产品</option>
        </select>
        <button type="button" class="btn btn-success" id="" name="" onclick="product_option(0);"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </div>
    <br>
    <table class="table table-border table-bordered table-bg">
        <thead>

        <tr class="text-c">
            <th width="20">ID</th>
            <th width="100">图片</th>
            <th width="80">所属品牌</th>
            <th width="180">产品名称</th>
            <th width="40">价格/元</th>
            <th width="40">人气</th>
            <th width="40">属性(点击修改)</th>
            <th width="20">推荐</th>
            <th width="80">操作</th>
        </tr>
        </thead>


        <tbody id="news_option">
        <!-- 遍历 -->
        <?php if(is_array($productlist)): $i = 0; $__LIST__ = $productlist;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><?php echo ($v["id"]); ?></td>
                <td style="padding:3px 0;"><img src="/Data/<?php echo ($v["photo_x"]); ?>" width="80px" height="80px"/></td>
                <td><?php echo ($v["brand"]); ?></td>
                <td><?php echo ($v["name"]); ?></td>
                <td><?php echo ($v["price_yh"]); ?></td>
                <td><?php echo ($v["renqi"]); ?></td>
                <td><p id="new_<?php echo ($v["id"]); ?>"><?php if($v["is_show"] == 1): ?><a class="label blue" onclick="pro_new(<?php echo ($v["id"]); ?>,1);">新品上市<?php else: ?><a class="label err" onclick="pro_new(<?php echo ($v["id"]); ?>,0);">非新品<?php endif; ?></a></p>
                    <p id="hot_<?php echo ($v["id"]); ?>" style="margin-top:5px;"><?php if($v["is_hot"] == 1): ?><a class="label succ" onclick="pro_hot(<?php echo ($v["id"]); ?>,1);">热卖商品<?php else: ?><a class="label err" onclick="pro_hot(<?php echo ($v["id"]); ?>,0);">非热卖<?php endif; ?></a></p>
                    <!-- <p id="zk_<?php echo ($v["id"]); ?>" style="margin-top:5px;"><?php if($v["is_sale"] == 1): ?><a class="label fail" onclick="pro_zk(<?php echo ($v["id"]); ?>,1);">折扣商品<?php else: ?><a class="label err" onclick="pro_zk(<?php echo ($v["id"]); ?>,0);">非折扣<?php endif; ?></a></p> -->
                </td>
                <td><?php if($v["type"] == 1): ?><label style="color:green;">推荐</label><?php endif; ?></td>
                <td>
                    <!-- <?php if($v["pro_buff"] != ''): ?><a href="<?php echo U('Product/pro_guige');?>?pid=<?php echo ($v["id"]); ?>">
                    <?php else: ?>
                    <a href="<?php echo U('Product/set_attr');?>?pid=<?php echo ($v["id"]); ?>"><?php endif; ?><font style="color:red;">属性设置</font></a> | -->
                    <a href="<?php echo U('set_tj');?>?pro_id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&name=<?php echo ($name); ?>&shop_id=<?php echo ($shop_id); ?>&tuijian=<?php echo ($tuijian); ?>">推荐</a> |
                    <a href="<?php echo U('Product/add');?>?id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&name=<?php echo ($name); ?>&shop_id=<?php echo ($shop_id); ?>&tuijian=<?php echo ($tuijian); ?>">修改</a> |
                    <a onclick="del_id_urls(<?php echo ($v["id"]); ?>)">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
        <!-- 遍历 -->
        </tbody>
        <tr>
            <td colspan="10" class="td_2">
                <?php echo ($page_index); ?>
            </td>
        </tr>
    </table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/laypage/1.2/laypage.js"></script>


<script>
    function product_option(page){

        var pid = $('#pid').val();
        if(pid == ''){
            pid = $('#ppid').val();
        }
        var obj={
            "name":$("#name").val(),
            "shop_id":pid,
            "tuijian":$("#tuijian").val()
        }
        //alert(obj);exit();
        var url='?page='+page;
        $.each(obj,function(a,b){
            url+='&'+a+'='+b;
        });
        location=url;
    }

    function del_id_urls (pro_id) {
        if (confirm('您确定要删除吗？')) {
            location.href="<?php echo U('del');?>?did="+pro_id;
        };
    }

    //新品设置
    function pro_new(pro_id,type){
        if (!pro_id) {
            return;
        }
        $.post("<?php echo U('Product/set_new');?>",{pro_id:pro_id},function(data){
            if (data.status==1) {
                if (type==1) {
                    document.getElementById('new_'+pro_id).innerHTML='<a class="label err" onclick="pro_new('+pro_id+',0);">非新品</if></a>';
                }else{
                    document.getElementById('new_'+pro_id).innerHTML='<a class="label blue" onclick="pro_new('+pro_id+',1);">新品上市</if></a>';
                }
            }else{
                alert('操作失败，请稍后再试！');
                return false;
            }
        },'json');
    }

    //热销设置
    function pro_hot(pro_id,type){
        if (!pro_id) {
            return;
        }
        $.post("<?php echo U('Product/set_hot');?>",{pro_id:pro_id},function(data){
            if (data.status==1) {
                if (type==1) {
                    document.getElementById('hot_'+pro_id).innerHTML='<a class="label err" onclick="pro_hot('+pro_id+',0);">非热卖</if></a>';
                }else{
                    document.getElementById('hot_'+pro_id).innerHTML='<a class="label succ" onclick="pro_hot('+pro_id+',1);">热卖商品</if></a>';
                }
            }else{
                alert('操作失败，请稍后再试！');
                return false;
            }
        },'json');
    }

    //折扣设置
    function pro_zk(pro_id,type){
        if (!pro_id) {
            return;
        }
        $.post("<?php echo U('Product/set_zk');?>",{pro_id:pro_id},function(data){
            if (data.status==1) {
                if (type==1) {
                    document.getElementById('zk_'+pro_id).innerHTML='<a class="label err" onclick="pro_zk('+pro_id+',0);">非折扣</if></a>';
                }else{
                    document.getElementById('zk_'+pro_id).innerHTML='<a class="label fail" onclick="pro_zk('+pro_id+',1);">折扣商品</if></a>';
                }
            }else{
                alert('操作失败，请稍后再试！');
                return false;
            }
        },'json');
    }
</script>

</body>
</html>