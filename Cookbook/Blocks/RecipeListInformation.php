<?php
namespace Tutorial\Cookbook\Blocks;

use Change\Documents\Property;

/**
 * @name \Tutorial\Cookbook\Blocks\RecipeListInformation
 */
class RecipeListInformation extends \Change\Presentation\Blocks\Information
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
		$this->setLabel($i18nManager->trans('m.tutorial.cookbook.admin.recipe_list_label', $ucf));
		$this->setSection($i18nManager->trans('m.tutorial.cookbook.admin.module_name', $ucf));
		$this->addInformationMeta('recipeListBlockTitle', Property::TYPE_STRING, false)
			->setLabel($i18nManager->trans('m.tutorial.cookbook.admin.recipe_list_block_title', $ucf));
		$this->addInformationMeta('itemsPerPage', Property::TYPE_INTEGER, true, 10)
			->setLabel($i18nManager->trans('m.tutorial.cookbook.admin.list_items_per_page', $ucf));
	}
}