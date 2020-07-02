<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入库记录列表</title>

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
    <li><a href="<?php echo U('index/index');?>"><i class="fa fa-dashboard"></i>后台首页</a></li>   
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

	<div class="row">
		<div class="col-md-6">
			<a href="<?php echo U('Instore/add');?>" class="btn btn-success">新增</a>
		</div>
		<div class="col-md-6">
			<form action="<?php echo U('Instore/index');?>" method="post">
				<div class="form-group input-group">
					<input type="text" class="form-control" name="key" placeholder="输入产品名称、分类或者添加人关键词搜索">
					<span class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
				</div>
			</form>
		</div>
	</div>
	<table class="table table-hover table-striped">
		<thead>
			<tr>				
				<th>产品名称</th>
				<th>所属分类</th>	
				<th>产品数量</th>
				<th>产品单价</th>
				<th>入库时间</th>
				<th>操作员</th>						
				<th>详情</th>				
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($model)): foreach($model as $key=>$v): ?><tr>				
					<td><?php echo ($v["product_name"]); ?></td>
					<td><?php echo ($v["category_name"]); ?></td>					
					<td><?php echo ($v["instore_count"]); ?></td>					
					<td><?php echo ($v["goods_price"]); ?></td>					
					<td><?php echo (date("Y/m/d H:i:s",$v["instore_time"])); ?></td>
					<td><?php echo ($v["username"]); ?></td>																					
					<td><?php echo ($v["instore_remarks"]); ?></td>																
					<td><a href="<?php echo U('Instore/update?id='); echo ($v["id"]); ?>">编辑</a> | <a href="<?php echo U('Instore/delete?id='); echo ($v["id"]); ?>" style="color:red;" onclick="javascript:return del('您真的确定要删除吗？\n\n删除后将不能恢复!');">删除</a></td>					
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	<div class="clearfix"></div>
	<?php echo ($page); ?>

</div>
<!-- JavaScript -->
<script src="/Test/wms/Application/Admin/View//Public/static/js/jquery-1.10.2.js"></script>
<script src="/Test/wms/Application/Admin/View//Public/static/js/bootstrap.js"></script>
<script src="/Test/wms/Application/Admin/View//Public/static/js/app.js"></script>

</body>
</html>