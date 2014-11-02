<?php

class OpColorField extends DropdownField {

	public function __construct($name, $title = null, $value = '', $form = null, $emptyString = null) {
		$this->addExtraClass('dropdown');
		$source = ColourSchemes::get()->sort('ID')->map('CSSColor', 'OPColor');
		parent::__construct($name, $title, $source, $value, $form, $emptyString);

		$this->CurrentTitle = '';
		if ($value != "") {
			$star = ColourSchemes::get()->where(array("\"CSSColor\" = '" . $value . "'"))->first();
			if ($star)
				$this->CurrentTitle = $star->OPColor;
		}

		Requirements::css(OPCOLORWORKINGFOLDER . '/css/OpColorField.css');
		Requirements::javascript(OPCOLORWORKINGFOLDER . '/javascript/OpColorField.js');
	}

	/**
	 * Creates a rendered Programme Crawler Field using the .ss template
	 * @param type $properties an array of values to decorate the field
	 * @return type a rendered template
	 */
	function Field($properties = array()) {
		$obj = ($properties) ? $this->customise($properties) : $this;
		$obj->Options = ArrayList::create();

		$dobj = DataObject::create();
		$dobj->MyTitle = 'No Color';
		$dobj->Value = '';
		$dobj->CSSRGB = '255 255 255';
		$dobj->CSSHex = '#ffffff';
		$dobj->CSSCMYK = '0 0 0 0';
		$obj->Options->push($dobj);

		$source = ColourSchemes::get()->sort('ID');
		if ($source) {
			foreach ($source as $value) {
				$mobj = DataObject::create();
				$mobj->MyTitle = $value->OPColor;
				$mobj->Value = $value->CSSColor;
				$mobj->CSSRGB = $value->CSSRGB;
				$mobj->CSSHex = $value->CSSHex;
				$mobj->CSSCMYK = $value->CSSCMYK;
				$obj->Options->push($mobj);
			}
		}
		// directly point to the template file
		$tmp = $obj->renderWith("../themes/op/templates/Fields/OpColorField.ss");
		return $tmp;
	}

}
