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
    <script type="text/javascript" src="/Public/admin/js/action.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jquery.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>

    <![endif]-->

    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
    <link href="/Public/admin/css/main.css" rel="stylesheet" type="text/css" />

    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <script type="text/css">
        .Hui-article-box {
            position: absolute;
            top: 10px;
            right: 0;
            bottom: 0;
            left: 199px;
            overflow: hidden;
            z-index: 1;
            background-color: #fff;
        }
    </script>
    <title>小程序商城后台管理系统</title>
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#">小程序商城后台管理系统</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a>


            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li><?php echo $_SESSION['admininfo']['name']; ?></li>
                    <li><a href="<?php echo U('Login/logout');?>">退出</a></li>


                </ul>
            </nav>
        </div>
    </div>
</header>

<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i> 综合管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>

                    <li>
                        <a data-title="小程序配置" data-href="<?php echo U('More/setup');?>" href="<?php echo U('More/setup');?>" target="iframe" >小程序配置</a>
                    </li>

                </ul>
            </dd>
        </dl>
        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-title="添加产品" data-href="<?php echo U('Product/add');?>" href="<?php echo U('Product/add');?>" target="iframe">添加产品</a>
                    </li>
                    <li>
                        <a data-title="产品管理" data-href="<?php echo U('Product/index');?>" href="<?php echo U('Product/index');?>" target="iframe">产品管理</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe620;</i> 品牌管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-title="添加品牌" data-href="<?php echo U('Brand/add');?>" href="<?php echo U('Brand/add');?>" target="iframe">添加品牌</a>
                    </li>
                    <li>
                        <a data-title="品牌管理" data-href="<?php echo U('Brand/index');?>" href="<?php echo U('Brand/index');?>" target="iframe">全部品牌</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo U('User/index');?>" data-title="会员管理" href="<?php echo U('User/index');?>" target="iframe">会员管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo U('Adminuser/add');?>" data-title="添加管理员" href="<?php echo U('Adminuser/add');?>" target="iframe">添加管理员</a></li>
                    <li><a data-href="<?php echo U('Adminuser/adminuser');?>" data-title="管理员管理" href="<?php echo U('Adminuser/adminuser');?>" target="iframe">管理员管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-title="全部订单" data-href="<?php echo U('Order/index');?>" href="<?php echo U('Order/index');?>" target="iframe">全部订单</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i> 分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-title="添加分类" data-href="<?php echo U('Category/add');?>" href="<?php echo U('Category/add');?>" target="iframe">添加分类</a>
                    </li>
                    <li>
                        <a data-title="分类管理" data-href="<?php echo U('Category/index');?>" href="<?php echo U('Category/index');?>" target="iframe">分类管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-tongji1">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 优惠券管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-title="添加优惠券" data-href="<?php echo U('Voucher/add');?>" href="<?php echo U('Voucher/add');?>" target="iframe">添加优惠券</a>
                    </li>
                    <li>
                        <a data-title="优惠券管理" data-href="<?php echo U('Voucher/index');?>" href="<?php echo U('Voucher/index');?>" target="iframe">优惠券管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-tongji2">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 广告管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-title="添加广告" data-href="<?php echo U('Guanggao/add');?>" href="<?php echo U('Guanggao/add');?>" target="iframe">添加广告</a>
                    </li>

                    <li>
                        <a data-title="广告管理" data-href="<?php echo U('Guanggao/index');?>" href="<?php echo U('Guanggao/index');?>" target="iframe">广告管理</a>
                    </li>

                </ul>
            </dd>
        </dl>
    </div>

</aside>


<section class="Hui-article-box">

    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <iframe src='<?php echo U("Page/adminindex");?>' id='iframe' name='iframe'></iframe>
        </div>
    </div>
</section>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
    $(function(){
        /*$("#min_title_list li").contextMenu('Huiadminmenu', {
         bindings: {
         'closethis': function(t) {
         console.log(t);
         if(t.find("i")){
         t.find("i").trigger("click");
         }
         },
         'closeall': function(t) {
         alert('Trigger was '+t.id+'\nAction was Email');
         },
         }
         });*/
    });



</script>

</body>
</html>