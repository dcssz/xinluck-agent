<?php
namespace App\Boot;
//  如果有命名空间需要指定 namespace
use Illuminate\Database\Capsule\Manager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EloquentServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register (Container $pimple)
    {
        $capsule = new Manager();
        $config  = $pimple['settings']['database'];
        $capsule->addConnection([
            'driver'    => $config['driver'],
            'read'      => $config['read'],
            'write'      => $config['write'],
            'database'  => $config['database'],
            'username'  => $config['username'],
            'password'  => $config['password'],
            'port'      => $config['port'],
            'charset'   => $config['charset'],
            'collation' => $config['collation'],
            'prefix'    => $config['prefix'],
            'strict'    => $config['strict']
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $pimple['db'] = function () use ($capsule) {
            return $capsule;
        };
    }
}