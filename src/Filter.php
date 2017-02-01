<?php

namespace SilverStripe\Forms;

interface Filter
{
    /**
     * Filters a value.
     *
     * @param string $value
     *
     * @return string
     */
    public function filter($value);
}
