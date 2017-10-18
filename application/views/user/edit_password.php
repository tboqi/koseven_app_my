<form action="<?php echo URL::site('user/edit_password')?>" method="post">
<div>
旧密码: <input type="password" name="password_old">
新密码: <input type="password" name="password_new">
新密码确认: <input type="password" name="password_new2">
<button type="submit">保存</button>
</div>
</form>