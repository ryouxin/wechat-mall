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
    <script type="text/javascript" src="/minipetmrschool/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/minipetmrschool/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/minipetmrschool/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/minipetmrschool/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/minipetmrschool/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/minipetmrschool/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/minipetmrschool/Public/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/minipetmrschool/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/minipetmrschool/Public/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/minipetmrschool/Public/admin/js/action.js"></script>

    <title>新增分类</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 新增分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form class="form form-horizontal" action="<?php echo U('save');?>" method="post" onsubmit="return ac_from();" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属分类：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <select class="inp_1" name="tid" id="tid">
                    <option value="0">一级分类</option>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op1): $mod = ($i % 2 );++$i; if($op1["id"] == $cate_info['tid']): ?><option value="<?php echo ($op1["id"]); ?>" id="cate_<?php echo ($op1["id"]); ?>" name="one" selected="selected">- <?php echo ($op1["name"]); ?></option>
                            <?php else: ?>
                            <option value="<?php echo ($op1["id"]); ?>" id="cate_<?php echo ($op1["id"]); ?>" name="one">- <?php echo ($op1["name"]); ?></option><?php endif; ?>
                        <?php if(is_array($op1['list2'])): $i = 0; $__LIST__ = $op1['list2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op2): $mod = ($i % 2 );++$i; if($op2["id"] == $cate_info['tid']): ?><option value="<?php echo ($op2["id"]); ?>" id="cate_<?php echo ($op2["id"]); ?>" name="two" selected="selected">&nbsp; &nbsp;- <?php echo ($op2["name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($op2["id"]); ?>" id="cate_<?php echo ($op2["id"]); ?>" name="two">&nbsp; &nbsp;- <?php echo ($op2["name"]); ?></option><?php endif; ?>
                            <?php if(is_array($op2['list3'])): $i = 0; $__LIST__ = $op2['list3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($op3["id"]); ?>" id="cate_<?php echo ($op3["id"]); ?>" name="three">&nbsp; &nbsp;&nbsp; &nbsp;- <?php echo ($op3["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分类名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="分类名称" name="name" id="name" value="<?php echo $cate_info['name']; ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>略缩图，图片大小200*200</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type='hidden' name="bz_1" id="photo_sj0" value="<?php echo $cate_info['bz_1']; ?>">
                <?php if ($cate_info['bz_1']) { ?>
                <img src="/minipetmrschool/Data/<?php echo $cate_info['bz_1']; ?>" width="200" height="200" />
                <?php } ?>
                <input type="file" name="file2" id="bz_1" />
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分类介绍：</label>
            <div class="formControls col-xs-8 col-sm-8">
                <textarea class="inp_1 inp_8" name="concent" id="concent" /><?php echo $cate_info['concent']; ?></textarea>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排 序：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="排序" name="sort" id="sort" value="<?php echo $cate_info['sort']; ?>">
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" name="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                <input type="hidden" name="cid" id="cid" value="<?php echo $cate_info['id']; ?>">
            </div>
        </div>
    </form>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/minipetmrschool/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/minipetmrschool/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/minipetmrschool/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/minipetmrschool/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/minipetmrschool/Public/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/minipetmrschool/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/minipetmrschool/Public/admin/lib/laypage/1.2/laypage.js"></script>




</body>
</html>