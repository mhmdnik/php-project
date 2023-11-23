<?php
namespace Admin;

use Database\Database;

class Article extends Admin{
    public function index(){
        
        $db = new Database;
        $articles = $db->select('SELECT articles.*, categories.name as category_name FROM articles LEFT JOIN categories ON articles.cat_id = categories.id ORDER BY id DESC');
        require_once (BASE_PATH . '/template/admin/articles/index.php');
    }

    public function show($id){
        $db = new Database;
        $article = $db->select('SELECT * FROM articles WHERE id = ?', [$id])->fetch();
        require_once (BASE_PATH . '/template/admin/articles/show.php');
    }

    public function create(){
        $db = new Database;
        $categories = $db->select('SELECT * FROM categories ORDER BY id DESC');
        require_once (BASE_PATH . '/template/admin/articles/create.php');
    }

    public function store($request){
        
        $db = new Database();
        if($request['cat_id'] != null){
            $request['image'] = $this->saveImage($request['image'], 'image-article');
            if($request['image']){
                $request = array_merge($request, ['user_id' => $_SESSION['user_id']]);
                $db->insert('articles', array_keys($request), $request);
                $this->redirect('admin/article');
            }
            else{
                $this->redirect('admin/article/create');
            }
        }
        else{
            
            $this->redirect('admin/article/create');
        }
    }

    public function edit($id){
        
        $db = new Database;
        $categories = $db->select('SELECT * FROM categories ORDER BY id DESC');
        $article = $db->select('SELECT * FROM articles WHERE id = ?', [$id])->fetch();
        require_once (BASE_PATH . '/template/admin/articles/edit.php');
    }

    public function update($request, $id){
        
        if($request['cat_id'] != null){
            $db = new Database();
            $article = $db->select('SELECT * FROM articles WHERE id = ?', [$id])->fetch();
            if($request['image']['tmp_name'] != ""){
                $this->removeImage($article['image']);
                $request['image'] = $this->saveImage($request['image'], 'image-article');
            }
            else{
                unset($request['image']);
            }
            $db->update('articles', $id, array_keys($request), $request);
            $this->redirect('admin/article');
        }
        else{
            $this->redirect('admin/article');
        }
    }

    public function changeStatus($id){
        $db = new Database();
        $article = $db->select('SELECT * FROM articles WHERE id = ?', [$id])->fetch();
        if($article['status'] == 'visible'){
            $db->update('articles', $article['id'], ['status'], ['status'=>'invisible']);
            $this->redirectBack();
        }
        else if($article['status'] == 'invisible'){
            $db->update('articles', $article['id'], ['status'], ['status'=>'visible']);
            $this->redirectBack();
        }
    }

    public function delete($id){
        $db = new Database();
        $article = $db->select('SELECT * FROM articles WHERE id = ?', [$id])->fetch();
        $this->removeImage($article['image']);
        $db->delete('articles', [$id]);
        $this->redirectBack();
    }
}