<?php
namespace Admin;
use Admin\Admin;
use Database\Database;

class User extends Admin{
    public function index()
    {
        $db = new Database();
        $users = $db->select('SELECT * FROM users ORDER BY id DESC');
        require_once(BASE_PATH . '/template/admin/users/index.php');
    }

    public function edit($id){
        $db = new Database();
        $user = $db->select('SELECT * FROM users WHERE id = ?', [$id])->fetch();
        require_once(BASE_PATH . '/template/admin/users/edit.php');
    }

    public function update($request, $id){
        $db = new Database();
        $user = $db->select('SELECT * FROM users WHERE id = ?', [$id])->fetch();
        if($user){
            $db->update('users', $user['id'], array_keys($request), $request);
            $this->redirect('admin/user');
        }else{
            $this->redirectBack();
        }
    }

    public function permission($id){
        $db = new Database();
        $user = $db->select('SELECT * FROM users WHERE id = ?', [$id])->fetch();
        if($user['permission'] == 'admin'){
            $db->update('users', $user['id'], ['permission'], ['permission' => 'user']);
            $this->redirectBack();
        }
        else if($user['permission'] == 'user'){
            $db->update('users', $user['id'], ['permission'], ['permission' => 'admin']);
            $this->redirectBack();
        }
    }
}