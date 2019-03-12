<?php

use App\AnimalShelter;
use App\Cat;
use App\Dog;
use App\Turtle;

require __DIR__ . '/vendor/autoload.php';

// Поместить в приют
try {
    AnimalShelter::takeInAnimal(new Cat('Васька', '2015-07-07'));
    AnimalShelter::takeInAnimal(new Dog('Шарик', '2017-02-23'));
    AnimalShelter::takeInAnimal(new Turtle('Тортилла', '1970-01-01'));
    AnimalShelter::takeInAnimal(new Cat('Мурка', '2018-05-13'));
    AnimalShelter::takeInAnimal(new Dog('Барбос', '2016-03-08'));
    AnimalShelter::takeInAnimal(new Turtle('Леонардо', '2000-12-10'));
    AnimalShelter::takeInAnimal(new Dog('Тузик', '2010-10-08'));
    /* @TODO Сделать тесты */
//    AnimalShelter::takeInAnimal(new Cat('noname', '2018-13-30'));
//    AnimalShelter::takeInAnimal(new Cat('noname', '2029-03-14'));
//    AnimalShelter::takeInAnimal('');
} catch (Exception | TypeError$e) {
    die(sprintf("Ошибка:\n%s\n%s", $e->getMessage(), $e->getTraceAsString()));
}

// Посмотреть всех животных определенного типа, сортированных по кличке в алфавитном порядке.
AnimalShelter::showAnimalListByTypeSortedByName(Dog::TYPE);
    echo "\n\n";

// Передать человеку  животное (определенного типа), находящееся в приюте наибольшее время.
if ($turtle = AnimalShelter::takeOutAnimal(Turtle::TYPE)) {
    printf("Передали человеку: %s\n", $turtle);
    echo "Остались в приюте:\n";
    AnimalShelter::showAnimalListByType();
    echo "\n\n";
}

// Передать человеку животное (без указания типа), находящееся  приюте наибольшее время.
if ($animal = AnimalShelter::takeOutAnimal()) {
    printf("Передали человеку: %s\n", $animal);
    echo "Остались в приюте:\n";
    AnimalShelter::showAnimalListByType();
    echo "\n\n";
}
