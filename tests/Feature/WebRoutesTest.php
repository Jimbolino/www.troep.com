<?php

declare(strict_types=1);

namespace Tests\Feature;

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
    }
}
