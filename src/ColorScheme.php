<?php
namespace OP;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;

/**
 * describes a color in the backend
 */
class ColorScheme extends DataObject {

	private static $table_name = 'ColorScheme';
	private static $summary_fields = [
		'ID' => 'ID',
		'OPColor' => 'OP Color',
		'CSSColor' => 'CSS Color',
		'CSSRGB' => 'CSS RGB Value',
		'CSSHex' => 'CSS Hex Value',
		'CSSCMYK' => 'CSS CMYK Value'
	];
	private static $singular_name = 'Color Item';
	private static $plural_name = 'Color Items';
	private static $db = [
		'OPColor' => 'Text',
		'CSSColor' => 'Text',
		'CSSRGB' => 'Text',
		'CSSHex' => 'Text',
		'CSSCMYK' => 'Text'
	];

	/**
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->push(TextField::create('OPColor', 'Color title'));
		$fields->push(TextField::create('CSSColor', 'CSS name'));

		return $fields;
	}

}
