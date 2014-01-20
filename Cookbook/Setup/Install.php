<?php
namespace Tutorial\Cookbook\Setup;

/**
 * @name \Tutorial\Cookbook\Setup\Install
 */
class Install extends \Change\Plugins\InstallBase
{
	/**
	 * @param \Change\Plugins\Plugin $plugin
	 * @param \Change\Application $application
	 * @param \Change\Configuration\EditableConfiguration $configuration
	 * @throws \RuntimeException
	 */
	public function executeApplication($plugin, $application, $configuration)
	{
		$configuration->addPersistentEntry('Change/Events/BlockManager/Tutorial_Cookbook', '\Tutorial\Cookbook\Events\BlockManager\Listeners');
		$configuration->addPersistentEntry('Change/Events/PageManager/Tutorial_Cookbook', '\Tutorial\Cookbook\Events\PageManager\Listeners');
	}

	/**
	 * @param \Change\Plugins\Plugin $plugin
	 * @param \Change\Services\ApplicationServices $applicationServices
	 * @throws \RuntimeException
	 */
	public function executeServices($plugin, $applicationServices)
	{
		$this->setCollectionRecipeDifficulty($applicationServices);
		$this->setCollectionRecipeCost($applicationServices);
		$this->setCollectionRestTimeUnit($applicationServices);
		$applicationServices->getThemeManager()->installPluginTemplates($plugin);
	}

	protected function setCollectionRecipeDifficulty($applicationServices)
	{
		$cm = $applicationServices->getCollectionManager();
		if ($cm->getCollection('Tutorial_Cookbook_Collection_RecipeDifficulty') === null)
		{
			$tm = $applicationServices->getTransactionManager();
			try
			{
				$tm->begin();
				$i18n = $applicationServices->getI18nManager();

				/* @var $collection \Rbs\Collection\Documents\Collection */
				$collection = $applicationServices->getDocumentManager()
					->getNewDocumentInstanceByModelName('Rbs_Collection_Collection');
				$collection->setLabel('Recipes difficulty level');
				$collection->setCode('Tutorial_Cookbook_Collection_RecipeDifficulty');

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('1');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.difficulty_veryeasy', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.difficulty_easy', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('2');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.difficulty_easy', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.difficulty_easy', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('3');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.difficulty_medium', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.difficulty_medium', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('4');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.difficulty_hard', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.difficulty_hard', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				$collection->save();
				$tm->commit();
			}
			catch (\Exception $e)
			{
				throw $tm->rollBack($e);
			}
		}
	}

	protected function setCollectionRecipeCost($applicationServices)
	{
		$cm = $applicationServices->getCollectionManager();
		if ($cm->getCollection('Tutorial_Cookbook_Collection_RecipeCost') === null)
		{
			$tm = $applicationServices->getTransactionManager();
			try
			{
				$tm->begin();
				$i18n = $applicationServices->getI18nManager();

				/* @var $collection \Rbs\Collection\Documents\Collection */
				$collection = $applicationServices->getDocumentManager()
					->getNewDocumentInstanceByModelName('Rbs_Collection_Collection');
				$collection->setLabel('Recipes cost estimation');
				$collection->setCode('Tutorial_Cookbook_Collection_RecipeCost');

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('1');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.cost_cheap', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.cost_cheap', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('2');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.cost_medium', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.cost_medium', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('3');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.cost_expensive', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.cost_expensive', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				$collection->save();
				$tm->commit();
			}
			catch (\Exception $e)
			{
				throw $tm->rollBack($e);
			}
		}
	}

	protected function setCollectionRestTimeUnit($applicationServices)
	{
		$cm = $applicationServices->getCollectionManager();
		if ($cm->getCollection('Tutorial_Cookbook_Collection_RestTimeUnit') === null)
		{
			$tm = $applicationServices->getTransactionManager();
			try
			{
				$tm->begin();
				$i18n = $applicationServices->getI18nManager();

				/* @var $collection \Rbs\Collection\Documents\Collection */
				$collection = $applicationServices->getDocumentManager()
					->getNewDocumentInstanceByModelName('Rbs_Collection_Collection');
				$collection->setLabel('Recipes rest time units');
				$collection->setCode('Tutorial_Cookbook_Collection_RestTimeUnit');

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('1');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_minutes', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_minutes', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('2');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_hours', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_hours', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				/* @var $item \Rbs\Collection\Documents\Item */
				$item = $applicationServices->getDocumentManager()->getNewDocumentInstanceByModelName('Rbs_Collection_Item');
				$item->setValue('3');
				$item->setLabel($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_days', array('ucf')));
				$item->getCurrentLocalization()->setTitle($i18n->trans('m.tutorial.cookbook.setup.resttimeunit_days', array('ucf')));
				$item->save();
				$collection->getItems()->add($item);

				$collection->save();
				$tm->commit();
			}
			catch (\Exception $e)
			{
				throw $tm->rollBack($e);
			}
		}
	}
}
