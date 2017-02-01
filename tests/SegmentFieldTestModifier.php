<?php

namespace SilverStripe\Forms\Tests;

use SilverStripe\Forms\SegmentFieldModifier\AbstractSegmentFieldModifier;

class SegmentFieldTestModifier extends AbstractSegmentFieldModifier
{
    /**
     * @inheritdoc
     *
     * @param string $value
     *
     * @return string
     */
    public function getSuggestion($value)
    {
        return strtoupper($value);
    }

    /**
     * @inheritdoc
     *
     * @param string $value
     *
     * @return string
     */
    public function getPreview($value)
    {
        return strtolower($value);
    }
}
