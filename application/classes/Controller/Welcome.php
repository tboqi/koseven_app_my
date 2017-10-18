<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

    protected $need_login = true;

    public function action_index() {
        $this->tpl = 'welcome/index';

        $session = Session::instance();
        $data = $session->as_array();
        $this->data = $data;
    }

    public function action_ajax() {
        $this->show_type = 'json';
        $this->data = ['aa' => 0, 'bb' => 'test'];
    }

} // End Welcome
