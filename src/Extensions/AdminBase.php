<?php
namespace App\Extensions;
use Interop\Container\ContainerInterface;

class AdminBase
{
	protected $container;
	protected $view;

	public function __Construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->view = $container->get('view');
		global $config;
		$this->acl = $container->get('acl');
		$this->role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
	}

}