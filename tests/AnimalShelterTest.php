<?php
declare(strict_types=1);

use App\AnimalShelter;
use App\Cat;
use PHPUnit\Framework\TestCase;

final class AnimalShelterTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCanBeCreatedFromValidCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('Васька', '2015-07-07'));

        $this->assertInstanceOf(
            Cat::class,
            AnimalShelter::takeOutAnimal(Cat::TYPE)
        );
    }

    public function testCanNotBeCreatedFromInvalidCatObject(): void
    {
        $this->expectException(TypeError::class);

        AnimalShelter::takeInAnimal(null);
    }

    /**
     * @throws Exception
     */
    public function testCannotBeCreatedFromEmptyName(): void
    {
        $this->expectException(BadMethodCallException::class);

        AnimalShelter::takeInAnimal(new Cat('', ''));
    }

    /**
     * @throws Exception
     */
    public function testCannotBeCreatedFromEmptyBirthday(): void
    {
        $this->expectException(BadMethodCallException::class);

        AnimalShelter::takeInAnimal(new Cat('CatName', ''));
    }

    /**
     * @throws Exception
     */
    public function testCannotBeCreatedFromInvalidBirthdayDate(): void
    {
        $this->expectException(Exception::class);

        AnimalShelter::takeInAnimal(new Cat('CatName', '2018-13-30'));
    }

    /**
     * @throws Exception
     */
    public function testCannotBeCreatedFromOutOfBoundsBirthdayDate(): void
    {
        $this->expectException(OutOfBoundsException::class);

        AnimalShelter::takeInAnimal(new Cat('CatName', '2059-03-14'));
    }

    /**
     * @throws Exception
     */
    public function testCanBeValidTakeOutAsCatAnimal(): void
    {
        $name = 'Васька';
        $birthday = '2015-07-07';

        AnimalShelter::takeInAnimal(new Cat($name, $birthday));
        $cat = AnimalShelter::takeOutAnimal(Cat::TYPE);

        $this->assertInstanceOf(
            Cat::class,
            $cat
        );
        $this->assertEquals(
            $name,
            $cat->getName()
        );
        $this->assertEquals(
            new DateTime($birthday),
            $cat->getBirthday()
        );
    }
}