<?php

namespace Test\Unit;

use RuntimeException;
use Test\TestCase;

class EthBatchTest extends TestCase
{
    /**
     * eth
     * 
     * @var \Web3\Eth
     */
    protected $eth;

    /**
     * setUp
     * 
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->eth = $this->web3->eth;
    }

    /**
     * testBatch
     * 
     * @return void
     */
    public function testBatch()
    {
        $eth = $this->eth;

        $eth->batch(true);
        $eth->protocolVersion();
        $eth->syncing();

        $eth->provider->execute(function ($err, $data) {
            if ($err !== null) {
                return $this->fail($err->getMessage());
            }
            $this->assertTrue(is_string($data[0]->result));
            $this->assertTrue($data[1]->result !== null);
        });
    }
}