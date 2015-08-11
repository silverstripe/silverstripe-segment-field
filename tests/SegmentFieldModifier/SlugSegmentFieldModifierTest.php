<?php

namespace SilverStripe\Forms\Tests;

use Form;
use Mockery;
use SapphireTest;
use SilverStripe\Forms\SegmentFieldModifier\SlugSegmentFieldModifier;

/**
 * @cover SlugSegmentFieldModifier
 */
class SlugSegmentFieldModifierTest extends SapphireTest {
	/**
	 * @inheritdoc
	 */
	public function tearDown() {
		Mockery::close();

		parent::tearDown();
	}

	/**
	 * @test
	 */
	public function testGetPreview() {
		$modifier = new SlugSegmentFieldModifier();

		$modifier->setDefault('default-value');

		$this->assertEquals('default-value', $modifier->getPreview(''));
		$this->assertEquals('default-value', $modifier->getSuggestion(''));

		$modifier->setRequest($this->getNewRequestMock());

		$this->assertEquals('This-is-a-LONG-value', $modifier->getPreview(''));
		$this->assertEquals('This-is-a-LONG-value', $modifier->getSuggestion(''));
	}

	/**
	 * @return Form
	 */
	protected function getNewRequestMock() {
		$mock = Mockery::mock('SS_HTTPRequest');
		$mock->shouldReceive('getVar')->with('value')->andReturn('This is a LONG value!');

		return $mock;
	}
}
