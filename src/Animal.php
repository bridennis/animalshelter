<?php

namespace App\AnimalShelter;

use DateTime;

abstract class Animal
{
    /*
     * Кличка
     */
    private $name;

    /*
     * День рождения
     */
    private $birthday;

    /*
     * Тип животного
     */
    protected static $type;

    /**
     * Animal constructor.
     *
     * @param string $name     Кличка
     * @param string $birthday День рождения
     */
    public function __construct($name, $birthday)
    {
        $this->setName($name);
        $this->setBirthday($birthday);
    }

    public function __toString()
    {
        return sprintf(
            '%s: Кличка - "%s", Возраст - "%s" (лет)' . "\n",
            $this->getType(),
            $this->getName(),
            $this->getAge()
        );
    }

    public function getAge()
    {
        try {
            return (new DateTime(date('Y-m-d')))
                ->diff(new DateTime($this->getBirthday()))
                ->format('%y');
        } catch (\Exception $e) {
            return '-';
        }
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    private function setBirthday($date)
    {
        $this->birthday = $date;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return static::$type;
    }
}
