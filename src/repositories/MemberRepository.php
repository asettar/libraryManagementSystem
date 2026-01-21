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

    public function findById(int $id) : Member {
        $row = $this->database->fetch("SELECT * FROM members WHERE id = :id", ["id" => $id]);
        if (!$row) throw new \Exception("Member with id : $id not found.");
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
		if (!$this->database->query($sql)) throw new \Exception ("Member update failed."); 
    }
}
?>