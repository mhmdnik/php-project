<?php
namespace Admin;
use Admin\Admin;
use Database\Database;

class Comment extends Admin{
    public function index(){
        $db = new Database();
        $comments = $db->select('SELECT comments.*, (SELECT username FROM users WHERE comments.user_id = users.id) AS username, (SELECT title FROM articles WHERE comments.article_id = articles.id) AS article FROM comments ORDER BY id DESC');

        $unseenComments = $db->select('SELECT * FROM comments WHERE `status` = "unseen"')->fetchAll();
        if($unseenComments != null){
            foreach($unseenComments as $unseencomment){
                $db->update('comments', $unseencomment['id'], ['status'], ['status'=>'seen']);
            }
        }
        require_once (BASE_PATH . '/template/admin/comments/index.php');
    }

    public function changeStatus($id){
        $db = new Database();
        $comment = $db->select('SELECT * FROM comments WHERE id = ?', [$id])->fetch();
        if($comment['status'] == 'seen'){
            $db->update('comments', $comment['id'], ['status'], ['status'=>'approved']);
            $this->redirectBack();
        }
        else if($comment['status'] == 'approved'){
            $db->update('comments', $comment['id'], ['status'], ['status'=>'seen']);
            $this->redirectBack();
        }
    }
}