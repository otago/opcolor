<?php

namespace OP;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * will add the color palette to the settings
 */
class SiteConfigLeftAndMainExtension extends Extension {

	protected $owner = "SiteConfigLeftAndMain";

	public function updateEditForm(&$form) {
		$form->Fields()->fieldByName('Root')->push(
				$tabMain = new Tab('Color Schemes', GridField::create(
						'ColorSchemes', null, ColorSchemes::get()->sort('ID'), GridFieldConfig_RecordEditor::create()
				)->setForm($form)
		));
	}

}
