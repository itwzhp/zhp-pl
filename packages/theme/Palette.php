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
        $this->colors[] = new Color($config['name'], $config['label'], $config['default']);
    }

    /**
     * @return Iterator<Color>
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->colors);
    }

    public function getValues(): iterable
    {
        foreach ($this->iterator() as $color) {
            yield get_theme_mod($color->getName(), $color->getDefaultValue());
        }
    }
}
