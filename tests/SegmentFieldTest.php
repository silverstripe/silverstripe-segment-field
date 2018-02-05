<?php

namespace SilverStripe\Forms\Tests;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\SegmentField;
use SilverStripe\Forms\SegmentFieldModifier\AbstractSegmentFieldModifier;

class SegmentFieldTest extends SapphireTest
{
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
        return new HTTPRequest('GET', '/');
    }

    /**
     * @return Form
     */
    protected function getNewFormMock()
    {
        return $this->getMockBuilder(Form::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();
    }
}
