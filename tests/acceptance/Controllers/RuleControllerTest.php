<?php
/**
 * RuleControllerTest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms of the
 * Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */
use FireflyIII\Models\Rule;
use FireflyIII\Repositories\Rule\RuleRepositoryInterface;


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-12-10 at 05:51:43.
 */
class RuleControllerTest extends TestCase
{


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::create
     */
    public function testCreate()
    {
        $this->be($this->user());
        $this->call('get', route('rules.create', [1]));
        $this->assertResponseStatus(200);
        $this->see('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::delete
     */
    public function testDelete()
    {
        $this->be($this->user());
        $this->call('get', route('rules.delete', [1]));
        $this->assertResponseStatus(200);
        $this->see('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::destroy
     */
    public function testDestroy()
    {
        $repository = $this->mock(RuleRepositoryInterface::class);
        $repository->shouldReceive('destroy');

        $this->session(['rules.delete.url' => 'http://localhost']);
        $this->be($this->user());
        $this->call('post', route('rules.destroy', [1]));
        $this->assertResponseStatus(302);
        $this->assertSessionHas('success');
        $this->assertRedirectedToRoute('index');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::down
     */
    public function testDown()
    {
        $this->be($this->user());
        $this->call('get', route('rules.down', [1]));
        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('rules.index');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::edit
     */
    public function testEdit()
    {
        $this->be($this->user());
        $this->call('get', route('rules.edit', [1]));
        $this->assertResponseStatus(200);
        $this->see('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::index
     */
    public function testIndex()
    {
        $this->be($this->user());
        $this->call('get', route('rules.index'));
        $this->assertResponseStatus(200);
        $this->see('<ol class="breadcrumb">');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::reorderRuleActions
     */
    public function testReorderRuleActions()
    {
        $data = [
            'triggers' => [1, 2, 3],
        ];

        $repository = $this->mock(RuleRepositoryInterface::class);
        $repository->shouldReceive('reorderRuleActions');

        $this->be($this->user());
        $this->call('post', route('rules.reorder-actions', [1]), $data);
        $this->assertResponseStatus(200);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::reorderRuleTriggers
     */
    public function testReorderRuleTriggers()
    {
        $data = [
            'triggers' => [1, 2, 3],
        ];

        $repository = $this->mock(RuleRepositoryInterface::class);
        $repository->shouldReceive('reorderRuleTriggers');

        $this->be($this->user());
        $this->call('post', route('rules.reorder-triggers', [1]), $data);
        $this->assertResponseStatus(200);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::store
     */
    public function testStore()
    {
        $this->session(['rules.create.url' => 'http://localhost']);
        $data = [
            'rule_group_id'      => 1,
            'active'             => 1,
            'title'              => 'A',
            'trigger'            => 'store-journal',
            'description'        => 'D',
            'rule-trigger'       => [
                1 => 'from_account_starts',
            ],
            'rule-trigger-value' => [
                1 => 'B',
            ],
            'rule-action'        => [
                1 => 'set_category',
            ],
            'rule-action-value'  => [
                1 => 'C',
            ],
        ];

        $repository = $this->mock(RuleRepositoryInterface::class);
        $repository->shouldReceive('store')->andReturn(new Rule);

        $this->be($this->user());
        $this->call('post', route('rules.store', [1]), $data);
        $this->assertResponseStatus(302);
        $this->assertSessionHas('success');
    }

    /**
     * This actually hits an error and not the actually code but OK.
     *
     * @covers \FireflyIII\Http\Controllers\RuleController::testTriggers
     */
    public function testTestTriggers()
    {
        $this->be($this->user());
        $this->call('get', route('rules.test-triggers', [1]));
        $this->assertResponseStatus(200);
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::up
     */
    public function testUp()
    {
        $this->be($this->user());
        $this->call('get', route('rules.up', [1]));
        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('rules.index');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\RuleController::update
     */
    public function testUpdate()
    {
        $data = [
            'rule_group_id'      => 1,
            'title'              => 'Your first default rule',
            'trigger'            => 'store-journal',
            'active'             => 1,
            'description'        => 'This rule is an example. You can safely delete it.',
            'rule-trigger'       => [
                1 => 'description_is',
            ],
            'rule-trigger-value' => [
                1 => 'something',
            ],
            'rule-action'        => [
                1 => 'prepend_description',
            ],
            'rule-action-value'  => [
                1 => 'Bla bla',
            ],
        ];
        $this->session(['rules.edit.url' => 'http://localhost']);

        $repository = $this->mock(RuleRepositoryInterface::class);
        $repository->shouldReceive('update');

        $this->be($this->user());
        $this->call('post', route('rules.update', [1]), $data);
        $this->assertResponseStatus(302);
        $this->assertSessionHas('success');
    }
}
