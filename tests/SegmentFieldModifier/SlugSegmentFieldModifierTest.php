<?php

namespace SilverStripe\Forms\Tests;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\SegmentFieldModifier\SlugSegmentFieldModifier;

class SlugSegmentFieldModifierTest extends SapphireTest
{
    public function testGetPreview()
    {
        $modifier = new SlugSegmentFieldModifier();

        $modifier->setDefault('default-value');

        $this->assertEquals('default-value', $modifier->getPreview(''));
        $this->assertEquals('default-value', $modifier->getSuggestion(''));

        $modifier->setRequest($this->getNewRequestMock());

        $this->assertEquals('This-is-a-LONG-value', $modifier->getPreview(''));
        $this->assertEquals('This-is-a-LONG-value', $modifier->getSuggestion(''));
    }

    /**
     * @return HTTPRequest
     */
    protected function getNewRequestMock()
    {
        $mock = new HTTPRequest('GET', '/');
        $mock->offsetSet('value', 'This is a LONG value!');

        return $mock;
    }
}
