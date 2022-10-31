<?php

class Color
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $defaultHexColor;

    /**
     * @var string
     */
    private $label;
    public function __construct(string $name, string $label, string $defaultHexColor)
    {
        $this->name = $name;
        $this->label = $label;
        $this->defaultHexColor = $defaultHexColor;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultHexColor;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
