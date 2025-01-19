<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Auth\WebAuth;
use Fluxoft\Rebar\Container;
use RebarBase\Mappers\UserMapper;

class Auth extends BaseWebController {
	protected WebAuth $auth;

	protected UserMapper $userMapper;

	public function Setup(Container $container): void {
		parent::Setup($container);
		$this->auth       = $container['WebAuth'];
		$this->userMapper = $container['UserMapper'];
	}

	/**
	 * Login method: Handles the login process.
	 */
	public function Login(): void {
		$errorMessage = '';
		if ($this->request->Method === 'POST') {
			$username = $this->request->Post('username', '');
			$password = $this->request->Post('password', '');
			$redirect = $this->request->Post('redirect', '/');

			if (empty($username) || empty($password)) {
				$errorMessage = 'Please enter a username and password.';
			} else {
				try {
					$reply = $this->auth->Login($this->request, $username, $password);
					if ($reply->Auth) {
						// If the login was successful, save the last login time
						/** @var \RebarBase\Models\User $user */
						$user              = $reply->User;
						$user->LastLoginOn = date('Y-m-d H:i:s');
						$this->userMapper->Save($user);

						$this->response->Redirect($redirect);
					} else {
						$errorMessage = 'Invalid username or password.';
					}
				} catch (\Exception $e) {
					$errorMessage  = 'An error occurred while trying to log in.';
					$errorMessage .= '<br>'.$e->getMessage();
				}
			}
		} else {
			$username = '';
			$redirect = $this->request->Get('redirect', '/');
		}
		$this->response->AddData('title', 'Login');
		$this->response->AddData('username', $username);
		$this->response->AddData('redirect', $redirect);
		$this->response->AddData('error', $errorMessage);
		$this->response->Presenter->Template = 'auth/login.phtml';
	}

	/**
	 * Logout method: Logs the user out and redirects to the home page.
	 */
	public function Logout(): void {
		$this->auth->Logout($this->request);
		$this->response->Redirect('/');
	}
}
