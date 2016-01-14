<?php

//include __DIR__.'/../vendor/autoload.php'; // composer autoload
include __DIR__.'/../src/MyClass.php';

class MyClassTest extends PHPUnit_Framework_TestCase{
	
	public function testTesting()
	{
		$this->assertTrue(true);
	}
	
	public function testTesting2()
	{
		$this->assertTrue(true);
	}
	
	public function testMockingClassMethod()
	{
		$classMethodReturns = MyClass::myClassMethod();

		$this->assertEquals('a', $classMethodReturns);
	}

}
