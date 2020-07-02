<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑文章</title>

    <!-- Bootstrap core CSS -->
    <link href="/Test/wms/Application/Admin/View//Public/static/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="/Test/wms/Application/Admin/View//Public/static/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="/Test/wms/Application/Admin/View//Public/static/font-awesome/css/font-awesome.min.css">
</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo U('index/index');?>">管理后台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo U('index/index');?>"><i class="fa fa-dashboard"></i> 仪表盘</a></li>   
	<li class="dropdown">
        <a href="<?php echo U('Product/index');?>"><i class="fa fa-reorder"></i> 产品信息</a>
    </li>
    <li class="dropdown">
        <a href="<?php echo U('instore/index');?>"><i class="fa fa-edit"></i> 入库管理</a>
    </li>
	<li class="dropdown">
        <a href="<?php echo U('Outstore/index');?>"><i class="fa fa-edit"></i> 出库管理</a>
    </li>
	<li class="dropdown">
        <a href="<?php echo U('Stock/index');?>"><i class="fa fa-users"></i> 库存管理</a>  
    </li>     
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> 系统设置 <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <!-- <li><a href="<?php echo U('setting/index');?>">自定义字段</a></li> -->
            <li><a href="<?php echo U('category/index');?>">分类管理</a></li>
            <li><a href="<?php echo U('member/index');?>">用户管理</a></li>
        </ul>
    </li>
</ul>

            <ul class="nav navbar-nav navbar-right navbar-user">

                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 你好,<?php echo session('username');?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-gear"></i> 设置</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('login/logout');?>"><i class="fa fa-power-off"></i> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
<div id="page-wrapper">
    <form method="post" action="<?php echo U('post/update?id='); echo ($category["id"]); ?>">
        <div class="form-group">
            <label for="post-title">货物名称</label>
            <input type="text" name="goods_name" class="form-control" id="post-title" value="<?php echo ($instore["pid"]); ?>">
        </div>
		<div class="form-group">
            <label for="post-title">入库数量</label>
            <input type="text" name="instore_count" class="form-control" id="post-title" value="<?php echo ($instore["instore_count"]); ?>">
        </div>
		<div class="form-group">
            <label for="post-title">货物单价</label>
            <input type="text" name="goods_price" class="form-control" id="post-title" value="<?php echo ($instore["goods_price"]); ?>">
        </div>
        <div class="form-group">
            <label for="post-cate">分类</label>
            <select name="cate_id" id="post-cate" class="form-control">
                <?php if(is_array($category)): foreach($category as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($post['cate_id'] == $v['id']) {echo 'selected="selected"' ;}?>><?php echo ($v["html"]); ?> <?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post-content">入库备注</label>
            <textarea name="instore_remarks" class="form-control" id="post-title" placeholder="<?php echo ($instore["instore_remarks"]); ?>"></textarea>
        </div>              
        <input type="hidden" name="id" value="<?php echo ($post["id"]); ?>">
        <button type="submit" class="btn btn-default">提交</button>
    </form>
</div>

<!-- JavaScript -->
<script src="/Test/wms/Application/Admin/View//Public/static/js/jquery-1.10.2.js"></script>
<script src="/Test/wms/Application/Admin/View//Public/static/js/bootstrap.js"></script>
<script src="/Test/wms/Application/Admin/View//Public/static/js/app.js"></script>

</body>
</html>