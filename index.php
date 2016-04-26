<?php
include 'save.php';

$menu = getMenu();
?>
<html>
<head>
  <meta charset="utf-8">
  <title>OK!</title>
  <link href="static/css/bootstrap.min.css" rel="stylesheet">
  <link href="static/css/styles.css" rel="stylesheet">
  <link href="static/vendor/nestable/nestable.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <!-- 菜单 -->
    <div class="row">
	<div class="col-md-8">  
	    <div class="well">
		<p class="lead"><a href="#newModal" class="btn btn-default pull-right" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span>新建菜单</a> 菜单：</p>
		<div class="dd" id="nestable">
		    <?php echo $menu; ?>
		</div>

		<p id="success-indicator" style="display:none; margin-right: 10px;">
		    <span class="glyphicon glyphicon-ok"></span>顺序更改成功
		</p>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      这事内容
                    </div>
                  </div>
                </div>
                
	    </div>
	</div>
	<div class="col-md-4">
	    <div class="well">
		<p>拖动菜单来调整顺序</p>
	    </div>
	</div>
    </div>

    <!-- 新建框 -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<form action="" class="form-horizontal" role="form">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">新建菜单</h4>
		    </div>
		    <div class="modal-body">
			<div class="form-group">
			    <label for="title" class="col-lg-2 control-label">标题</label>
			    <div class="col-lg-10">
				<input type="text" name="title" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="icon" class="col-lg-2 control-label">图标</label>
			    <div class="col-lg-10">
				<input type="text" name="icon" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
			    </div>
			</div>
                        <div class="form-group">
			    <label for="hide" class="col-lg-2 control-label"></label>
			    <div class="col-lg-10">
                                <input type="checkbox" name="hide" value="1" class="checkbox-inline" />隐藏
			    </div>
			</div>
		    </div>
		    <div class="modal-footer">
			<span class="success-msg text-success" style="display:none;"></span>
			<span class="fail-msg text-danger" style="display:none;"></span>
			<input type="hidden" name="add_menu" value="true" />
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<button type="submit" class="btn btn-primary">创建</button>
		    </div>
		</form>
	    </div>
	</div>
    </div>
  
    <!-- 编辑框 -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<form action="" class="form-horizontal" role="form">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">编辑菜单</h4>
		    </div>
		    <div class="modal-body">
			<div class="form-group">
			    <label for="title" class="col-lg-2 control-label">标题</label>
			    <div class="col-lg-10">
				<input type="text" name="title" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="icon" class="col-lg-2 control-label">图标</label>
			    <div class="col-lg-10">
				<input type="text" name="icon" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
			    </div>
			</div>
		    </div>
                    <div class="form-group">
			    <label for="hide" class="col-lg-2 control-label"></label>
			    <div class="col-lg-10">
                                <input type="checkbox" name="hide" value="1" class="checkbox-inline" />隐藏
			    </div>
                    </div>
		    <div class="modal-footer">
			<span class="success-msg text-success" style="display:none;"></span>
			<span class="fail-msg text-danger" style="display:none;"></span>
			<input type="hidden" name="id" value="" />
			<input type="hidden" name="edit_menu" value="true" />
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<button type="submit" class="btn btn-primary">保存</button>
		    </div>
		</form>
	    </div>
	</div>
    </div>
  
    <!-- 删除框 -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<form action="" method="post">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">确定删除</h4>
		    </div>
		    <div class="modal-body">
			<p>确认删除该菜单项吗？</p>
		    </div>
		    <div class="modal-footer">
			<span class="success-msg text-success" style="display:none;"></span>
			<span class="fail-msg text-danger" style="display:none;"></span>
			<input type="hidden" name="id" value="" />
			<input type="hidden" name="delete_menu" value="true" />
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<input type="submit" class="btn btn-danger" value="删除" />
		    </div>
		</form>
	    </div>
	</div>
    </div>

</div>

<script type="text/javascript" src='static/js/jquery-1.10.2.min.js'></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src='static/vendor/nestable/jquery.nestable.js'></script>

<script type="text/javascript">
$(function() {
    
    var submit_url = 'save.php';
    
    $('.dd').nestable({ 
      dropCallback: function(details) {

	 var order = new Array();
	 $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
	   order[index] = $(elem).attr('data-id');
	 });

	 if (order.length === 0){
	  var rootOrder = new Array();
	  $("#nestable > ol > li").each(function(index,elem) {
	    rootOrder[index] = $(elem).attr('data-id');
	  });
	 }

	 $.post(submit_url, 
	  {
	      source : details.sourceId,
	      destination: details.destId,
	      order:JSON.stringify(order),
	      rootOrder:JSON.stringify(rootOrder) 
	  }, 
	  function(data) {
              $("li[data-id='"+details.destId +"']").attr({'data-content':data.message, 'data-toggle':"popover"}).popover();
	  })
	 .done(function() { 
	    $( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
	 })
	 .fail(function() {  })
	 .always(function() { 
	  });
       }
     });

    // 新建、修改、删除功能通过Ajax提交
    $('form').on('submit', function(e){
	e.preventDefault();
	var form = $(this);
	
	$.post(submit_url, form.serialize(), function(result){
	    if (result.status) {
		form.find(".success-msg").html(result.message).fadeIn(100).delay(1000).fadeOut();
		setTimeout(function(){location.reload();}, 1000);
	    } else {
		form.find(".fail-msg").html(result.message).fadeIn(100).delay(1000).fadeOut();
		return;
	    }
	}, 'json').fail(function(result){alert("失败：" + result.status + "：" + result.message);return ;});
    });

    // 点击编辑按钮时，加载 要删除的menu id
    $('.delete_toggle').click(function(e){
	e.preventDefault();
	$('#deleteModal').find('input[name=id]').val( $(this).attr('rel') );
    });

    // 点击编辑按钮时，加载menu数据
    $('.edit_toggle').click(function(e){
	  e.preventDefault();
	  var menu = JSON.parse( $(this).attr('rel') );
	  $.each(menu, function(key, value) {
	      $('#editModal').find('input[type!=checkbox][name='+key+']').val(value);
              $('#editModal').find('input[type=checkbox][name='+key+']').attr('checked', (value==1)?true:false);
	  });
    });
    
});
</script>

</body>
</html>
