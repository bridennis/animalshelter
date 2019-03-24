<?php

namespace App;

class AnimalShelter
{
    private static $animalList = [];

    /**
     * Поместить в приют.
     *
     * @param AbstractAnimal $animal
     */
    public static function takeInAnimal(AbstractAnimal $animal)
    {
        static::$animalList[] = $animal;
    }

    /**
     * Передать человеку  животное (определенного типа/без указания типа), находящееся в приюте наибольшее время.
     *
     * @param string $type
     * @return AbstractAnimal|null
     */
    public static function takeOutAnimal(string $type = null) :?AbstractAnimal
    {
        // Первые в списке добавленных находятся наибольшее время в приюте

        /** @var AbstractAnimal $animal */
        foreach (static::$animalList as $k => $animal) {
            if ($animal->getType() === $type || empty($type)) {
                unset(static::$animalList[$k]);
                return $animal;
            }
        }

        return null;
    }

    /**
     * Посмотреть всех животных определенного типа, сортированных по кличке в алфавитном порядке.
     *
     * @param string $type
     */
    public static function showAnimalListByTypeSortedByName(string $type = null)
    {
        $filter = [];
        /** @var AbstractAnimal $animal */
        foreach (static::getAnimalListByType($type) as $k => $animal) {
            $filter[$k] = $animal->getName();
        }

        if (count($filter) > 0) {
            asort($filter);
            foreach (array_keys($filter) as $k) {
                echo static::$animalList[$k];
            }
        }
    }

    /**
     * Посмотреть всех животных определенного типа.
     *
     * @param string $type
     */
    public static function showAnimalListByType(string $type = null)
    {
        foreach (static::getAnimalListByType($type) as $animal) {
            echo $animal;
        }
    }

    /**
     * Получить всех животных определенного типа.
     *
     * @param string|null $type
     * @return \Generator
     */
    private static function getAnimalListByType(string $type = null)
    {
        /** @var AbstractAnimal $animal */
        foreach (static::$animalList as $k => $animal) {
            if ($animal->getType() === $type || empty($type)) {
                yield $k => $animal;
            }
        }
    }
}
