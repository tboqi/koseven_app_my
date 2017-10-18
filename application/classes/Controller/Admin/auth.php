<?php

class Controller_Admin_Auth extends Controller_Admin_Base
{

    function action_index()
    {
        $this->tpl = 'admin/auth/index';
        $limit = 30;
        $page = 0;
//         $rows = (new Model_User())->get_user_auth_list($this->login_user['id']);
        $this->data['list'] = (new Model_Auth())->find($limit, $page);
    }

    function action_add()
    {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            unset($post['_txt_val']);
            (new Model_Auth())->insert($post);
        }
        $this->tpl = 'admin/auth/form';
        $this->data['top_menus'] = (new Model_Auth())->find_top_menus();
    }
    
    function action_del() {
        $id = $this->request->query('id');
        (new Model_Auth())->del($id);
        http::redirect('admin/auth/index');
    }
}