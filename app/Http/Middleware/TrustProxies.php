<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;

class TrustProxies
{
    /**
     * The amount of trusted proxies for this setup.
     */
    protected int $proxyCount;

    public function __construct(Repository $config)
    {
        $this->proxyCount = (int) $config->get('trustedproxy.count');
    }

    public function handle(Request $request, Closure $next)
    {
        $proxies = [];
        for ($i = 0; $i < $this->proxyCount; ++$i) {
            $proxies[] = $request->getClientIp();
            $request->setTrustedProxies($proxies, Request::HEADER_X_FORWARDED_AWS_ELB);
        }

        return $next($request);
    }
}
