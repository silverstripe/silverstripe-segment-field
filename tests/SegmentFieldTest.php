<?php

namespace SilverStripe\Forms\Tests;

use Mockery;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\SegmentField;
use SilverStripe\Forms\SegmentFieldModifier\AbstractSegmentFieldModifier;

/**
 * @cover SegmentField
 * @cover AbstractSegmentFieldModifier
 */
class SegmentFieldTest extends SapphireTest
{
    /**
     * @inheritdoc
     */
    protected function tearDown()
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
     * @return HTTPRequest
     */
    protected function getNewRequestMock()
    {
        return Mockery::mock(HTTPRequest::class);
    }

    /**
     * @return Form
     */
    protected function getNewFormMock()
    {
        return Mockery::mock(Form::class);
    }
}
