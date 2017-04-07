<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCursosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCursosTable Test Case
 */
class UsersCursosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCursosTable
     */
    public $UsersCursos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_cursos',
        'app.users',
        'app.type_users',
        'app.cursos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersCursos') ? [] : ['className' => 'App\Model\Table\UsersCursosTable'];
        $this->UsersCursos = TableRegistry::get('UsersCursos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersCursos);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
