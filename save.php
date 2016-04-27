<?php
$db = new PDO("mysql:host=localhost;dbname=shop;charset=utf8", "root", "root");
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Add
if ($action == 'add') {
    $title  = $_POST['title'];
    $icon  = $_POST['icon'];
    $hide  = isset($_POST['hide']) ? $_POST['hide'] : 0;
    $url    = $_POST['url'];
    
    $statement = $db->prepare("insert into menu (title, icon, hide, url) values ('$title', '$icon', '$hide', '$url')");
    $statement->execute();

    if ($statement->rowCount()) {
	print_message(1, 'Add Successfully!');
    } else {
	print_message(0, 'Add Failed!');
    }
}

// Edit
if ($action == 'edit') {
    $id	    = $_POST['id'];
    $title  = $_POST['title'];
    $icon  = $_POST['icon'];
    $hide  = isset($_POST['hide']) ? $_POST['hide'] : 0;
    $url    = $_POST['url'];
    
    $statement = $db->prepare("update menu set title='$title', icon='$icon', hide='$hide', url='$url' where id='$id'");
    $statement->execute();
    
    if ($statement->rowCount()) {
	print_message(1, 'Edit Successfully!');
    } else {
	print_message(0, 'Nothing modification or Edit Failed!');
    }
}

// Delete
if ($action == 'delete') {
    $id = $_POST['id'];
    
    $res = $db->query("select * from menu where pid='$id'")->fetch(PDO::FETCH_ASSOC);
    if ($res) {
	print_message(0, 'Cannot delete menu with submenu!');
    }
    
    $statement = $db->prepare("delete from menu where id='$id'");
    $statement->execute();
    
    if ($statement->rowCount()) {
	print_message(1, 'Delete Successfully!');
    } else {
	print_message(0, 'Delete Failed!');
    }
}

// Drag
if ( $action == 'drag' )
{
    $source         = $_POST['source'];
    $destination    = isset($_POST['destination']) ? $_POST['destination'] : 0;
    $orders         = isset($_POST['order']) ? json_decode($_POST['order']) : '';
    
    $statement = $db->prepare("update menu set pid='$destination' where id='$source'");
    $statement->execute();
    $affect = $statement->rowCount();

    $statement2 = $db->prepare("update menu set sort=:sort where id=:id"); 
    foreach($orders as $sort => $id){
        $statement2->bindParam(':sort', $sort);
        $statement2->bindParam(':id', $id);
        $statement2->execute();
    }
    $affect2 = $statement2->rowCount();
    
    if (!$affect && !$affect2) {
        print_message(0, 'Nothing Modification!');
    } else {
        print_message(1, 'Successfully!');
    }
}

// Return message to ajax
function print_message($status = 0, $message = '')
{
    $prompt = array('status' => $status, 'message' => $message);
  
    echo json_encode($prompt);
    exit;
}

// get menu data from db
function getMenu()
{
    global $db;
    $res = $db->query("select * from menu order by sort,id desc")->fetchAll(PDO::FETCH_ASSOC);

    return buildMenu($res);
}

// create menu
function buildMenu($menu, $parentid = 0) 
{ 
  $result = null;
  foreach ($menu as $item) 
      
    if ($item['pid'] == $parentid) {
	$item_json = json_encode($item);
        $hide_node = $item['hide'] ? '[Hidden]' : '';
	$result .= "<li class='dd-item nested-list-item' data-id='{$item['id']}'>
      <div class='dd-handle nested-list-handle'></div>
      <div class='nested-list-content'>{$item['title']}
        <span class='tip-msg'></span>
        <div class='pull-right'><span class='tip-hide'>{$hide_node}</span>
            <a href='#editModal' class='edit_toggle' rel='{$item_json}'  data-toggle='modal'>Edit</a> |
            <a href='#deleteModal' class='delete_toggle' rel='{$item['id']}' data-toggle='modal'>Delete</a>
        </div>
      </div>" . buildMenu($menu, $item['id']) . "</li>";
    } 
  return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
}
