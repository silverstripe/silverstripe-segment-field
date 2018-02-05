<?php

namespace SilverStripe\Forms\Tests;

use stdClass;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\SegmentFieldModifier\IDSegmentFieldModifier;

class IDSegmentFieldModifierTest extends SapphireTest
{
    public function testGetPreview()
    {
        $modifier = new IDSegmentFieldModifier();

        $this->assertEquals('', $modifier->getPreview(''));

        $modifier->setForm($this->getNewFormMock());

        $this->assertEquals('123', $modifier->getPreview(''));
        $this->assertEquals('', $modifier->getSuggestion(''));
    }

    /**
     * @return Form
     */
    protected function getNewFormMock()
    {
        $mock = $this->getMockBuilder(Form::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRecord'])
            ->getMock();

        $record = new stdClass();
        $record->ID = 123;

        $mock->method('getRecord')->willReturn($record);

        return $mock;
    }
}
