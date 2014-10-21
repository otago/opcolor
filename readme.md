#OPColorField

Creates a colour palette dropdown.

##images

![OP color in the settings](https://raw.github.com/otago/opcolor/blob/master/image1.png)

Create your accepted colors and names in the settings tab in the CMS

![OP color in the CMS](https://raw.github.com/otago/opcolor/blob/master/image2.png)

use the drop down to select your color

##usage

```
	function getCMSFields() {
		$fields = parent::getCMSFields();
		// create the op color field
        $colordropdown = OpColorField::create('ClassOverride', 'Color Override', $this->ClassOverride);
        $colordropdown->setEmptyString('');
        $fields->addFieldToTab("Root.Main", $colordropdown, "Content");
        
		return $fields;
	}
```