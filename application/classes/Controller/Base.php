<?php
abstract class Controller_Base extends Controller {
	protected $show_header = true;
	protected $show_type = 'tpl'; //json
	protected $data = array();
	protected $tpl = '';
	/**
	 * controller级别表示是否需要登录
	 * @var unknown
	 */
	protected $need_login = false;
	/**
	 * action级别的,标识一个需要登录的controller中 不 需要登录才能操作的action
	 * @var unknown
	 */
	protected $non_login_action = array();

	protected $login_user;

	abstract function action_index();

	function before() {
		parent::before();
		// $auth = Auth::instance();
		// if ($auth->logged_in()) {
		//     $user_id = $auth->get_user();
		//     $model_user = Model_User::factory('User');
		//     $this->login_user = $model_user->get($user_id);
		// }
		// self::check_permission();
	}

	function after() {
		//以后换成is_ajax操作
		if ($this->show_type == 'tpl') {
			$this->show_html();
		} elseif ($this->show_type == 'json') {
			$this->show_json();
		}
		parent::after();
	}

	protected function render_header() {
		$view = View::factory('common/header');
		$view->login_user = $this->login_user;
		echo $view;
	}

	protected function render_footer() {
		$view = View::factory('common/footer');
		echo $view;
	}

	protected function show_html() {
		if ($this->show_header) {
			$this->render_header();
		}

		$view = View::factory($this->tpl);
		foreach ($this->data as $key => $value) {
			$view->{$key} = $value;
		}
		$view->login_user = $this->login_user;
		echo $view;

		if ($this->show_header) {
			$this->render_footer();
		}
	}

	protected function show_json() {
		$data = array();
		if (!isset($this->data['code'])) {
			$data['code'] = 0;
			$data['msg'] = '';
			$data['data'] = $this->data;
		} else {
			$data = $this->data;
		}
		die(json_encode($data));
	}

	private function not_need_login() {
		$controller = $this->request->controller();
		$action = $this->request->action();

		var_dump($controller, $action);
		if ($controller == 'user' && $action == 'login') {
			return true;
		}
		return false;
	}

	private function check_permission() {
		if ($this->need_login) {
			if (!Auth::instance()->logged_in()) {
				HTTP::redirect('user/login');
			}
		}
		return;
		if (!$this->need_login || $this->not_need_login()) {
			//不需要登录的controller
			return true;
		} else {
			$auth = Auth::instance();
			if (!$auth->logged_in()) {
				HTTP::redirect('user/login');
			}
		}

		$controller = $this->request->controller();
		$action = $this->request->action();
		$auth = Auth::instance();

		if ($controller == 'User' && $action == 'login') {
			if ($auth->logged_in()) {
				HTTP::redirect();
			}
			return true;
		}

		if (in_array($action, $this->non_login_action)) {
			//需要登录的controller中不需要登录的action
			return true;
		}

		if ($auth->logged_in()) {
			if (($controller == 'User' && $action == 'edit_password') || $controller == 'Welcome' && $action == 'index') {
				return true;
			}

			$user_id = $this->login_user['id'];
			$model_user = new Model_User();
			$auth_list = $model_user->get_user_auth_list($user_id);
			foreach ($auth_list as $item) {
				if ($item['controller'] == lcfirst($controller) && $item['action'] == $action) {
					return true;
				}
			}
		}

		die($controller . ' 没有权限 ' . $action);
	}

}
