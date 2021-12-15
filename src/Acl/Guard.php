<?php
namespace App\Acl;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Permissions\Acl\AclInterface;

class Guard
{
    /**
     * @param  Array $acl The preconfigured ACL service
     */
    public function __construct(AclInterface $acl, $currentUserRole)
    {
        $this->acl             = $acl;
        $this->currentUserRole = $currentUserRole;
    }

    /**
     * Invoke middleware
     *
     * @param  RequestInterface  $request  PSR7 request object
     * @param  ResponseInterface $response PSR7 response object
     * @param  callable          $next     Next middleware callable
     *
     * @return ResponseInterface PSR7 response object
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $isAllowed = false;
		if ($request->getAttribute('route') == null) {//未找到时默认放行
			return $next($request, $response);
		}

        if ($this->acl->hasResource('route'.$request->getAttribute('route')->getPattern())) {
            $isAllowed = $isAllowed || $this->acl->isAllowed($this->currentUserRole, 'route'.$request->getAttribute('route')->getPattern(), strtolower($request->getMethod()));
        }

        if (!$isAllowed) {
			throw new Exception($this->currentUserRole, $request->getMethod().' '.$request->getAttribute('route')->getPattern());
        }
        return $next($request, $response);
    }
}
