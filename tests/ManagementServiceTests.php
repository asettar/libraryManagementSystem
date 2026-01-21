<?php 

require_once __DIR__ . '/../vendor/autoload.php';
use src\models\Book;
use src\repositories\{MemberRepository, MySqlConnection};
use src\services\ManagementService;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\Report\PHP;

class ManagementServiceTests extends TestCase {
    private mySqlConnection $db;
    private MemberRepository $memberRepo;
    private ManagementService $managementSerivce;

    public function setUp() : void  {
        $this->db = mySqlConnection::getInstance();
        $this->memberRepo = new MemberRepository($this->db);
        $this->managementSerivce = new ManagementService($this->memberRepo);
        $this->db->beginTransaction();
    }

    public function tearDown(): void {
        $this->db->rollBack();
    }

    public function testRenewMembership() {
        $member = $this->memberRepo->findById(2);
        $membershipEndDate = $member->getMembershipEndDate();
        $this->managementSerivce->renewMembership(2);
        $newMembershipEndDate = $this->memberRepo->findById(2)->getMembershipEndDate();

        $this->assertNotEquals($membershipEndDate, $newMembershipEndDate);
    }
    
}


?>