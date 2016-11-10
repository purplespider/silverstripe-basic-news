<?php
class CustomLumberjack extends Lumberjack {

  /**
	 * This is responsible for adding the child pages tab and gridfield.
   * CUSTOM: Customised to make the GridField tab first.
	 *
	 * @param FieldList $fields
	 */
	public function updateCMSFields(FieldList $fields) {
		$excluded = $this->owner->getExcludedSiteTreeClassNames();
		if(!empty($excluded)) {
			$pages = $this->getLumberjackPagesForGridfield($excluded);
			$gridField = new GridField(
				"ChildPages",
				$this->getLumberjackTitle(),
				$pages,
				$this->getLumberjackGridFieldConfig()
			);

			$tab = new Tab('ChildPages', $this->getLumberjackTitle(), $gridField);
			// $fields->insertAfter($tab, 'Main');
			$fields->insertBefore($tab, 'Main'); // Only modified line
		}
	}
  
}