#OPColorField

Creates a colour palette dropdown.

##Colour selector

![OP colour in the CMS](https://raw.githubusercontent.com/otago/opcolor/master/images/image2.png)

Create your accepted colours and names in the settings tab in the CMS

![OP colour in the settings](https://raw.githubusercontent.com/otago/opcolor/master/images/image1.png)

use the drop down to select your colour

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