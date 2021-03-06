﻿<!DOCTYPE html>
<html class="login-alone">
    <head>
        <title>带表单验证的HTML登录页面模板下载 - JS代码网</title>
		<meta name="keywords" content="注册登录页面,注册登录模板页面,注册登录HTML页面,注册登录HTML" />
		<meta name="description" content="JS代码网提供高质量注册登录页面模板下载" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="http://tbq_static.com/my/homepage/favicon.ico?v=3.9" />
        <link href="http://tbq_static.com/my/ui/css/screen.css?v=3.9" media="screen, projection" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" type="text/css" href="http://tbq_static.com/my/ui/css/base.css?v=3.9">
        <link rel="stylesheet" type="text/css" href="http://tbq_static.com/my/passport/css/login.css?v=3.9">
        <!--[if lt IE 9]>
        <script>
        window.location="homepage/support";
        </script>
        <![endif]-->
    </head>
    <body>
        <!--
        <div class="logina-logo" style="height: 55px">
            <a href="">
                <img src="http://tbq_static.com/my/passport/images/toplogo.png?v=3.9" height="60" alt="">
            </a>
        </div>
        -->
        <div class="logina-main main clearfix">
            <div class="tab-con">
                <form id="form-login" method="post" action="passport/ajax-login">
                    <div id='login-error' class="error-tip"></div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <th>账户</th>
                                <td width="245">
                                    <input id="email" type="text" name="email" placeholder="电子邮箱/手机号" autocomplete="off" value=""></td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <th>密码</th>
                                <td width="245">
                                    <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr id="tr-vcode" style="display:none;" >
                                <th>验证码</th>
                                <td width="245">
                                    <div class="valid">
                                        <input type="text" name="vcode"><img class="vcode" src="passport/vcode?_=1411476793" width="85" height="35" alt="">
                                    </div>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr class="find">
                                <th></th>
                                <td>
                                    <div>
                                        <label class="checkbox" for="chk11"><input style="height: auto;" id="chk11" type="checkbox" name="remember_me" >记住我</label>
                                        <a href="passport/forget-pwd">忘记密码？</a>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td width="245"><input class="confirm" type="submit" value="登  录"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="refer" value="site/">
                </form>
            </div>
            <div class="reg">
                <p>还没有账号？<br>赶快免费注册一个吧！</p>
                <a class="reg-btn" href="#">立即免费注册</a>
            </div>
        </div>
        <div id="footer">
            <div class="copyright">Copyright © 2014 js-css.cn. All Rights Reserved. js代码网 版权所有</div>
        </div>
        <script src="http://tbq_static.com/my/skin/js/lib/jquery-2.0.3.min.js?v=3.9"></script>
        <script src="http://tbq_static.com/my/skin/js/ui.common.js?v=3.9"></script>
        <script src="http://tbq_static.com/my/passport/js/login.js?v=3.9"></script>
    </body>
</html>
