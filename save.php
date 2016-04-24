<?php
$db = new PDO('mysql:host=localhost;dbname=shopdb', 'root', 'root');

/**
 * 返回 ajax 数据
 * @param bool $status 状态，0-失败，1-成功
 * @param string $message 提示信息
 */
function print_message($status = 0, $message = '')
{
    $prompt = array('message' => $message);
    
    if ($status) {
	$prompt['status'] = 1;
    } else {
	$prompt['status'] = 0;
    }
    
    echo json_encode($prompt);
    exit;
}

// 添加菜单
if (isset($_POST['add_menu'])) {
    $title  = $_POST['title'];
    $label  = $_POST['label'];
    $url    = $_POST['url'];
    
    $res = $db->prepare("insert into menu (title, label, url) values ('$title', '$label', '$url')")->execute();
    
    if ($res) {
	print_message(1, '添加菜单成功！');
    } else {
	print_message(0, '添加菜单失败！');
    }
}

// 编辑菜单
if ( isset($_POST['edit_menu']) ) {
    $id	    = $_POST['id'];
    $title  = $_POST['title'];
    $label  = $_POST['label'];
    $url    = $_POST['url'];
    
    $res = $db->prepare("update menu set title='$title', label='$label', url='$url' where id='$id'")->execute();
    if ($res) {
	print_message(1, '修改菜单成功！');
    } else {
	print_message(0, '修改菜单失败！');
    }
}

// 删除菜单
if ( isset($_POST['delete_menu']) ) {
    $id = $_POST['id'];
    
    $res = $db->query("select * from menu where parent_id='$id'")->fetch(PDO::FETCH_ASSOC);
    if ($res) {
	print_message(0, '菜单下有子菜单，无法删除！');
    }
    
    $res = $db->prepare("delete from menu where id='$id'")->execute();
    if ($res) {
	print_message(1, '删除菜单成功！');
    } else {
	print_message(0, '删除菜单失败！');
    }
}

// 拖动编辑，ajax处理
if ( isset($_POST['source']) )
{
    $source       = $_POST['source'];
    $destination  = isset($_POST['destination']) ? $_POST['destination'] : 0;

    $db->prepare("update menu parent_id='$destination' where id='$source'")->execute();

    $ordering       = json_decode($_POST['order']);
    $rootOrdering   = json_decode($_POST['rootOrder']);

    if($ordering){
      foreach($ordering as $order=>$item_id){
	if($itemToOrder = Menu::find($item_id)){
	    $itemToOrder->order = $order;
	    $itemToOrder->save();
	}
      }
    } else {
      foreach($rootOrdering as $order=>$item_id){
	if($itemToOrder = Menu::find($item_id)){
	    $itemToOrder->order = $order;
	    $itemToOrder->save();
	}
      }
    }

    return 'ok ';
}

return false;