<?php

class CodeTest extends PHPUnit_Framework_TestCase
{
    public function wrapper($a = [])
    {
        return smarty_function_partition($a, null);
    }

    public function testEmpty()
    {
        $this->assertEquals([], $this->wrapper(['array' => null, 'name' => 'test', 'size' => 3])['test']);
    }

    public function testOneElement()
    {
        $this->assertEquals([[1], [], []], $this->wrapper(['array' => [1], 'name' => 'test', 'size' => 3])['test']);
    }

    public function testOneColumn()
    {
        $this->assertEquals([[1]], $this->wrapper(['array' => [1], 'name' => 'test', 'size' => 1])['test']);
    }

    public function testOneColumnEmpty()
    {
        $this->assertEquals([[]], $this->wrapper(['array' => [], 'name' => 'test', 'size' => 1])['test']);
    }

    public function testZeroColumns()
    {
        $this->assertEquals([], $this->wrapper(['array' => null, 'name' => 'test', 'size' => 0])['test']);
    }

    public function testNegativeSize()
    {
        $this->assertEquals([], $this->wrapper(['array' => range(1, 9), 'name' => 'test', 'size' => -3])['test']);
    }

    public function testPerfectFit()
    {
        $this->assertEquals([[1, 2, 3], [4, 5, 6], [7, 8, 9]], $this->wrapper(['array' => range(1, 9), 'name' => 'test', 'size' => 3])['test']);
    }

    public function testOneShort()
    {
        $this->assertEquals([[1, 2, 3], [4, 5, 6], [7, 8]], $this->wrapper(['array' => range(1, 8), 'name' => 'test', 'size' => 3])['test']);
    }

    public function testOneOver()
    {
        $this->assertEquals([[1, 2, 3, 4], [5, 6, 7], [8, 9, 10]], $this->wrapper(['array' => range(1, 10), 'name' => 'test', 'size' => 3])['test']);
    }

    public function testMissingArrayParameter()
    {
        $this->assertFalse($this->wrapper(['name' => 'test', 'size' => 3]));
    }

    public function testEmptyNameParameter()
    {
        $this->assertFalse($this->wrapper(['array' => range(1, 10), 'name' => null, 'size' => 3]));
    }

    public function testMissingParameters()
    {
        $this->assertFalse($this->wrapper());
    }
}
