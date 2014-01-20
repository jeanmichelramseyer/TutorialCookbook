<?php
namespace Tutorial\Cookbook\Blocks;

use Change\Documents\Property;

/**
 * @name \Tutorial\Cookbook\Blocks\RecipeDetailInformation
 */
class RecipeDetailInformation extends \Change\Presentation\Blocks\Information
{
	/**
	 * @param string $name
	 * @param BlockManager $blockManager
	 */
	public function onInformation(\Change\Events\Event $event)
	{
		parent::onInformation($event);
		$i18nManager = $event->getApplicationServices()->getI18nManager();
		$ucf = array('ucf');
		$this->setLabel($i18nManager->trans('m.tutorial.cookbook.admin.recipe_detail_label', $ucf));
		$this->setSection($i18nManager->trans('m.tutorial.cookbook.admin.module_name', $ucf));
		$this->addInformationMeta('docId', Property::TYPE_DOCUMENTID, false, null);
		$this->getParameterInformation('docId')->setAllowedModelsNames('Tutorial_Cookbook_Recipe')
			->setLabel($i18nManager->trans('m.tutorial.cookbook.admin.recipe_doc', $ucf));
	}
}