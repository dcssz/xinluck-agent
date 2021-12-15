<?php

namespace App\Boot;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

use App\Acl\Acl;

class AclServiceProvider implements ServiceProviderInterface
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
		$acl = require 'acl.php';
		$acl = new Acl($acl);

        $pimple['acl'] = function () use ($acl) {
            return $acl;
        };
    }
}