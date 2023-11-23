<?php
namespace Admin;
use Auth\Auth;
use Database\Database;

class Admin{

    public function __construct()
    {
        $Auth = new Auth();
        $Auth->checkAdmin();
    }
    protected function redirect($url){
        header('Location: '. trim(CURRENT_DOMAIN, '/ ') . DIRECTORY_SEPARATOR . trim($url, '/ '));
    }

    protected function redirectBack(){
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }

    protected function saveImage($image, $imagePath, $imageName = null){
        $allowedMimes = ['jpg', 'jpeg', 'png', 'gif'];
        $fileName = $image['name'];
        $imageMime = pathinfo($fileName, PATHINFO_EXTENSION);
        if(!in_array($imageMime, $allowedMimes)){
            return false;
        }
        
        if($imageName)
        $imageName = $imageName . '.' . $imageMime;
        else
        $imageName = date('Y.m.d-H.i.s') . '.' . $imageMime;
        

        $imagePath = 'public/' . $imagePath .'/';
        $tmp_name = $image['tmp_name'];
        
        if(is_uploaded_file($tmp_name)){
            if(move_uploaded_file($tmp_name, $imagePath . $imageName)){
                return $imagePath.$imageName;
            }
            else{
                
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function removeImage($path){
        if(file_exists($path)){
            unlink($path);
        }
        else{
            echo 'something went wrong';
        }
    }

    public function index(){
        $db = new Database();
        $categoryCount = $db->select('SELECT COUNT(*) FROM categories')->fetch();
        $userCount = $db->select("SELECT COUNT(*) FROM users WHERE permission = 'user'")->fetch();
        $adminCount = $db->select("SELECT COUNT(*) FROM users WHERE permission = 'admin'")->fetch();
        $articleCount = $db->select("SELECT COUNT(*) FROM articles")->fetch();
        $articleView = $db->select("SELECT SUM(view) FROM articles")->fetch();
        $commentCount = $db->select("SELECT COUNT(*) FROM comments")->fetch();
        $commentUnseenCount = $db->select("SELECT COUNT(*) FROM comments WHERE status = 'unseen'")->fetch();
        $commentApprovedCount = $db->select("SELECT COUNT(*) FROM comments WHERE status = 'approved'")->fetch();
        $mostViewedArticles = $db->select("SELECT * FROM articles ORDER BY view DESC LIMIT 0,4");
        $mostCommentedArticles = $db->select("SELECT articles.*, (SELECT COUNT(*) FROM comments WHERE comments.article_id = articles.id) as comment_count FROM articles ORDER BY comment_count DESC LIMIT 0,4");
        $lastComments = $db->select("SELECT comments.*, users.username as username FROM comments LEFT JOIN users ON comments.user_id = users.id ORDER BY created_at DESC LIMIT 0,4");
        require_once(BASE_PATH . '/template/Admin/dashboard/index.php');
    }
}