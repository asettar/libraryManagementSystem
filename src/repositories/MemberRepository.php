<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\factories\MemberFactory;
use src\models\Member;

class MemberRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findById(int $id) : ?Member {
        $row = $this->database->fetch("SELECT * FROM members WHERE id = :id", ["id" => $id]);
        if (!$row) return NULL;
        return MemberFactory::createFromArray($row);
    }

    public function update(Member $member) : void {
        $data = $member->getChangeableData();
		$feilds = [];
		foreach($data as $key => $value) {
			if (is_string($value)) $value = "'$value'";
			$feilds[] = $key . "=" . $value;
		}
		$sql = "UPDATE members SET " . implode(', ', $feilds) . " WHERE id = {$member->getId()}";
		$this->database->query($sql); 
    }
}
?>