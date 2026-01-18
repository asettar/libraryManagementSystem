<?php

namespace src\models;

class Branch {
    private int $id;
    private string $name;
    private string $location;
    private int $operatingHours;

    public function __construct(int $id, string $name, string $location, int $operatingHours) {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->operatingHours = $operatingHours;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLocation(): string {
        return $this->location;
    }

    public function getOperatingHours(): int {
        return $this->operatingHours;
    }

    public function __toString(): string {
        return "Branch: {$this->name}, Location: {$this->location}, Hours: {$this->operatingHours}";
    }
}
?>
