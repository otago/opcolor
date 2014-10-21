<?php 

/**
 * will add the applications material to the settings 
 */
class OpColorExtension extends Extension {
	protected $owner = "CMSSettingsController";
		
    public function updateEditForm(&$form) {
		$form->Fields()->fieldByName('Root')->push(
				$tabMain = new Tab('Colour Shemes',
					GridField::create(
						'ColourShemes',
						null, 
						ColourShemes::get()->sort('ID'),
						GridFieldConfig_RecordEditor::create()
					)->setForm($form)
				));
    }
}