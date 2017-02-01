<?php

namespace SilverStripe\Forms\SegmentFieldModifier;

use ReflectionClass;
use SilverStripe\Forms\SegmentField;
use SilverStripe\Forms\SegmentFieldModifier;

abstract class AbstractSegmentFieldModifier implements SegmentFieldModifier
{
    public function __construct()
    {
        // required so that ReflectionInstance::newInstanceArgs doesn't fail
    }

    /**
     * @var mixed
     */
    protected $form;

    /**
     * @var SegmentField
     */
    protected $field;

    /**
     * @var mixed
     */
    protected $request;

    /**
     * @inheritdoc
     *
     * @param mixed $form
     *
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @inheritdoc
     *
     * @param SegmentField $field
     *
     * @return $this
     */
    public function setField(SegmentField $field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return SegmentField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @inheritdoc
     *
     * @param mixed $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return static
     */
    public static function create()
    {
        $reflection = new ReflectionClass(get_called_class());

        if (func_num_args()) {
            return $reflection->newInstanceArgs(func_get_args());
        } else {
            return $reflection->newInstance();
        }
    }
}
