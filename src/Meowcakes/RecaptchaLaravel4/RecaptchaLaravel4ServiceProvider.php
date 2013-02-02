<?php namespace Meowcakes\RecaptchaLaravel4;

use Illuminate\Support\ServiceProvider;

class RecaptchaLaravel4ServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('meowcakes/recaptcha-laravel4');
		
		$this->app['validator']->extend('recaptcha', function($attribute, $value, $parameters)
		{
			$recaptcha = Recaptcha::recaptcha_check_answer($parameters[0], Request::ip(), Input::get('recaptcha_challenge_field'), $value);

			return $recaptcha->is_valid;
		});	
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}