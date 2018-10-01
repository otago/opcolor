<?php

/**
 * builds a fancy dropdown for users to select a predefined color
 */
namespace OP;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\ArrayList;
use Exception;
use SilverStripe\ORM\Map;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\DataObject;

class ColorField extends DropdownField {

	public function __construct($name, $title = null, $value = '', $form = null, $emptyString = null) {
		
		$this->addExtraClass('dropdown');
		$source = ColorScheme::get()->sort('ID')->map('CSSColor', 'OPColor');
		parent::__construct($name, $title, $source, $value, $form, $emptyString);
        $this->toggleStar();
        
		Requirements::css('otago/opcolor: css/ColorField.css');
		Requirements::javascript('otago/opcolor: javascript/ColorField.js');
		
		$this->hasEmptyDefault = true;
		$this->addExtraClass('opcolor');
	}
    
    /**
	 * Sets the default color
	 */
	public function toggleStar(){
		if ($this->value != "") {
			foreach ($this->getSource() as $key => $value) {
				if($key === $this->value) {
					$this->CurrentTitle = ($value instanceof Object) ? $value->OPColor : $value;
				}
			}
		}
	}

	/*
	 * Sets the source
	 * @param $source SS_Map
	 */
	public function setSource($source) {
		parent::setSource($source);
		if(!($source instanceof Map)) {
			throw new Exception('source not map');
		}
		$this-> toggleStar();
		return $this;
	}

	/**
	 * Allows for custom colors to be added to source
	 * eg:	$s = OpColorField::create('ClassOverride', 'Color Override', $this->ClassOverride);
	 *      $dobj = ArrayData::create(array(
 	 *			'OPColor' => 'Black',
 	 *			'CSSColor' =>'black',
 	 *			'CSSRGB' => '0 0 0',
 	 *			'CSSHex' => '#000',
 	 *			'CSSCMYK' => '0 0 0 1'
	 *		));
	 * 		$s->ammendSource($dobj->CSSColor,$dobj);
	 * Note: custom colors have to be added to site css file for now.
	 * @param $key CSS Name $value an array of values to decorate the field
	 */
	public function ammendSource($key, $value) {
		$sources = $this->getSource();
		$sources->push($key, $value);
		$this->setSource($sources);
	}

    
	/**
	 * Creates a rendered Programme Crawler Field using the .ss template
	 * @param type $properties an array of values to decorate the field
	 * @return type a rendered template
	 */
	function Field($properties = array()) {
		$obj = ($properties) ? $this->customise($properties) : $this;
		$obj->Options = ArrayList::create();

		$dobj = DataObject::create(array(
			'MyTitle' => 'No Color',
			'Value' =>'',
			'CSSRGB' => '255 255 255',
			'CSSHex' => '#ffffff',
			'CSSCMYK' => '0 0 0 0'
		));
		$obj->Options->push($dobj);

		//go through source, if object it is a custom color, if not, get data from ColorScheme
		foreach ($this->getSource() as $value) {
			$mobj = DataObject::create();
			if($value instanceof Object){
				$mobj->MyTitle = $value->OPColor;
				$mobj->Value = $value->CSSColor;
				$mobj->CSSRGB = $value->CSSRGB;
				$mobj->CSSHex = $value->CSSHex;
				$mobj->CSSCMYK = $value->CSSCMYK;
			} else {
				$cs = ColorScheme::get()->filter('OPColor', $value)->first();
				if (!empty($cs)) {
					$mobj->MyTitle = $cs->OPColor;
					$mobj->Value = $cs->CSSColor;
					$mobj->CSSRGB = $cs->CSSRGB;
					$mobj->CSSHex = $cs->CSSHex;
					$mobj->CSSCMYK = $cs->CSSCMYK;
				}
			}
			$obj->Options->push($mobj);
		}
        
		
		// directly point to the template file
		$tmp = $obj->renderWith(["ColorField"]);
		return $tmp;
	}

}
