<?php

class Controller_Admin_User extends Controller_Admin_Base
{

    function action_index()
    {
        $this->tpl = 'admin/user/index';
        $limit = 30;
        $page = 0;
        $this->data['list'] = (new Model_User())->find($limit, $page);
    }

    function action_add()
    {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            unset($post['_txt_val']);
            $post['password'] = Auth_Mysql::instance()->hash($post['password']);
            $post['create_time'] = time();
            $post['update_time'] = time();
            (new Model_User())->insert($post);
            HTTP::redirect('admin/user/index');
        }
        $this->tpl = 'admin/user/form';
    }

    function action_del()
    {
        $id = $this->request->query('id');
        (new Model_User())->del($id);
        http::redirect('admin/user/index');
    }
}