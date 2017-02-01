<?php

namespace SilverStripe\Forms\SegmentFieldModifier;

use SilverStripe\Forms\Form;

class IDSegmentFieldModifier extends AbstractSegmentFieldModifier
{
    /**
     * @inheritdoc
     *
     * @param string $value
     *
     * @return string
     */
    public function getPreview($value)
    {
        if ($this->form instanceof Form && $record = $this->form->getRecord()) {
            return $value . $record->ID;
        }

        return $value;
    }

    /**
     * @inheritdoc
     *
     * @param string $value
     *
     * @return string
     */
    public function getSuggestion($value)
    {
        return $value;
    }
}
