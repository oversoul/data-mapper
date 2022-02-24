<?php

namespace Aecodes\Mapper\Tests;

use PHPUnit\Framework\TestCase;
use Aecodes\Mapper\EntityMapper;
use Aecodes\Mapper\Tests\Fixtures\SampleMapper;
use Aecodes\Mapper\Tests\Fixtures\SampleWithoutArguments;

/**
 * @coversNothing
 *
 * @internal
 */
class EntityMapperTest extends TestCase
{
    /** @test */
    public function itShouldCreateInstanceOfClassWithoutConstructorArguments()
    {
        $mapper = new EntityMapper(SampleMapper::class);
        $this->assertInstanceOf(SampleWithoutArguments::class, $mapper->map([]));
    }

    /** @test */
    public function itShouldCreateInstanceWithConstructorArguments()
    {
        $mapper = new EntityMapper(SampleMapper::class);
        $this->assertInstanceOf(SampleWithoutArguments::class, $mapper->map([]));
    }
}
