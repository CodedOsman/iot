<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/models/count.mod.php';
require_once __DIR__ . '/models/users.mod.php';
require_once __DIR__ . '/models/team.mod.php';
require_once __DIR__ . '/models/our_work.mod.php';
require_once __DIR__ . '/models/our_project.mod.php';
require_once __DIR__ . '/models/partners.mod.php';
require_once __DIR__ . '/models/roles.mod.php';
require_once __DIR__ . '/models/privileges.mod.php';

class ModelTester
{
    private $pdo;
    private $passed = 0;
    private $failed = 0;

    public function __construct()
    {
        try {
            $this->pdo = DB::getConnection();
            echo "✓ Database connection successful\n";
        } catch (Exception $e) {
            echo "✗ Database connection failed: " . $e->getMessage() . "\n";
            exit(1);
        }
    }

    public function test($description, $result)
    {
        if ($result) {
            echo "✓ PASS: $description\n";
            $this->passed++;
        } else {
            echo "✗ FAIL: $description\n";
            $this->failed++;
        }
    }

    public function runAllTests()
    {
        echo "\n========== RUNNING MODEL TESTS ==========\n\n";

        $this->testCountModel();
        $this->testUserModel();
        $this->testTeamModel();
        $this->testOurWorkModel();
        $this->testOurProjectModel();
        $this->testPartnersModel();
        $this->testRolesModel();
        $this->testPrivilegesModel();

        $this->printSummary();
    }

    private function testCountModel()
    {
        echo "\n--- Testing Count Model ---\n";
        $count = new Count($this->pdo);

        // Test addCount
        $result = $count->addCount(100, 50, 25, 10);
        $this->test("Count::addCount() inserts record", is_bool($result) && $result);

        // Test getAll
        $all = $count->getAll();
        $this->test("Count::getAll() returns array", is_array($all));
        $this->test("Count::getAll() has records", count($all) > 0);

        // Test find
        if (count($all) > 0) {
            $firstId = $all[0]['id'] ?? null;
            if ($firstId) {
                $record = $count->find($firstId);
                $this->test("Count::find() retrieves record", is_array($record) && $record !== null);
            }
        }
    }

    private function testUserModel()
    {
        echo "\n--- Testing User Model ---\n";
        $user = new User($this->pdo);

        // Test create
        $testUsername = 'testuser_' . uniqid();
        $result = $user->create($testUsername, 'password123', 1);
        $this->test("User::create() inserts user", is_bool($result) && $result);

        // Test findByUsername
        $foundUser = $user->findByUsername($testUsername);
        $this->test("User::findByUsername() finds user", is_array($foundUser) && $foundUser !== null);

        // Test find
        if (is_array($foundUser)) {
            $userId = $foundUser['user_id'] ?? null;
            if ($userId) {
                $record = $user->find($userId);
                $this->test("User::find() retrieves user", is_array($record) && $record !== null);

                // Test updateRole
                $updateResult = $user->updateRole($userId, 2);
                $this->test("User::updateRole() updates role", is_bool($updateResult));

                // Test updatePassword
                $updateResult = $user->updatePassword($userId, 'newpassword123');
                $this->test("User::updatePassword() updates password", is_bool($updateResult));

                // Test delete
                $deleteResult = $user->delete($userId);
                $this->test("User::delete() removes user", is_bool($deleteResult));
            }
        }

        // Test getAll
        $all = $user->getAll();
        $this->test("User::getAll() returns array", is_array($all));
    }

