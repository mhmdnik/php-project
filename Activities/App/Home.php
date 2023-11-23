<?php
namespace App;

use Database\Database;

class Home{
    public function index(){
        $db = new Database();
        $menus = $db->select('SELECT *, (SELECT COUNT(*) FROM `menus` AS `submenus` WHERE `submenus`.`parent_id` = `menus`.`id`  ) as `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL ;')->fetchAll();
        $submenus = $db->select('SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;')->fetchAll();


        $newestArticles = $db->select("SELECT * FROM articles ORDER BY created_at DESC");
        $topViewArticle = $db->select("SELECT articles.*, categories.name as category_name, users.username as username FROM articles LEFT JOIN categories ON categories.id = articles.cat_id LEFT JOIN users ON users.id = articles.user_id ORDER BY view DESC LIMIT 0,1")->fetch();
        $randomArticles = $db->select("SELECT articles.*, categories.name as category_name FROM articles LEFT JOIN categories ON categories.id = articles.cat_id ORDER BY RAND() LIMIT 0,3");
        $randomArticles2 = $db->select("SELECT articles.*, categories.name as category_name FROM articles LEFT JOIN categories ON categories.id = articles.cat_id ORDER BY RAND() LIMIT 0,3");
        $mostViewArticles = $db->select("SELECT articles.*, users.username as username FROM articles LEFT JOIN users ON users.id = articles.user_id ORDER BY view DESC LIMIT 0,5");


        $categories = $db->select("SELECT * FROM categories ORDER BY id DESC LIMIT 0,6");
        $recentArticles = $db->select("SELECT articles.*, categories.name as category_name, users.username as username FROM articles LEFT JOIN categories ON categories.id = articles.cat_id LEFT JOIN users ON users.id = articles.user_id ORDER BY created_at DESC LIMIT 0,4");
        $websetting = $db->select("SELECT * FROM websetting")->fetch();

        require_once(BASE_PATH . '/template/App/index.php');
    }

    public function singlePost($id){
        
        $db = new Database();
        $menus = $db->select('SELECT *, (SELECT COUNT(*) FROM `menus` AS `submenus` WHERE `submenus`.`parent_id` = `menus`.`id`  ) as `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL ;')->fetchAll();
        $submenus = $db->select('SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;')->fetchAll();
        $article = $db->select("SELECT articles.*, categories.name as category_name FROM articles LEFT JOIN categories ON categories.id = articles.cat_id WHERE articles.id = ?", [$id])->fetch();

        $comments = $db->select("SELECT comments.*, users.username as username FROM comments LEFT JOIN users ON users.id = comments.user_id WHERE article_id = ?", [$id]);
        $mostViewArticles = $db->select("SELECT articles.*, users.username as username, categories.name as category_name FROM articles LEFT JOIN users ON users.id = articles.user_id LEFT JOIN categories ON categories.id=articles.cat_id ORDER BY view DESC LIMIT 0,6");

        $categories = $db->select("SELECT * FROM categories ORDER BY id DESC LIMIT 0,6");
        $recentArticles = $db->select("SELECT articles.*, categories.name as category_name, users.username as username FROM articles LEFT JOIN categories ON categories.id = articles.cat_id LEFT JOIN users ON users.id = articles.user_id ORDER BY created_at DESC LIMIT 0,4");
        $websetting = $db->select("SELECT * FROM websetting")->fetch();

        require_once(BASE_PATH . '/template/App/single-post.php');
    }

    public function commentStore($request, $id){
        $db = new Database();
        $article = $db->select("SELECT * FROM articles WHERE id = ?", [$id])->fetch();
        if($article != null){
            $db->insert('comments', ['body', 'article_id', 'user_id'], ['body'=>$request['body'], 'article_id'=>$id, 'user_id'=>$_SESSION['user_id']]);
            $this->redirectBack();
        }
    }

    public function contact(){
        $db = new Database();
        $menus = $db->select('SELECT *, (SELECT COUNT(*) FROM `menus` AS `submenus` WHERE `submenus`.`parent_id` = `menus`.`id`  ) as `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL ;')->fetchAll();
        $submenus = $db->select('SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;')->fetchAll();




        $categories = $db->select("SELECT * FROM categories ORDER BY id DESC LIMIT 0,6");
        $recentArticles = $db->select("SELECT articles.*, categories.name as category_name, users.username as username FROM articles LEFT JOIN categories ON categories.id = articles.cat_id LEFT JOIN users ON users.id = articles.user_id ORDER BY created_at DESC LIMIT 0,4");
        $websetting = $db->select("SELECT * FROM websetting")->fetch();

        require_once(BASE_PATH . '/template/App/contact.php');
    }


    public function messageStore($request){
        $db = new Database;
        $db->insert("contactus", ["email", "body"], ["email" => $request['email'], "body" => $request['body']]);
        $this->redirect('home');
    }
    protected function redirect($url){
        header('Location: '. trim(CURRENT_DOMAIN, '/ ') . DIRECTORY_SEPARATOR . trim($url, '/ '));
    }
    protected function redirectBack(){
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
}