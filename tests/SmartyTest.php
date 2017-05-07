<?php

use PHPUnit\Framework\TestCase;

class SmartyTest extends TestCase
{
    protected $smarty;

    public function setUp()
    {
        $this->smarty = new Smarty();
        $this->smarty->setCompileDir(sys_get_temp_dir());
    }

    public function testEmpty()
    {
        $this->htmlOutput(null, '');
    }

    public function testNoDate()
    {
        $this->htmlOutput([], '<ul></ul><ul></ul><ul></ul><ul></ul>');
    }

    public function testOneElement()
    {
        $this->htmlOutput([1], '<ul><li>1</li></ul><ul></ul><ul></ul><ul></ul>');
    }

    public function testPerfectFit()
    {
        $this->htmlOutput(range(1, 12), '<ul><li>1</li><li>2</li><li>3</li></ul><ul><li>4</li><li>5</li><li>6</li></ul><ul><li>7</li><li>8</li><li>9</li></ul><ul><li>10</li><li>11</li><li>12</li></ul>');
    }

    public function testOneShort()
    {
        $this->htmlOutput(range(1, 11), '<ul><li>1</li><li>2</li><li>3</li></ul><ul><li>4</li><li>5</li><li>6</li></ul><ul><li>7</li><li>8</li><li>9</li></ul><ul><li>10</li><li>11</li></ul>');
    }

    public function testOneOver()
    {
        $this->htmlOutput(range(1, 13), '<ul><li>1</li><li>2</li><li>3</li><li>4</li></ul><ul><li>5</li><li>6</li><li>7</li></ul><ul><li>8</li><li>9</li><li>10</li></ul><ul><li>11</li><li>12</li><li>13</li></ul>');
    }

    protected function htmlOutput(?array $input, string $output)
    {
        $testFile = __DIR__.'/test.tpl';
        $this->smarty->assign('oneToNine', $input);

        $this->assertSame($input, $this->smarty->getTemplateVars()['oneToNine']);

        $html = $this->smarty->fetch($testFile);

        $this->assertSame($output, $html);
    }
}
