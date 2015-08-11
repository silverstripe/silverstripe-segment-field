<?php

namespace SilverStripe\Forms\Tests;

use Form;
use Mockery;
use SapphireTest;
use SilverStripe\Forms\SegmentField;
use SilverStripe\Forms\SegmentFieldModifier\AbstractSegmentFieldModifier;
use SS_HTTPRequest;

/**
 * @cover SegmentField
 * @cover AbstractSegmentFieldModifier
 */
class SegmentFieldTest extends SapphireTest
{
	/**
	 * @inheritdoc
	 */
	public function tearDown()
	{
		Mockery::close();

		parent::tearDown();
	}

	/**
	 * @test
	 */
	public function testSuggest()
	{
		$field = new SegmentField('Example');

		$field->setModifiers(array(
			array('array-preview', 'array-suggestion'),
			SegmentFieldTestModifier::create(),
		));

		$encoded = $field->suggest($this->getNewRequestMock());
		$decoded = json_decode($encoded);

		$this->assertEquals('ARRAY-SUGGESTION', $decoded->suggestion);
		$this->assertEquals('array-preview', $decoded->preview);
	}

	/**
	 * @test
	 */
	public function testGettersAndSetters()
	{
		$field = new SegmentField('Example');

		$modifier = SegmentFieldTestModifier::create();

		$field->setModifiers(array(
			$modifier,
		));

		$form = $this->getNewFormMock();
		$request = $this->getNewRequestMock();

		$field->setForm($form)->suggest($request);

		$modifiers = $field->getModifiers();

		$this->assertSame($modifier, $modifiers[0]);
		$this->assertSame($form, $modifiers[0]->getForm());
		$this->assertSame($field, $modifiers[0]->getField());
		$this->assertSame($request, $modifiers[0]->getRequest());
	}

	/**
	 * @return SS_HTTPRequest
	 */
	protected function getNewRequestMock() {
		return Mockery::mock('SS_HTTPRequest');
	}

	/**
	 * @return Form
	 */
	protected function getNewFormMock() {
		return Mockery::mock('Form');
	}
}

class SegmentFieldTestModifier extends AbstractSegmentFieldModifier
{
	/**
	 * @inheritdoc
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public function getSuggestion($value) {
		return strtoupper($value);
	}

	/**
	 * @inheritdoc
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public function getPreview($value) {
		return strtolower($value);
	}
}