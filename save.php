<?php
require 'JsonDb/JsonDb.php';

$json = new JsonDb('menus');
$action = isset($_GET['action']) ? $_GET['action'] : '';

function getPost($keys, $default = null)
{
    if (!is_array($keys)) {
        return isset($_POST[$keys]) ? $_POST[$keys] : $default;
    }

    $post = [];
    foreach ($keys as $key) {
        $post[$key] = isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    return $post;
}

// Add
if ($action == 'add') {
    $data = getPost(['title', 'icon', 'url']);
    $data['hide'] = getPost('hide', 0);
    $data['pid'] = getPost('pid', 0);

    $res = $json->insert($data);

    if ($res) {
        print_message(1, 'Add Successfully!');
    } else {
        print_message(0, $json->error);
    }
}

// Edit
if ($action == 'edit') {
    $data = getPost(['title', 'icon', 'url']);
    $data['hide'] = getPost('hide', 0);
    $data['id'] = getPost('id');

    if ($json->update($data)) {
        print_message(1, 'Edit Successfully!');
    } else {
        print_message(0, $json->error);
    }
}

// Delete
if ($action == 'delete') {
    $id = getPost('id');

    // if there is any submenu bellow this menu
    $menus = $json->selectAll();
    $parentIds = array_column($menus, 'pid');
    if (in_array($id, $parentIds))
    {
        print_message(0, 'Cannot delete menu with submenu!');
    }

    if ($json->delete($id)) {
        print_message(1, 'Delete Successfully!');
    } else {
        print_message(0, 'Delete Failed!');
    }
}

// Drag
if ( $action == 'drag' )
{
    $sourceId = getPost('sourceId');
    $destinationId = getPost('destinationId', 0);
    $orders = getPost('order', []);

    $affect = $json->update(['id' => $sourceId, 'pid' => $destinationId]);

    foreach($orders as $sort => $id){
        $data[] = ['id' => $id, 'sort' => $sort];
    }
    $affect2 = $json->updates($data);

    if (!$affect && $affect2) {
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
    global $json;
    $res = $json->selectAll('sort');

    return buildMenu($res);
}

function getCount()
{
    global $json;
    return $json->count();
}

// create menu
function buildMenu($menu, $parentid = 0)
{
    $result = null;
    foreach ($menu as $key => $item)

        if ($item['pid'] == $parentid) {
            $item_json = json_encode($item);
            $hide_node = $item['hide'] ? '[Hidden]' : '';
            $result .= "<li class='dd-item nested-list-item' data-id='{$key}'>
      <div class='dd-handle nested-list-handle'></div>
      <div class='nested-list-content'>{$item['title']}
        <span class='tip-msg'></span>
        <div class='pull-right'><span class='tip-hide'>{$hide_node}</span>
            <a href='#editModal' class='edit_toggle' rel='{$item_json}'  data-toggle='modal'>Edit</a> |
            <a href='#deleteModal' class='delete_toggle' rel='{$key}' data-toggle='modal'>Delete</a>
        </div>
      </div>" . buildMenu($menu, $key) . "</li>";
        }
    return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
}