<?php
session_start();
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/php');

require_once 'vendor/autoload.php';
require_once 'Database/DataBase.php';
require_once 'Activities/Admin/Admin.php';
require_once 'Activities/Admin/Category.php';
require_once 'Activities/Admin/Article.php';
require_once 'Activities/Admin/Menu.php';
require_once 'Activities/Admin/Comment.php';
require_once 'Activities/Admin/User.php';
require_once 'Activities/Admin/Websetting.php';
require_once 'Activities/Admin/message.php';
require_once 'Activities/Auth/Auth.php';
require_once 'Activities/App/Home.php';



function routing($reservedUrl, $class, $method, $requestMethod = 'GET')
{

        $currentUrl = explode("?", currentUrl())[0];
        $currentUrl = trim($currentUrl, '/ ');
        $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
        $currentUrl = trim($currentUrl, '/ ');
        $currentUrlArray = array_filter(explode("/", $currentUrl));

        $reservedUrl = trim($reservedUrl, '/ ');
        $reservedUrlArray = array_filter(explode("/", $reservedUrl));

        $parameters = [];

        if (sizeof($currentUrlArray) != sizeof($reservedUrlArray) || methodField() != $requestMethod) {

                return false;
        }

        for ($key = 0; $key < sizeof($currentUrlArray); $key++) {
                if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}") {

                        array_push($parameters, $currentUrlArray[$key]);
                } elseif ($reservedUrlArray[$key][0] == "[" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "]") {
                        continue;
                } elseif ($reservedUrlArray[$key] !== $currentUrlArray[$key]) {

                        return false;
                }
        }

        if (methodField() == 'POST') {
                $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
                $parameters = array_merge([$request], $parameters);
        }

        $object = new $class;
        call_user_func_array(array($object, $method), $parameters);
        exit;
}



function protocol()
{
        return  stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
}


function currentDomain()
{
        return protocol() . $_SERVER['HTTP_HOST'];
}


function asset($src)
{

        $domain = trim(CURRENT_DOMAIN, '/ ');
        $src = $domain . '/' . trim($src, '/');
        return $src;
}

function url($url, $slog = null)
{
        if($slog != null){
                $slog = str_replace(" ", "-", $slog);
                $slog = trim($slog, '-');
                $url = $url . '/' . $slog;
        }
        $domain = trim(CURRENT_DOMAIN, '/ ');
        $url = $domain . '/' . trim($url, '/');
        return $url;
}

function currentUrl()
{
        return currentDomain() . $_SERVER['REQUEST_URI'];
}

function methodField()
{
        return $_SERVER['REQUEST_METHOD'];
}
function dd($var)
{
        var_dump($var) . '<br>';
        exit;
}

//Home

routing('', 'App\Home', 'index');
routing('/', 'App\Home', 'index');
routing('home', 'App\Home', 'index');
routing('single-post/{id}/[slog]', 'App\Home', 'singlePost');
routing('comment-store/{id}', 'App\Home', 'commentStore', 'POST');
routing('contact', 'App\Home', 'contact');
routing('message-store', 'App\Home', 'messageStore', "POST");

//admin

routing('admin', 'Admin\Admin', 'index');

//categories

routing('admin/category', 'Admin\Category', 'index');
routing('admin/category/create', 'Admin\Category', 'create');
routing('admin/category/store', 'Admin\Category', 'store', 'POST');
routing('admin/category/edit/{id}', 'Admin\Category', 'edit');
routing('admin/category/update/{id}', 'Admin\Category', 'update', 'POST');
routing('admin/category/delete/{id}', 'Admin\Category', 'delete');

//articles

routing('admin/article', 'Admin\Article', 'index');
routing('admin/article/create', 'Admin\Article', 'create');
routing('admin/article/store', 'Admin\Article', 'store', 'POST');
routing('admin/article/edit/{id}', 'Admin\Article', 'edit');
routing('admin/article/update/{id}', 'Admin\Article', 'update', 'POST');
routing('admin/article/change-status/{id}', 'Admin\Article', 'changeStatus');
routing('admin/article/delete/{id}', 'Admin\Article', 'delete');

//menus

routing('admin/menu', 'Admin\Menu', 'index');
routing('admin/menu/create', 'Admin\Menu', 'create');
routing('admin/menu/store', 'Admin\Menu', 'store', 'POST');
routing('admin/menu/edit/{id}', 'Admin\Menu', 'edit');
routing('admin/menu/update/{id}', 'Admin\Menu', 'update', 'POST');
routing('admin/menu/delete/{id}', 'Admin\Menu', 'delete');

//comments

routing('admin/comment', 'Admin\Comment', 'index');
routing('admin/comment/change-status/{id}', 'Admin\Comment', 'changeStatus');



//Auth

routing('login', 'Auth\Auth', 'login');
routing('logout', 'Auth\Auth', 'logout');
routing('login-operation', 'Auth\Auth', 'loginOperation', 'POST');
routing('register', 'Auth\Auth', 'register');
routing('register-store', 'Auth\Auth', 'registerOperation', 'POST');
routing('active-account/{token}', 'Auth\Auth', 'activation');
routing('forgot-password', 'Auth\Auth', 'forgotPassword');
routing('forgot-password-operation', 'Auth\Auth', 'forgotPasswordOperation', 'POST');
routing('reset-password/{token}', 'Auth\Auth', 'resetPasswordForm');
routing('reset-password-operation/{token}', 'Auth\Auth', 'resetPassword', 'POST');

//users

routing('admin/user', 'Admin\User', 'index');
routing('admin/user/edit/{id}', 'Admin\User', 'edit');
routing('admin/user/update/{id}', 'Admin\User', 'update', 'POST');
routing('admin/user/permission/{id}', 'Admin\User', 'permission');

//websetting

routing('admin/websetting', 'Admin\Websetting', 'index');
routing('admin/websetting/edit', 'Admin\Websetting', 'edit');
routing('admin/websetting/update', 'Admin\Websetting', 'update', 'POST');

//messages

routing('admin/message', 'Admin\Message', 'index');