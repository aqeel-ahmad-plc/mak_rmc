<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'auth'	   => \App\Filters\Auth::class,
		'admin'	   => [
			\App\Filters\Auth::class,
			\App\Filters\Admin::class,
		],
		'admin_exec' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec::class,
		],
		'admin_exec_surveyor' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec_Surveyor::class,
		],
		'admin_exec_surveyor_stock_usr' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec_Surveyor_StockUsr::class,
		],
		'admin_exec_stock_usr' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec_StockUsr::class,
		],
		'admin_exec_surveyor_usr' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec_Surveyor_Usr::class,
		],
		'admin_exec_surveyor_usr_stock_usr' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_Exec_Surveyor_Usr_StockUsr::class,
		],
		'admin_stock_usr' => [
			\App\Filters\Auth::class,
			\App\Filters\Admin_StockUsr::class,
		],
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [];
}
