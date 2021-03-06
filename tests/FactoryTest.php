<?php

use Mockery as m;
use Karl456\Teamwork\Factory;

class FactoryTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->requestable = m::mock('Karl456\Teamwork\Contracts\RequestableInterface');
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @group factory
     */
    public function test_that_it_returns_new_account_object()
    {
        $factory = new Factory($this->requestable);
        $this->assertInstanceOf('Karl456\Teamwork\Account', $factory->account());
    }

    /**
     * @group factory
     * @expectedException Karl456\Teamwork\Exceptions\ClassNotCreatedException
     */
    public function test_that_it_fails_when_object_does_not_exist()
    {
        $factory = new Factory($this->requestable);
        $factory->butts();
    }

    /**
     * @group factory
     */
    public function test_that_it_parses_id_parameter()
    {
        $factory = new Factory($this->requestable);
        $activity = $factory->activity(30);

        $this->assertObjectHasAttribute('id', $activity);
        $this->assertEquals(30, $activity->getID());
    }

    /**
     * @group factory
     * @expectedException \InvalidArgumentException
     */
    public function test_that_it_only_accepts_integer_as_parameter()
    {
        $factory = new Factory($this->requestable);
        $factory->activity('butts');
    }
}