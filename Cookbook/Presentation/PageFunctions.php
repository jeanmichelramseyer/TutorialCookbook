<?php
namespace Tutorial\Cookbook\Presentation;

/**
* @name \Rbs\Event\Presentation\PageFunctions
*/
class PageFunctions
{
	public function addFunctions(\Change\Events\Event $event)
	{
		$functions = $event->getParam('functions');
		$i18nManager = $event->getApplicationServices()->getI18nManager();
		$ucf = array('ucf');
		$functions[] = ['code' => 'Tutorial_Cookbook_RecipeList', 'document' => true, 'block' => 'Tutorial_Cookoob_RecipeList',
			'label' => $i18nManager->trans('m.tutorial.cookbook.admin.recipe_list_function', $ucf),
			'section' => $i18nManager->trans('m.tutorial.cookbook.admin.module_name', $ucf)];

		$functions[] = ['code' => 'Tutorial_Cookbook_Recipe', 'document' => true, 'block' => 'Tutorial_Cookbook_RecipeDetail',
			'label' => $i18nManager->trans('m.tutorial.cookbook.admin.recipe_detail_function', $ucf),
			'section' => $i18nManager->trans('m.tutorial.cookbook.admin.module_name', $ucf)];

		$event->setParam('functions', $functions);
	}
}