<?php
$db = new PDO('mysql:host=localhost;dbname=shopdb', 'root', 'root');
$menus = $db->query("select * from menu")->fetchAll(PDO::FETCH_ASSOC);

function buildMenu($menu, $parentid = 0) 
{ 
  $result = null;
  foreach ($menu as $item) 
      
    if ($item['parent_id'] == $parentid) {
	$item_json = json_encode($item);
	$result .= "<li class='dd-item nested-list-item' data-order='{$item['order']}' data-id='{$item['id']}'>
      <div class='dd-handle nested-list-handle'>
	<span class='glyphicon glyphicon-move'></span>
      </div>
      <div class='nested-list-content'>{$item['title']}
	<div class='pull-right'>
	  <a href='#editModal' class='edit_toggle' rel='{$item_json}'  data-toggle='modal'>编辑</a> |
	  <a href='#deleteModal' class='delete_toggle' rel='{$item['id']}' data-toggle='modal'>删除</a>
	</div>
      </div>" . buildMenu($menu, $item['id']) . "</li>";
    } 
  return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
} 

$menu = buildMenu($menus);

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
			    <label for="label" class="col-lg-2 control-label">Label</label>
			    <div class="col-lg-10">
				<input type="text" name="label" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
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
			    <label for="label" class="col-lg-2 control-label">Label</label>
			    <div class="col-lg-10">
				<input type="text" name="label" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
			    </div>
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
    
    var submit_page = 'save.php';
    
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

	 $.post(submit_page, 
	  {
	      source : details.sourceId,
	      destination: details.destId,
	      order:JSON.stringify(order),
	      rootOrder:JSON.stringify(rootOrder) 
	  }, 
	  function(data) {
	 //   console.log('data '+data); 
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
	
	$.post(submit_page, form.serialize(), function(result){
	    if (result.status) {
		form.find(".success-msg").html(result.message).fadeIn(100).delay(1500).fadeOut();
		location.reload();
	    } else {
		form.find(".fail-msg").html(result.message).fadeIn(100).delay(1500).fadeOut();
		return;
	    }
	}, 'json');
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
	      $('#editModal').find('input[name='+key+']').val(value);
	  });
    });

});
</script>

</body>
</html>
