<?php

namespace SilverStripe\Forms\Filter;

use SilverStripe\Forms\Filter;
use SilverStripe\View\Parsers\URLSegmentFilter;

class SlugFilter extends URLSegmentFilter implements Filter
{
    /**
     * @inheritdoc
     *
     * @see URLSegmentFilter::filter
     *
     * @param string $value
     *
     * @return string
     */
    public function filter($value)
    {
        if (!$this->getAllowMultibyte()) {
            $transliterator = $this->getTransliterator();

            if ($transliterator) {
                $value = $transliterator->toASCII($value);
            }
        }

        $replacements = $this->getReplacements();

        if ($this->getAllowMultibyte() && isset($replacements['/[^A-Za-z0-9\-]+/u'])) {
            unset($replacements['/[^A-Za-z0-9\-]+/u']);
        }

        foreach ($replacements as $regex => $replace) {
            $value = preg_replace($regex ?? '', $replace ?? '', $value ?? '');
        }

        if ($this->getAllowMultibyte()) {
            $value = rawurlencode($value ?? '');
        }

        return $value;
    }
}
