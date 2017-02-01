<?php

namespace SilverStripe\Forms\SegmentFieldModifier;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\Filter\SlugFilter;

class SlugSegmentFieldModifier extends AbstractSegmentFieldModifier
{
    /**
     * @var string
     */
    protected $default = '';

    /**
     * @param string $default
     *
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
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
        return $this->getSuggestion($value);
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
        if ($filtered = SlugFilter::create()->filter($this->getValue())) {
            return $value . $filtered;
        }

        return $value . $this->default;
    }

    /**
     * @return string
     */
    protected function getValue()
    {
        if ($this->request instanceof HTTPRequest && $value = $this->request->getVar('value')) {
            return $value;
        }

        return '';
    }
}
