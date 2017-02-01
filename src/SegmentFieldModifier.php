<?php

namespace SilverStripe\Forms;

interface SegmentFieldModifier
{
    /**
     * @param mixed $form
     */
    public function setForm($form);

    /**
     * @return mixed
     */
    public function getForm();

    /**
     * @param SegmentField $field
     */
    public function setField(SegmentField $field);

    /**
     * @return SegmentField
     */
    public function getField();

    /**
     * @param mixed $request
     */
    public function setRequest($request);

    /**
     * @return mixed
     */
    public function getRequest();

    /**
     * Modifies the previous suggestion value.
     *
     * @param string $value
     *
     * @return string
     */
    public function getSuggestion($value);

    /**
     * Modifies the previous preview value.
     *
     * @param string $value
     *
     * @return string
     */
    public function getPreview($value);
}
