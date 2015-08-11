<?php

namespace SilverStripe\Forms;

use Requirements;
use TextField;

class SegmentField extends TextField {
	/**
	 * @var array
	 */
	private static $allowed_actions = array(
		'suggest',
	);

	/**
	 * @var string
	 */
	protected $template = 'forms/segment-field';

	/**
	 * @var array
	 */
	protected $modifiers = array();

	/**
	 * @var string
	 */
	protected $preview = '';

	/**
	 * @param array $modifiers
	 *
	 * @return $this
	 */
	public function setModifiers(array $modifiers) {
		$this->modifiers = $modifiers;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getModifiers() {
		return $this->modifiers;
	}

	/**
	 * @param string $preview
	 *
	 * @return $this
	 */
	public function setPreview($preview) {
		$this->preview = $preview;

		return $this;
	}

	/**
	 * @return string
	 */
	public function Preview() {
		return $this->preview;
	}

	/**
	 * @inheritdoc
	 *
	 * @param array $properties
	 *
	 * @return string
	 */
	public function Field($properties = array()) {
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(SEGMENT_FIELD_DIR . '/public/segment-field.dist.js');
		Requirements::css(SEGMENT_FIELD_DIR . '/public/segment-field.css');

		return parent::Field($properties);
	}

	/**
	 * @inheritdoc
	 *
	 * @param mixed $request
	 *
	 * @return string
	 */
	public function suggest($request) {
		$form = $this->getForm();

		$preview = $suggestion = '';

		foreach($this->modifiers as $modifier) {
			if($modifier instanceof SegmentFieldModifier) {
				$this->setModifierProperties($modifier, $form, $request);

				$preview = $modifier->getPreview($preview);
				$suggestion = $modifier->getSuggestion($suggestion);
			}

			if(is_array($modifier)) {
				$preview .= $modifier[0];
				$suggestion .= $modifier[1];
			}
		}

		return json_encode(array(
			'suggestion' => $suggestion,
			'preview' => $preview,
		));
	}

	/**
	 * @param SegmentFieldModifier $modifier
	 * @param mixed $form
	 * @param mixed $request
	 *
	 * @return $this
	 */
	protected function setModifierProperties(SegmentFieldModifier $modifier, $form, $request) {
		$modifier->setField($this);

		if($request) {
			$modifier->setRequest($request);
		}

		if($form) {
			$modifier->setForm($form);
		}

		return $this;
	}
}
