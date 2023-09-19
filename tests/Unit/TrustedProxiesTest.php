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
        $ip = $this->runWithCount(0);
        self::assertSame('1.1.1.1', $ip);

        $ip = $this->runWithCount(1);
        self::assertSame('2.2.2.2', $ip);

        $ip = $this->runWithCount(2);
        self::assertSame('3.3.3.3', $ip);

        $ip = $this->runWithCount(3);
        self::assertSame('4.4.4.4', $ip);

        $ip = $this->runWithCount(4);
        self::assertSame('4.4.4.4', $ip);
    }

    private function runWithCount($count): ?string
    {
        $server = [
            'REMOTE_ADDR' => '1.1.1.1',
            'HTTP_X-FORWARDED-FOR' => '4.4.4.4, 3.3.3.3, 2.2.2.2',
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
