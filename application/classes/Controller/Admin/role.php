<?php

class Controller_Admin_Role extends Controller_Admin_Base
{

    function action_index()
    {
        $this->tpl = 'admin/role/index';
        $limit = 30;
        $page = 0;
        $this->data['list'] = (new Model_Role())->find($limit, $page);
    }

    function action_add()
    {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            unset($post['_txt_val']);
            (new Model_Role())->insert($post);
        }
        $this->tpl = 'admin/role/form';
    }
    
    function action_del() {
        $id = $this->request->query('id');
        (new Model_Role())->del($id);
        http::redirect('admin/role/index');
    }
}