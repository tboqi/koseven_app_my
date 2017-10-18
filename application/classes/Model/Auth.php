<?php

class Model_Auth extends Model_Base
{

    protected $table = 'admin_auths';

    function getAuthByControllerAction($controller, $action)
    {
        $query = DB::query(Database::SELECT, "SELECT * FROM {$this->table} WHERE controller = :controller and action = :action limit 1");
        $query->param(':controller', $controller);
        $query->param(':action', $action);
        $results = $query->execute();
        return $results->current();
    }
    
    function find_top_menus() {
        $query = DB::query(Database::SELECT, 'SELECT * FROM '.$this->table.' WHERE parent_id = 0 and type=1');
        $results = $query->execute();
        return $results->as_array();
    }
    
    static function get_type_name($type) {
        $arr = [
            0 => '菜单 有链接', '菜单, 用于表示菜单分类', 2 => '操作, 页面中的操作, 不显示在菜单中'
        ];
        return $arr[$type] ?: $arr[0];
    }
}