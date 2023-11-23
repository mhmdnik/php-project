<?php

namespace Auth;

use Database\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';
class Auth
{
    protected function redirect($url)
    {
        header('Location: ' . trim(CURRENT_DOMAIN, '/ ') . DIRECTORY_SEPARATOR . trim($url, '/ '));
    }

    protected function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function login()
    {
        require_once(BASE_PATH . '/template/Auth/login.php');
    }

    public function register()
    {
        require_once(BASE_PATH . '/template/Auth/register.php');
    }

    public function forgotPassword()
    {
        require_once(BASE_PATH . '/template/Auth/forgot-password.php');
    }

    public function resetPasswordForm($forgot_token)
    {
        require_once(BASE_PATH . '/template/Auth/reset-password.php');
        
    }

    public function token()
    {
        return bin2hex(random_bytes(32));
    }

    public function checkAdmin()
    {
        if (isset($_SESSION['user_id'])) {
            $db = new Database;
            $user = $db->select('SELECT * FROM users WHERE id = ?', [$_SESSION['user_id']])->fetch();
            if ($user != null) {
                if ($user['permission'] == 'user') {
                    $this->redirect('home');
                }
            } else {
                $this->redirect('home');
            }
        } else {
            $this->redirect('home');
        }
    }

    public function sendMail($emailAddress, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'phpuserstest@gmail.com';                     //SMTP username
            $mail->Password   = 'fysexgogwkguvmob';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('phpuserstest@gmail.com', 'Mailer');
            $mail->addAddress($emailAddress);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;


            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    public function activationMessage($username, $token)
    {
        $body = "hi $username,\n
        you should click on the bellow link to active your account. \n
        http://localhost/php/active-account/$token";
        return $body;
    }

    public function forgetMessage($username, $token)
    {
        $body = "hi $username,\n
        please click on bellow link for recycle your password account. \n
        " . url('reset-password/' . $token);
        return $body;
    }

    public function registerOperation($request)
    {
        if (empty($request['email']) or empty($request['password']) or empty($request['username'])) {
            $this->redirectBack();
        } else if (strlen($request['password']) < 8) {
            $this->redirectBack();
        } else if (isset($request['password']) != isset($request['confirmedPassword'])) {
            $this->redirectBack();
        } else if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirectBack();
        } else {
            $db = new Database();
            $user = $db->select('SELECT * FROM users WHERE email = ?', [$request['email']])->fetch();
            if ($user == null) {
                unset($request['confirmedPassword']);
                $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
                $activationToken = $this->token();
                $body = $this->activationMessage($request['username'], $activationToken);
                $sendMail = $this->sendMail($request['email'], 'activation', $body);
                if ($sendMail) {
                    $request = array_merge($request, ['active_token' => $activationToken]);
                    $db->insert('users', array_keys($request), $request);
                    $this->redirect('login');
                }
            } else {
                $this->redirectBack();
            }
        }
    }

    public function activation($request)
    {
        $db = new Database();
        $user = $db->select('SELECT * FROM users WHERE active_token = ?', [$request])->fetch();
        if ($user['is_active'] == 0) {
            $db->update('users', $user['id'], ['is_active'], ['is_active' => 1]);
            $this->redirect('login');
        } else {
            $this->redirect('login');
        }
    }

    public function resetPassword($request, $token)
    {
        if (empty($request['password'])) {
            $this->redirectBack();
        } else {
    
            $db = new Database();
            $user = $db->select('SELECT * FROM users WHERE forget_token = ?', [$token])->fetch();
            if ($user != null) {
                date_default_timezone_set('Asia/Tehran');
                if ($user['expire_forget_token'] < date('Y-m-d H:i:s')) {
                    $this->redirect('login');
                } else {
                    $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
                    $db->update('users', $user['id'], ['password'], ['password' => $request['password']]);
                    $this->redirect('login');
                }
            }
        }
    }

    public function loginOperation($request)
    {
        if (empty($request['email']) || empty($request['password'])) {
            $this->redirect('login');
        } else if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirect('login');dd('hi');
        } else if (strlen($request['password']) < 8) {
            $this->redirect('login');
        } else {
            $db = new Database();
            $user = $db->select('SELECT * FROM users WHERE email = ?', [$request['email']])->fetch();
            if ($user != null) {
                if ($user['is_active'] == 1) {
                    if (password_verify($request['password'], $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $this->redirect('admin');
                    } else {
                        $this->redirect('login');
                    }
                } else {
                    $this->redirect('login');
                }
            }
        }
    }

    public function logout()
    {
        if ($_SESSION['user_id']) {
            unset($_SESSION['user_id']);
            session_destroy();
        }
        $this->redirect('home');
    }

    public function forgotPasswordOperation($request)
    {
        if (!isset($_SESSION['user_id'])) {
            if (empty($request['email'])) {
                $this->redirectBack();
            } else if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                $this->redirectBack();
            } else {
                $db = new Database();
                $user = $db->select('SELECT * FROM users WHERE email = ?', [$request['email']])->fetch();
                if ($user != null) {
                    if ($user['is_active'] != 0) {
                        date_default_timezone_set('Asia/Tehran');
                        $forgetToken = $this->token();
                        $expireForgetToken = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                        $body = $this->forgetMessage($user['email'], $forgetToken);
                        $sendMail = $this->sendMail($user['email'], 'reset password', $body);
                        if ($sendMail) {
                            $db->update('users', $user['id'], ['forget_token', 'expire_forget_token'], ['forget_token' => $forgetToken, 'expire_forget_token' => $expireForgetToken]);
                            $this->redirect('login');
                        } else {
                            $this->redirect('login');
                        }
                    } else {
                        $this->redirectBack();
                    }
                } else {
                    $this->redirectBack();
                }
            }
        }else{
            $this->redirect('home');
        }
    }
}
