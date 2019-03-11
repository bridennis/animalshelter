<?php

use App\AnimalShelter\AnimalShelter;
use App\AnimalShelter\Cat;
use App\AnimalShelter\Dog;
use App\AnimalShelter\Turtle;

require __DIR__ . '/vendor/autoload.php';

// Поместить в приют
AnimalShelter::takeInAnimal(new Cat('Васька', '2015-07-07'));
AnimalShelter::takeInAnimal(new Dog('Шарик', '2017-02-23'));
AnimalShelter::takeInAnimal(new Turtle('Тортилла', '1970-01-01'));
AnimalShelter::takeInAnimal(new Cat('Мурка', '2018-05-13'));
AnimalShelter::takeInAnimal(new Dog('Барбос', '2016-03-08'));
AnimalShelter::takeInAnimal(new Turtle('Леонардо', '2000-12-10'));
AnimalShelter::takeInAnimal(new Dog('Тузик', '2010-10-08'));

// Посмотреть всех животных определенного типа, сортированных по кличке в алфавитном порядке.
AnimalShelter::showAnimalListByTypeSortedByName(Dog::$type);
    echo "\n\n";

// Передать человеку  животное (определенного типа), находящееся в приюте наибольшее время.
if ($turtle = AnimalShelter::takeOutAnimal(Turtle::$type)) {
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
