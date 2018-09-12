<?php

namespace App\Tests;

use App\Repository\FooBarRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FooBarRepositoryTest extends KernelTestCase
{
    /**
     * @var FooBarRepository
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        static::bootKernel();

        $this->repository = self::$container->get(FooBarRepository::class);
    }

    public function testSomething()
    {
        $this->assertTrue($this->repository->dummyMethodForPOC());
    }

    public function testSomething2()
    {
        $this->assertTrue($this->repository->dummyMethodForPOCToFail(), 'this should fail');
    }
}
