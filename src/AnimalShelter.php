<?php

namespace App\AnimalShelter;

class AnimalShelter extends Singleton
{
    private $animalList = null;

    /**
     * Поместить в приют.
     * @param Animal $animal
     */
    public static function takeInAnimal($animal)
    {
        if ($animal instanceof Animal
            && !empty($animal->getName())
            && !empty($animal->getBirthday())
        ) {
            AnimalShelter::getInstance()->animalList[] = $animal;
        }
    }

    /**
     * Передать человеку  животное (определенного типа/без указания типа), находящееся в приюте наибольшее время.
     * @param string $type
     * @return Animal|null
     */
    public static function takeOutAnimal($type = '')
    {
        /** @var AnimalShelter $animalShelter */
        $animalShelter = AnimalShelter::getInstance();

        // Первые в списке добавленных находятся наибольшее время в приюте

        /** @var Animal $animal */
        foreach ($animalShelter->animalList as $k => $animal) {
            if ($animal->getType() == $type || empty($type)) {
                unset($animalShelter->animalList[$k]);
                return $animal;
            }
        }

        return null;
    }

    /**
     * Посмотреть всех животных определенного типа, сортированных по кличке в алфавитном порядке.
     * @param string $type
     */
    public static function showAnimalListByTypeSortedByName($type = '')
    {
        /** @var AnimalShelter $animalShelter */
        $animalShelter = AnimalShelter::getInstance();

        $filter = [];
        /** @var Animal $animal */
        foreach ($animalShelter->animalList as $k => $animal) {
            if ($animal->getType() == $type || empty($type)) {
                $filter[$k] = $animal->getName();
            }
        }

        if (count($filter) > 0) {
            asort($filter);
            foreach ($filter as $k => $v) {
                echo $animalShelter->animalList[$k];
            }
        }
    }

    /**
     * Посмотреть всех животных определенного типа.
     * @param string $type
     */
    public static function showAnimalListByType($type = '')
    {
        /** @var Animal $animal */
        foreach (AnimalShelter::getInstance()->animalList as $animal) {
            if ($animal->getType() == $type || empty($type)) {
                echo $animal;
            }
        }
    }
}
