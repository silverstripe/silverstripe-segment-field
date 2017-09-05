# SilverStripe Segment Field

[![Build Status](http://img.shields.io/travis/silverstripe/silverstripe-segment-field.svg)](https://travis-ci.org/silverstripe/silverstripe-segment-field)
[![Code Quality](http://img.shields.io/scrutinizer/g/silverstripe/silverstripe-segment-field.svg)](https://scrutinizer-ci.com/g/silverstripe/silverstripe-segment-field)
[![Codecov](https://img.shields.io/codecov/c/github/silverstripe/silverstripe-segment-field.svg)](https://codecov.io/github/silverstripe/silverstripe-segment-field/)
[![Version](http://img.shields.io/packagist/v/silverstripe/segment-field.svg)](https://packagist.org/packages/silverstripe/segment-field)
[![License](http://img.shields.io/packagist/l/silverstripe/segment-field.svg)](license.md)

A reusable approach to segment-generating fields.

## Usage

```php
use SilverStripe\Forms\SegmentField;
use SilverStripe\Forms\SegmentFieldModifier\SlugSegmentFieldModifier;
use SilverStripe\Forms\SegmentFieldModifier\IDSegmentFieldModifier;

SegmentField::create('PageName')->setModifiers(array(
    SlugSegmentFieldModifier::create()->setDefault('page'),
    array('-', ''),
    IDSegmentFieldModifier::create(),
))->setPreview($this->PageDisplayName)
```

1. Starting with a value of `"My New Page!"`.
2. The value is passed through `SlugSegmentFieldModifier`.
3. Preview value becomes `"My-New-Page"`, Input value becomes `"My-New-Page"`.
4. The value is passed through `array('-', '')`.
5. Preview value becomes `"My-New-Page-"`, Input value becomes `"My-New-Page"`.
6. The value is passed through `IDSegmentFieldModifier`.
7. Preview value becomes `"My-New-Page-1"` (with the DataObject ID), Input value becomes `"My-New-Page"`.

You can pass any similarly structured array or implementation of `SilverStripe\Forms\SegmentFieldModifier` in the modifiers list.

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

## Thanks

I'd like to thank [SilverStripe](http://www.silverstripe.com) for letting me work on fun projects like this. Feel free to talk to me about using the [framework and CMS](http://www.silverstripe.org) or [working at SilverStripe](http://www.silverstripe.com/who-we-are/#careers).