    private function testTeamModel()
    {
        echo "\n--- Testing Team Model ---\n";
        $team = new Team($this->pdo);

        // Test create
        $testName = 'Team Member ' . uniqid();
        $result = $team->create($testName, 'Developer', 'photo.jpg', 'fb.com', 'insta.com', 'twitter.com', 'linkedin.com');
        $this->test("Team::create() inserts team member", is_bool($result) && $result);

        // Test getAll
        $all = $team->getAll();
        $this->test("Team::getAll() returns array", is_array($all));
        $this->test("Team::getAll() has records", count($all) > 0);

        // Test find
        if (count($all) > 0) {
            $firstId = $all[0]['id'] ?? null;
            if ($firstId) {
                $record = $team->find($firstId);
                $this->test("Team::find() retrieves team member", is_array($record) && $record !== null);

                // Test update
                $updateResult = $team->update($firstId, 'Updated Name', 'new_photo.jpg');
                $this->test("Team::update() modifies record", is_bool($updateResult));

                // Test delete
                $deleteResult = $team->delete($firstId);
                $this->test("Team::delete() removes record", is_bool($deleteResult));
            }
        }
    }

    private function testOurWorkModel()
    {
        echo "\n--- Testing OurWork Model ---\n";
        $work = new OurWork($this->pdo);

        // Test create
        $testTitle = 'Project ' . uniqid();
        $result = $work->create($testTitle, 'work_photo.jpg');
        $this->test("OurWork::create() inserts work", is_bool($result) && $result);

        // Test getAll
        $all = $work->getAll();
        $this->test("OurWork::getAll() returns array", is_array($all));
        $this->test("OurWork::getAll() has records", count($all) > 0);

        // Test find
        if (count($all) > 0) {
            $firstId = $all[0]['id'] ?? null;
            if ($firstId) {
                $record = $work->find($firstId);
                $this->test("OurWork::find() retrieves work", is_array($record) && $record !== null);

                // Test update
                $updateResult = $work->update($firstId, 'Updated Title', 'updated_photo.jpg');
                $this->test("OurWork::update() modifies record", is_bool($updateResult));

                // Test delete
                $deleteResult = $work->delete($firstId);
                $this->test("OurWork::delete() removes record", is_bool($deleteResult));
            }
        }
    }

    private function testOurProjectModel()
    {
        echo "\n--- Testing OurProject Model ---\n";
        try {
            $project = new OurProject($this->pdo);
            $this->test("OurProject model instantiates", true);

            // Try basic operations
            $all = $project->getAll();
            $this->test("OurProject::getAll() returns array", is_array($all));
        } catch (Exception $e) {
            $this->test("OurProject model exists", false);
        }
    }

    private function testPartnersModel()
    {
        echo "\n--- Testing Partners Model ---\n";
        try {
            $partner = new Partner($this->pdo);
            $this->test("Partner model instantiates", true);

            // Try basic operations
            $all = $partner->getAll();
            $this->test("Partner::getAll() returns array", is_array($all));
        } catch (Exception $e) {
            $this->test("Partner model exists", false);
        }
    }

    private function testRolesModel()
    {
        echo "\n--- Testing Roles Model ---\n";
        try {
            $role = new Role($this->pdo);
            $this->test("Role model instantiates", true);

            // Try basic operations
            $all = $role->getAll();
            $this->test("Role::getAll() returns array", is_array($all));
        } catch (Exception $e) {
            $this->test("Role model exists", false);
        }
    }

    private function testPrivilegesModel()
    {
        echo "\n--- Testing Privileges Model ---\n";
        try {
            $privilege = new Privilege($this->pdo);
            $this->test("Privilege model instantiates", true);

            // Try basic operations
            $all = $privilege->getAll();
            $this->test("Privilege::getAll() returns array", is_array($all));
        } catch (Exception $e) {
            $this->test("Privilege model exists", false);
        }
    }

    private function printSummary()
    {
        echo "\n========== TEST SUMMARY ==========\n";
        echo "Passed: " . $this->passed . "\n";
        echo "Failed: " . $this->failed . "\n";
        echo "Total:  " . ($this->passed + $this->failed) . "\n";
        echo "==================================\n\n";

        if ($this->failed === 0) {
            echo "✓ All tests passed!\n";
        } else {
            echo "✗ Some tests failed.\n";
        }
    }
}

// Run tests
$tester = new ModelTester();
$tester->runAllTests();
