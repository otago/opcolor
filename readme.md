# OPColorField

Creates a colour palette dropdown.

## Color selector

![OP color in the CMS](https://raw.githubusercontent.com/otago/opcolor/master/images/image2.png)

Create your accepted colors and names in the settings tab in the CMS

![OP color in the settings](https://raw.githubusercontent.com/otago/opcolor/master/images/image1.png)

use the drop down to select your color

# Expose the JS/css files
```composer vendor-expose```

## Usage

```
	use OP\ColorField;
	public static $db = [
		'ClassOverride' => 'Text'
	];

	function getCMSFields() {
		$fields = parent::getCMSFields();
		// create the op color field
        $colordropdown = ColorField::create('ClassOverride', 'Color Override', $this->ClassOverride);
        $colordropdown->setEmptyString('');
        $fields->addFieldToTab("Root.Main", $colordropdown, "Content");
        
		return $fields;
	}
```

## What it does

It stores the CSSColor in the specified text field. Note the RGB color is the 
value that colors the box in the dropdown field. Other values, such as the 
CSSHex and CSSCMYK are optional. 