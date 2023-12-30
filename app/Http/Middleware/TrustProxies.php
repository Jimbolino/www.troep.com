<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;

class TrustProxies
{
    /**
     * The proxy header mappings.
     */
    protected int $headers = Request::HEADER_X_FORWARDED_AWS_ELB;

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
        if ($this->proxyCount) {
            $proxies = explode(', ', (string) $request->server->get('HTTP_X_FORWARDED_FOR'));
            if (\count($proxies) !== $this->proxyCount) {
                throw new Exception('proxyCount mismatch: '.\count($proxies).' !== '.$this->proxyCount);
            }

            // the first ip in HTTP_X_FORWARDED_FOR is actually the users ip
            // replace it with REMOTE_ADDR, because that is the last proxy server
            $proxies[0] = $request->server->get('REMOTE_ADDR');

            $request->setTrustedProxies($proxies, $this->headers);
        }

        return $next($request);
    }
}
