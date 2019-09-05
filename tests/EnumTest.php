<?php
/**
 * EnumTest class file
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */
declare(strict_types=1);

include './entities/TextAlign.php';

use PHPUnit\Framework\TestCase;

/**
 * Class EnumTest
 */
final class EnumTest extends TestCase
{
    public function testEnumerations()
    {
        $this->assertIsArray($enumerations = TextAlign::enumerations());
        $this->assertCount(3, $enumerations);

        foreach ($enumerations as $enumeration) {

            $this->assertInstanceOf(TextAlign::class, $enumeration);
        }
    }

    public function testEnumHas()
    {
        $this->assertTrue(TextAlign::has('LEFT'));
        $this->assertTrue(TextAlign::has('CENTER'));
        $this->assertTrue(TextAlign::has('RIGHT'));
    }

    public function testName()
    {
        $this->assertEquals('LEFT', TextAlign::LEFT()->name());
        $this->assertEquals('CENTER', TextAlign::CENTER()->name());
        $this->assertEquals('RIGHT', TextAlign::RIGHT()->name());
    }

    public function testTranslateReturnsName()
    {
        $this->assertEquals(TextAlign::LEFT()->name(), TextAlign::LEFT()->translate());
        $this->assertEquals(TextAlign::CENTER()->name(), TextAlign::CENTER()->translate());
        $this->assertEquals(TextAlign::RIGHT()->name(), TextAlign::RIGHT()->translate());
    }

    public function testRefresh()
    {
        $this->assertEquals(TextAlign::LEFT(), TextAlign::LEFT()->refresh());
        $this->assertEquals(TextAlign::CENTER(), TextAlign::CENTER()->refresh());
        $this->assertEquals(TextAlign::RIGHT(), TextAlign::RIGHT()->refresh());
    }

    public function testCompare()
    {
        $this->assertTrue(TextAlign::LEFT()->equals(TextAlign::LEFT()));
        $this->assertTrue(TextAlign::CENTER()->equals(TextAlign::CENTER()));
        $this->assertTrue(TextAlign::RIGHT()->equals(TextAlign::RIGHT()));
    }

    public function testCompareFails()
    {
        $this->assertFalse(TextAlign::LEFT()->equals(TextAlign::RIGHT()));
        $this->assertFalse(TextAlign::CENTER()->equals(TextAlign::LEFT()));
        $this->assertFalse(TextAlign::RIGHT()->equals(TextAlign::CENTER()));
    }

    public function testValueOfThrowsException()
    {
        $this->expectException(DomainException::class);
        TextAlign::valueOf('FOO_BAR');
    }
}