<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class DatabaseConnectionTest extends TestCase
{
    /**
     * Test database connection.
     *
     * @return void
     */
    public function test_database_connection()
    {
        $this->assertTrue(FacadesDB::connection()->getPdo() != null);
    }
}
