<?php

class Palette
{
    /**
     * Colors
     *
     * @var Color[]
     */
    private $colors = [];
    public function load(array $config)
    {
        foreach ($config as $item) {
            $this->colors[] = new Color($item['name'], $item['label'], $item['default']);
        }
    }

    /**
     * @return Iterator<Color>
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->colors);
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->iterator() as $color) {
            $values[$color->getName()] =  get_theme_mod($color->getName(), $color->getDefaultValue());
        }
        return $values;
    }
}
