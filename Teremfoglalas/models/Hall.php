<?php
class Hall
{
    private int $id;
    private string $name;

    private float $size;
    public function __construct(int $id, string $name, float $size)
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSize()
    {
        return $this->size;
    }
}
?>