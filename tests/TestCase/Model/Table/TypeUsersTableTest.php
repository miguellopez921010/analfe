<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeUsersTable Test Case
 */
class TypeUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeUsersTable
     */
    public $TypeUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.type_users',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TypeUsers') ? [] : ['className' => 'App\Model\Table\TypeUsersTable'];
        $this->TypeUsers = TableRegistry::get('TypeUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeUsers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
