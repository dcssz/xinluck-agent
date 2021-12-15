<?php

session_start();



require 'env.php';
require 'vendor/autoload.php';

use App\Boot\App;
use App\Acl\Exception AS AclException;
use Projek\Slim\PlatesProvider;
use Projek\Slim\Plates;
use Projek\Slim\PlatesExtension;

$config = require 'config.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

try {
	
	putenv('LC_ALL=zh_CN');
	setlocale(LC_ALL, 'zh_CN');	
	error_log(bind_textdomain_codeset('zh_CN', 'UTF-8'));
	error_log(bindtextdomain('zh_CN_2', './assets/locales'));

	error_log(textdomain('zh_CN_2'));
	//echo gettext('額度剩餘'); 
 

	$app = new App($config, $role);

	// Get container
	$container = $app->getContainer();
    // Register component on container
    $container['view'] = function ($container) { $view = new Plates([
            // Path to view directory (default: null)
            'directory' => 'plates',
            // Template extension (default: false) see: http://platesphp.com/extensions/asset/
            'timestampInFilename' => false,
        ]);

        // Set \Psr\Http\Message\ResponseInterface object
        // Or you can optionaly pass `$c->get('response')` in `__construct` second parameter
        $view->setResponse($container->get('response'));

        // Instantiate and add Slim specific extension
        $view->loadExtension(new PlatesExtension(
            $container->get('router'),
            $container->get('request')->getUri()
        ));

        return $view;
	};

	$app->run();
} catch (AclException $ex) {
	echo '<script>alert("登陆超时或者权限不足"); location.href="'.BASE_URL.'";</script>';
} catch (Exception $ex) {
    echo $ex;
	// echo '内部错误';
}

