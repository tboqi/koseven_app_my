<?php

class Helper_string {
    /**
     * 隐藏部分手机号
     * @param unknown $mobile
     * @param number $offset
     * @param number $length
     * @return mixed
     */
    static function hide_mobile($mobile, $offset = 3, $length = 4) {
        $str = str_repeat('*', $length);
        return substr_replace($mobile, $str, $offset, $length);
    }
    /**
     * 手机号保密处理
     * Enter description here ...
     * @param $moblie 手机号
     * @param $type
     */
    function secrecy_mobile($mobile) {
        return preg_replace("/(1\d{1,3})\d\d\d\d(\d{4,4})/", "\$1****\$2", $mobile);
    }
    /**
     * utf8转gb2312编码
     * @param  [type]
     * @return [type]
     */
    static function utf8_to_gb2312($str) {
        return iconv( "UTF-8", "gb2312//IGNORE" , $str);
    }
    
    function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHttpRequest';
    }
}