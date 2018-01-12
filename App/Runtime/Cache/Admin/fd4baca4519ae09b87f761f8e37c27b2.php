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
	<script type="text/javascript">
        function openDialog(type){
            window.open('<?php echo U("Inout/expAdminuser");?>?name=<?php echo ($name); ?>&tel=<?php echo ($tel); ?>');
        }
	</script>
	<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 全部分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		备注：产品分类建议5个字以内，否则不能显示完整
	</div>
	<br>
	<table class="table table-border table-bordered table-bg">
		<thead>

		<tr class="text-c">
			<th width="20">ID</th>
			<th width="100">分类名称</th>
			<th width="60">属性</th>
			<th width="80">操作</th>
		</tr>
		</thead>


		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tr1): $mod = ($i % 2 );++$i;?><tr data-id="tr_<?php echo ($tr1["tid"]); ?>" class="text-c">
				<td><?php echo ($tr1["id"]); ?></td>
				<td style="text-align:left; padding-left:15px;">- <?php echo ($tr1["name"]); ?></td>
				<td><?php if($tr1["bz_2"] == 1): ?><font style="color:#090">推荐</font><?php endif; ?></td>
				<td>
					<a href="<?php echo U('set_tj');?>?tj_id=<?php echo ($tr1["id"]); ?>">推荐</a>
					<?php if($tr1["bz_4"] == 1): ?>| <a href="<?php echo U('add');?>?cid=<?php echo ($tr1["id"]); ?>">修改</a> |
						<a onclick="del_id_url(<?php echo ($tr1["id"]); ?>)">删除</a><?php endif; ?>
				</td>
			</tr>
			<?php if(is_array($tr1["list2"])): $i = 0; $__LIST__ = $tr1["list2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tr2): $mod = ($i % 2 );++$i;?><tr data-id="tr_<?php echo ($tr2["tid"]); ?>" class="text-c">
					<td><?php echo ($tr2["id"]); ?></td>
					<td style="text-align:left; padding-left:15px;">&nbsp; &nbsp; &nbsp;- <?php echo ($tr2["name"]); ?></td>
					<td><?php if($tr2["bz_2"] == 1): ?><font style="color:#090">推荐</font><?php endif; ?></td>
					<td>
						<a href="<?php echo U('set_tj');?>?tj_id=<?php echo ($tr2["id"]); ?>">推荐</a> |
						<a href="<?php echo U('add');?>?cid=<?php echo ($tr2["id"]); ?>">修改</a> |
						<a onclick="del_id_url(<?php echo ($tr2["id"]); ?>)">删除</a>
					</td>
				</tr>
				<?php if(is_array($tr2["list3"])): $i = 0; $__LIST__ = $tr2["list3"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tr3): $mod = ($i % 2 );++$i;?><tr data-id="tr_<?php echo ($tr3["tid"]); ?>" class="text-c">
						<td><?php echo ($tr3["id"]); ?></td>
						<td style="text-align:left; padding-left:15px;">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;- <?php echo ($tr3["name"]); ?></td>
						<td><?php if($tr3["bz_2"] == 1): ?><font style="color:#090">推荐</font><?php endif; ?></td>
						<td>
							<a href="<?php echo U('set_tj');?>?tj_id=<?php echo ($tr3["id"]); ?>">推荐</a> |
							<a href="<?php echo U('add');?>?cid=<?php echo ($tr3["id"]); ?>">修改</a> |
							<a onclick="del_id_url(<?php echo ($tr3["id"]); ?>)">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
    function del_id_url(id){
        if(confirm("确认删除吗？"))
        {
            location='<?php echo U("del");?>?did='+id;
        }
    }
</script>


</body>
</html>