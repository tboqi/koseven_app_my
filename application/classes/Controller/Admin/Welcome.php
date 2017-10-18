<?php

class Controller_Admin_Welcome extends Controller_Admin_Base
{

    function action_index()
    {
        $this->tpl = 'admin/welcome/index';
        
        $data = array();
        $data['menu'] = (new Model_User())->get_user_auth_list($this->login_user['id']);
    }

    function action_menujs()
    {
        $this->need_login = false;
        $this->show_header = false;
        $this->tpl = 'admin/menujs';
        
        $model_auth = new Model_Auth();
        $auths = $model_auth->find_all();
        $main_auths = [];
        $sub_auths = [];
        foreach ($auths as $auth) {
            if ($auth->type == 0) {
                $sub_auths[$auth->parent_id][] = $auth;
            } elseif ($auth->type == 1) {
                $main_auths[] = $auth;
            }
        }
        $menus = [];
        foreach ($main_auths as $auth) {
            $children = [];
            foreach ($sub_auths[$auth->id] as $sub_auth) {
                $children[] = array(
                        'url' => url::site("admin/{$sub_auth->controller}/{$sub_auth->action}"),
                        'text' => $sub_auth->name,
                );
            }
            $menus[] = [
                'text' => $auth->name,
                'isexpand' => false,
                'children' => $children,
            ];
        }
        $this->data['menus'] = $menus;
    }

    function action_main()
    {
        $this->tpl = 'admin/welcome/main';
    }
}