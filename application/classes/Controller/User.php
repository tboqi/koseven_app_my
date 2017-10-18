<?php
class Controller_User extends Controller_Base {

    protected $show_header = false;

    protected $non_login_action = array('login');

    // $user = array(
    //             'username' => '超级管理员',
    //             'account' => 'admin',
    //             'password' => Auth_Mysql::instance()->hash('111111'),
    //             'create_time' => time(),
    //             'update_time' => time(),
    //     );

    function action_add() {

        $model_user = new Model_User();
        $rt = $model_user->insert($user);
        var_dump($rt);
    }

    function action_index() {

    }

    function action_login() {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            $account = $post['account'];
            $password = $post['password'];

            $auth = Auth_Mysql::instance();
            if ($user = $auth->login($account, $password)) {
                HTTP::redirect();
            } else {
                echo "login faild";
            }
        }

        $this->tpl = 'user/login';
        $this->data = array();
    }

    function action_edit_password() {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            $password_old = $post['password_old'];
            $password_new = $post['password_new'];
            $password_new2 = $post['password_new2'];

            $login_user = $this->login_user;

            $auth = Auth_Mysql::instance();
            $password_old_hash = $auth->hash($password_old);
            if ($password_old_hash != $login_user['password']) {
                die('原密码不正确');
            }

            $password_new_hash = $auth->hash($password_new);
            $model_user = new Model_User();
            if ($model_user->update(array('password' => $password_new_hash), $login_user['id'])) {
                $auth->logout();
                HTTP::redirect('user/login');
            }
            die('error');
        }

        $this->tpl = 'user/edit_password';
        $this->data = array();
    }

    function action_logout() {
        $auth = Auth::instance();
        $auth->logout();
        HTTP::redirect();
    }
}
