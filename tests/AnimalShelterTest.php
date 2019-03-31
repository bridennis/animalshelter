<?php
declare(strict_types=1);

namespace AppTest;

use App\AnimalShelter;
use App\Cat;
use App\Dog;
use App\Turtle;
use BadMethodCallException;
use DateTime;
use OutOfBoundsException;
use \Exception;
use PHPUnit\Framework\TestCase;
use TypeError;

final class AnimalShelterTest extends TestCase
{

    public function tearDown(): void
    {
        while (AnimalShelter::takeOutAnimal() !== null) {
        }
    }

    /**
     * @throws \Exception
     */
    public function testCanBeCreatedFromValidCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('Васька', '2015-07-07'));

        $this->assertInstanceOf(
            Cat::class,
            AnimalShelter::takeOutAnimal(Cat::TYPE)
        );
    }

    /**
     * @expectedException TypeError
     */
    public function testCanNotBeCreatedFromInvalidObject(): void
    {
        AnimalShelter::takeInAnimal(null);
    }

    /**
     * @expectedException BadMethodCallException
     * @throws Exception
     */
    public function testCanNotBeCreatedFromEmptyNameCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('', ''));
    }

    /**
     * @expectedException BadMethodCallException
     * @throws \Exception
     */
    public function testCanNotBeCreatedFromEmptyBirthdayCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('CatName', ''));
    }

    /**
     * @expectedException Exception
     * @throws \Exception
     */
    public function testCanNotBeCreatedFromInvalidBirthdayDateCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('CatName', '2018-13-30'));
    }

    /**
     * @expectedException OutOfBoundsException
     * @throws \Exception
     */
    public function testCanNotBeCreatedFromOutOfBoundsBirthdayDateCatObject(): void
    {
        AnimalShelter::takeInAnimal(new Cat('CatName', '2059-03-14'));
    }

    /**
     * @throws \Exception
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

    /**
     * @throws Exception
     */
    public function testShowAnimalListGivenByTypeAndSortedByName() :void
    {
        $output = <<<'EOD'
Собака: Кличка - "Барбос", Возраст - "3" (лет)
Собака: Кличка - "Тузик", Возраст - "8" (лет)

EOD;
        $this->initAnimalList();

        $this->expectOutputString($output);

        AnimalShelter::showAnimalListByTypeSortedByName(Dog::TYPE);
    }

    /**
     * @throws Exception
     */
    public function testShowAnimalListGivenByType() :void
    {
        $output = <<<'EOD'
Собака: Кличка - "Тузик", Возраст - "8" (лет)
Собака: Кличка - "Барбос", Возраст - "3" (лет)

EOD;
        $this->initAnimalList();

        $this->expectOutputString($output);

        AnimalShelter::showAnimalListByType(Dog::TYPE);
    }

    /**
     * @throws Exception
     */
    protected function initAnimalList()
    {
        AnimalShelter::takeInAnimal(new Dog('Тузик', '2010-10-08'));
        AnimalShelter::takeInAnimal(new Turtle('Леонардо', '2000-12-10'));
        AnimalShelter::takeInAnimal(new Dog('Барбос', '2016-03-08'));
    }
}
