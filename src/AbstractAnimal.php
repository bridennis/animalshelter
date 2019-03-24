<?php

namespace App;

use DateTime;

abstract class AbstractAnimal
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
        $this->setName($name);
        $this->setBirthday($birthday);
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
     * @return int
     */
    public function getAge() :int
    {
        try {
            return (new DateTime())->diff($this->getBirthday())->format('%y');
        } catch (\Exception $e) {
            return -1;
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

    /**
     * Устанавливает имя выполняя валидацию.
     *
     * @param string $name
     */
    private function setName(string $name): void
    {
        if (empty($name)) {
            throw new \BadMethodCallException('Неверный входной параметр: name');
        } else {
            $this->name = $name;
        }
    }

    /**
     * Устанавливает День рождения выполняя валидацию.
     *
     * @param string $birthday
     * @throws \Exception
     */
    private function setBirthday(string $birthday): void
    {
        if (empty($birthday)) {
            throw new \BadMethodCallException('Неверный входной параметр: birthday');
        } else {
            try {
                $this->birthday = (new DateTime(date($birthday)));
            } catch (\Exception $e) {
                throw $e;
            }
            if ($this->birthday->format('Y-m-d') > date('Y-m-d')) {
                throw new \OutOfBoundsException('Дата рождения не может быть больше текущей даты');
            }
        }
    }
}
