<?php
namespace Admin;

use Database\Database;

class Websetting extends Admin{

    public function index()
    {
        $db = new Database();
        $websetting = $db->select('SELECT * FROM websetting')->fetch();
        require_once(BASE_PATH . '/template/Admin/websetting/index.php');
    }

    public function edit(){
        $db = new Database();
        $websetting = $db->select('SELECT * FROM websetting')->fetch();
        require_once(BASE_PATH . '/template/Admin/websetting/edit.php');
    }

    public function update($request){
        $db = new Database();
        $websetting = $db->select('SELECT * FROM websetting')->fetch();
        if($request['logo']['tmp_name'] !=null)
        $request['logo'] = $this->saveImage($request['logo'], 'websetting', 'logo');
        else
        unset($request['logo']);
        if($request['icon']['tmp_name'] !=null)
        $request['icon'] = $this->saveImage($request['icon'], 'websetting', 'icon');
        else
        unset($request['icon']);

        $db->update('websetting', $websetting['id'], array_keys($request), $request);
        $this->redirect('admin/websetting');
    }
}