<?php

namespace SilverStripe\Forms\Tests;

use Mockery;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\SegmentFieldModifier\SlugSegmentFieldModifier;

/**
 * @cover SlugSegmentFieldModifier
 */
class SlugSegmentFieldModifierTest extends SapphireTest
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
     * @return Form
     */
    protected function getNewRequestMock()
    {
        $mock = Mockery::mock(HTTPRequest::class);
        $mock->shouldReceive('getVar')->with('value')->andReturn('This is a LONG value!');

        return $mock;
    }
}
