<?php

namespace src\models;

use DateTime;

class Author {
    private int $id;
    private string $name;
    private string $biography;
    private string $nationality;
    private string $primaryGenre;
    private DateTime $birthDate;
    private ?DateTime $deathDate;

    public function __construct(
        int $id, string $name, string $biography, string $nationality, string $primaryGenre, DateTime $birthDate, ?DateTime $deathDate) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
        $this->primaryGenre = $primaryGenre;
        $this->birthDate = $birthDate;
        $this->deathDate = $deathDate;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getBiography(): string {
        return $this->biography;
    }
    public function getNationality(): string {
        return $this->nationality;
    }
    public function getBirthDate(): DateTime {
        return $this->birthDate;
    }
    public function getDeathDate(): ?DateTime {
        return $this->deathDate;
    }
    public function getPrimaryGenre(): string {
        return $this->primaryGenre;
    }

    public function __toString() : string{
        return "Name: {$this->name}, Nationality: {$this->nationality}, Primary Genre: {$this->primaryGenre}\n";
    }   
}
?>