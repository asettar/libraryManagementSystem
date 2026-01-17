<?php 

namespace src\interfaces; 

interface ConnectionInterface {
    public function query(string $sql, array $data) : bool;
    public function fetchAll(string $sql, array $data): ?array;
    public function fetch(string $sql, array $data = []) : ?array;

}

?>