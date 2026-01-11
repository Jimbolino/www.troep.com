<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Http\Middleware\TrustProxies;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class TrustedProxiesTest extends TestCase
{
    public function testProxyCount(): void
    {
        $ip = $this->runWithCount(0, '9.9.9.9');
        static::assertSame('1.1.1.1', $ip);

        $ip = $this->runWithCount(1, '2.2.2.2');
        static::assertSame('2.2.2.2', $ip);

        $ip = $this->runWithCount(2, '3.3.3.3, 2.2.2.2');
        static::assertSame('3.3.3.3', $ip);

        $ip = $this->runWithCount(3, '4.4.4.4, 3.3.3.3, 2.2.2.2');
        static::assertSame('4.4.4.4', $ip);

        self::expectExceptionMessage('proxyCount mismatch: 3 !== 4');
        $this->runWithCount(4, '4.4.4.4, 3.3.3.3, 2.2.2.2');
    }

    private function runWithCount($count, $proxies): ?string
    {
        $server = [
            'REMOTE_ADDR' => '1.1.1.1',
            'HTTP_X_FORWARDED_FOR' => $proxies,
        ];
        $request = new Request([], [], [], [], [], $server);

        $middleware = new TrustProxies(new Repository([
            'trustedproxy' => [
                'count' => $count,
            ],
        ]));
        $next = static function (): void {}; // @phan-suppress-current-line PhanEmptyClosure
        $middleware->handle($request, $next);

        return $request->getClientIp();
    }
}
