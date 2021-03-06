<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Controllers\DecryptNavicatController;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class WebRoutesTest extends TestCase
{
    public function testRoot(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testStartpage(): void
    {
        $response = $this->get('/startpage.php');
        $response->assertStatus(200);
    }

    public function testContact(): void
    {
        $response = $this->get('/mailmij.php');
        $response->assertStatus(200);

        $response = $this->post('/mailmij.php');
        $response->assertStatus(200);
    }

    public function testIp(): void
    {
        $response = $this->get('/ip');
        $response->assertStatus(200);
    }

    public function testTime(): void
    {
        $response = $this->get('/tools/time.php');
        $response->assertStatus(200);
    }

    public function testViewSource(): void
    {
        $response = $this->get('/tools/viewsource.php');
        $response->assertStatus(200);
    }

    public function testProxy(): void
    {
        $response = $this->get('/bookmarks.htm');
        $response->assertStatus(200);

        $response = $this->get('/linux.htm');
        $response->assertStatus(200);

        $response = $this->get('/tha-music.htm');
        $response->assertStatus(200);
    }

    public function testTroep(): void
    {
        $response = $this->get('/troep');
        $response->assertStatus(200);

        Storage::disk('local')->put('troep/HEADER.html', 'testing');

        $response = $this->get('/troep/HEADER.html');
        $response->assertStatus(200);

        Storage::disk('local')->delete('troep/HEADER.html');
    }

    public function testNavicat(): void
    {
        $response = $this->get('/navicat');
        $response->assertStatus(200);

        $response = $this->get('/navicat?'.http_build_query(['version' => DecryptNavicatController::DEFAULT_VERSION, 'password' => DecryptNavicatController::DEFAULT_HASH]));
        $response->assertStatus(200);
    }

    public function testDebug(): void
    {
        $this->get('/debug')->assertStatus(200);
        $this->get('/debug/config')->assertStatus(200);
        $this->get('/debug/cookie')->assertStatus(200);
        $this->get('/debug/phpinfo')->assertStatus(200);
        $this->get('/debug/request')->assertStatus(200);
        $this->get('/debug/server')->assertStatus(200);
    }

    public function testMeuktracker(): void
    {
        static::markTestSkipped();
        $this->get('/meuktracker')->assertStatus(200);
        $this->get('/meuktracker/office')->assertStatus(200);
        $this->get('/meuktracker/office?32')->assertStatus(200);
        $this->get('/meuktracker/office?json')->assertStatus(200);
    }
}
