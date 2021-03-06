<?php

//include __DIR__.'/../vendor/autoload.php';
//include __DIR__.'/../src/MyClass.php';

class MyClassTest extends PHPUnit_Framework_TestCase{
	
	/*
	public function testClassMethodWithoutMocking()
	{
		$this->assertEquals('always this string', MyClass::myClassMethod());
	}
	*/
	
	public function testMockingClassMethod()
	{
		$this->initAspectMock();
		
		//$mock = \AspectMock\Test::double(MyClass::class, ['myClassMethod' => 'a']);
		$mock = \AspectMock\Test::double('MyClass', ['myClassMethod' => 'a']);
		//$mock = \AspectMock\Test::double('\MyClass', ['myClassMethod' => 'a']);
		
		$classMethodReturned = MyClass::myClassMethod();
		
		// Extra verification to see if the AspectMock double is actually being run yet:
		//$mock->verifyInvoked('myClassMethod');
		
		$this->assertEquals('a', $classMethodReturned);
	}
	
	protected function initAspectMock()
	{
		/** @var \AspectMock\Kernel $kernel */
		$kernel = \AspectMock\Kernel::getInstance();
		$kernel->init([
			'debug' => true,
			//'appDir' => __DIR__ . '../',
			'includePaths' => [
				__DIR__.'/../src/',
				//__DIR__.'../vendor/',
			],
			'excludePaths' => [
				__DIR__,	// tests
				//__DIR__.'../vendor/',
			]
		]);
		$kernel->loadFile(__DIR__ . '/../vendor/autoload.php');
		$kernel->loadFile(__DIR__ . '/../src/MyClass.php');
	}
	
	/*
	// for later (when mocking works at all):
	protected function tearDown()
	{
		// remove all registered test doubles
		//\AspectMock\Test::clean();
	}
	*/

}
