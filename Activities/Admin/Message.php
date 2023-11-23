<?php
namespace Admin;

use Database\Database;

class Message extends Admin{
    public function index(){
        $db = new Database;
        $messages = $db->select("SELECT * FROM `messages` ORDER BY `created_at`")->fetchAll();
        $unseenMessages = $db->select("SELECT * FROM `messages` WHERE `status` = 'unseen'")->fetchAll();
        if($unseenMessages != null){
            foreach($unseenMessages as $unseenMessage){

                $db->update('messages', $unseenMessage['id'], ['status'], ['status' => 'seen']);
            }
        }
        require_once(BASE_PATH . '/template/Admin/messages/index.php');
        
    }
}