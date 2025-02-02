<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\MailContentServices;
use App\Console\Commands\CheckDebtors;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Debtor20Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_debtors_20_dey__annul_data(): void
    {
        $annul_data = strtotime('+3 day');

        $serv = new MailContentServices();
        $content = $serv->get_no_active_numbers('debt20', [
            'truc_number' => "222222",
            'annul_data' => date("d.m.Y", $annul_data),
        ]);

        dd($content);

        $this->assertEquals();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
