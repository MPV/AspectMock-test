<?php

use AspectMock\Test as AspectMock;

include __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../src/MyClass.php';

class MyClassTest extends PHPUnit_Framework_TestCase{
	
	public function testClassMethodWithoutMocking()
	{
		// Before mocking:
		$this->assertEquals('always this string', MyClass::myClassMethod());
	}
	
	public function testMockingClassMethod()
	{
		$this->initAspectMock();
		
		$mock = AspectMock::double(MyClass::class, ['myClassMethod' => 'a']);
		
		$classMethodReturned = MyClass::myClassMethod();
		$mock->verifyInvoked('myClassMethod');
		
		var_dump($mock->getCallsForMethod('myClassMethod'));
		
		$this->assertEquals('a', $classMethodReturned);
		
	}
	
	protected function initAspectMock()
	{
		$kernel = \AspectMock\Kernel::getInstance();
		$kernel->init([
			'debug' => true,
			'includePaths' => [
				__DIR__.'../src/'
			],
			'excludePaths' => [
				__DIR__	// tests
			]
		]);
	}
	
	/*
	// for later (when mocking works at all):
	protected function tearDown()
	{
		// remove all registered test doubles
		//AspectMock::clean();
	}
	*/

}
