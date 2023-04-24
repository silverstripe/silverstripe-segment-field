# Silverstripe Segment Field

[![CI](https://github.com/silverstripe/silverstripe-segment-field/actions/workflows/ci.yml/badge.svg)](https://github.com/silverstripe/silverstripe-segment-field/actions/workflows/ci.yml)
[![Silverstripe supported module](https://img.shields.io/badge/silverstripe-supported-0071C4.svg)](https://www.silverstripe.org/software/addons/silverstripe-commercially-supported-module-list/)

A reusable approach to segment-generating fields.

## Installation

```sh
composer require silverstripe/segment-field
```

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

## Using on the frontend

This field is primarily designed for use within the Silverstripe CMS. If you want to use it on the frontend, please
ensure that you have included your own version of jQuery and the jQuery entwine library that ships with the
silverstripe/admin module, for example:

```php
Requirements::javascript('//code.jquery.com/jquery-3.3.1.min.js');
Requirements::javascript('silverstripe/admin:thirdparty/jquery-entwine/dist/jquery.entwine-dist.js');
```

These dependencies are included by default when using this field within the CMS.

## Versioning

This library follows [Semver](http://semver.org). According to Semver, you will be able to upgrade to any minor or patch version of this library without any breaking changes to the public API. Semver also requires that we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All other methods are not part of the public API. Where possible, we'll try to keep `protected` methods backwards-compatible in minor/patch versions, but if you're overriding methods then please test your work before upgrading.

## Thanks

I'd like to thank [SilverStripe](http://www.silverstripe.com) for letting me work on fun projects like this. Feel free to talk to me about using the [framework and CMS](http://www.silverstripe.org) or [working at SilverStripe](http://www.silverstripe.com/who-we-are/#careers).
