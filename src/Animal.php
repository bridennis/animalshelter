<?php

namespace App;

use DateTime;

abstract class Animal
{
    /**
     * @var string Кличка.
     */
    private $name;

    /**
     * @var DateTime День рождения.
     */
    private $birthday;

    /**
     * @var string Тип животного.
     */
    const TYPE = 'Животное';

    /**
     * Animal constructor.
     *
     * @param string $name Кличка
     * @param string $birthday День рождения в формате YYYY-MM-DD
     * @throws \Exception
     */
    public function __construct(string $name, string $birthday)
    {
        if (empty($name) || empty($birthday)) {
            throw new \BadMethodCallException('Неверные входные параметры');
        } else {
            try {
                $this->birthday = (new DateTime(date($birthday)));
                if ($this->birthday->format('Y-m-d') > date('Y-m-d')) {
                    throw new \OutOfBoundsException('Дата рождения не может быть больше текущей');
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }
        $this->name = $name;
    }

    /**
     * Возвращает строковое представление объекта.
     *
     * @return string
     */
    public function __toString() :string
    {
        return sprintf(
            '%s: Кличка - "%s", Возраст - "%s" (лет)' . "\n",
            $this->getType(),
            $this->getName(),
            $this->getAge()
        );
    }

    /**
     * Возвращает возраст.
     *
     * @return int|string
     */
    public function getAge() :string
    {
        try {
            return (new DateTime(date('Y-m-d')))->diff($this->getBirthday())->format('%y');
        } catch (\Exception $e) {
            return '-';
        }
    }

    /**
     * Возвращает имя.
     *
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * Возвращает дату рождения.
     *
     * @return DateTime
     */
    public function getBirthday() :DateTime
    {
        return $this->birthday;
    }

    /**
     * Возвращает тип животного.
     *
     * @return string
     */
    public function getType() :string
    {
        return $this::TYPE;
    }
}
