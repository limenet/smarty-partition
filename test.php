<?php

require_once 'function.partition.php';

class Test extends PHPUnit_Framework_TestCase {
	public function wrapper($a) {
		return smarty_function_partition($a, null);
	}

    public function testEmpty()
    {
        $this->assertEquals(['test' => [[],[],[]]], $this->wrapper(['array' => null, 'name' => 'test', 'size' => 3]));
    }

    public function testZeroColumns()
    {
        $this->assertEquals(['test' => []], $this->wrapper(['array' => null, 'name' => 'test', 'size' => 0]));
    }

	public function testPerfectFit()
    {
        $this->assertEquals(['test' => [[1,2,3],[4,5,6],[7,8,9]]], $this->wrapper(['array' => range(1,9), 'name' => 'test', 'size' => 3]));
    }

	public function testPerfectOneShort()
    {
        $this->assertEquals(['test' => [[1,2,3],[4,5,6],[7,8]]], $this->wrapper(['array' => range(1,8), 'name' => 'test', 'size' => 3]));
    }

	public function testPerfectOneOver()
    {
        $this->assertEquals(['test' => [[1,2,3,4],[5,6,7],[8,9,10]]], $this->wrapper(['array' => range(1,10), 'name' => 'test', 'size' => 3]));
    }
}