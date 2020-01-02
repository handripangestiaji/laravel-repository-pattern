<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Contract\FooRepositoryInterface;
use App\Service\FooService;

class FooServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMockFooService()
    {
        $repo = $this->getMockBuilder(FooRepositoryInterface::class)->getMock();

        $fooService = $this->getMockBuilder(FooService::class)
            ->setConstructorArgs(array($repo))
            ->setMethods(array('getAll'))
            ->getMock();

        $fooService->expects($this->once())
            ->method('getAll')
            ->will(array());
    }
}
