<?php

/**
 * Most Pages have a series of large hero images above the fold.
 * 
 */
class ColourSchemes extends DataObject
{

    public static $summary_fields = array(
        'ID' => 'ID',
        'OPColor' => 'OP Color',
        'CSSColor' => 'CSS Color',
        'CSSRGB' => 'CSS RGB Value',
        'CSSHex' => 'CSS Hex Value',
        'CSSCMYK' => 'CSS CMYK Value'
    );
    public static $singular_name = 'Color Item';
    public static $plural_name = 'Color Items';
    public static $db = array(
        'OPColor' => 'Text',
        'CSSColor' => 'Text',
        'CSSRGB' => 'Text',
        'CSSHex' => 'Text',
        'CSSCMYK' => 'Text'
    );
    public static $has_one = array();
    public static $has_many = array();

    /**
     * 
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->push(new TextField('OPColor', 'OP Color'));
        $fields->push(new TextField('CSSColor', 'CSS Color'));

        return $fields;
    }
}
