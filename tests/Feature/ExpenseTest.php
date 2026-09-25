<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    public function test_it_can_run_successfully()
    {
        $this->assertTrue(true);
    }

    public function test_expenses_page_uses_formatted_currency_input()
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="amountInput"');
        $response->assertSee('formatRupiah');
    }
}


