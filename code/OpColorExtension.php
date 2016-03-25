<?php

/**
 * will add the applications material to the settings 
 */
class OpColorExtension extends Extension
{

    protected $owner = "CMSSettingsController";

    public function updateEditForm(&$form)
    {
        $form->Fields()->fieldByName('Root')->push(
                $tabMain = new Tab('Colour Schemes', GridField::create(
                        'ColourSchemes', null, ColourSchemes::get()->sort('ID'), GridFieldConfig_RecordEditor::create()
                )->setForm($form)
        ));
    }
}
