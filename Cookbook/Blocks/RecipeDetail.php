<?php
namespace Tutorial\Cookbook\Blocks;

/**
 * @name \Tutorial\Cookbook\Blocks\RecipeDetail
 */
class RecipeDetail extends \Change\Presentation\Blocks\Standard\Block
{
	/**
	 * Event Params 'website', 'document', 'page'
	 * @api
	 * Set Block Parameters on $event
	 * @param \Change\Presentation\Blocks\Event $event
	 * @return \Change\Presentation\Blocks\Parameters
	 */
	protected function parameterize($event)
	{
		$parameters = parent::parameterize($event);
		$parameters->addParameterMeta('docId');

		// Retrieve block parameters set in page editor
		$parameters->setLayoutParameters($event->getBlockLayout());
		// If docId is empty it means, recipe hadn't been specified so it's in $event
		if ($parameters->getParameter('docId') === null)
		{
			$document = $event->getParam('document');
			$parameters->setParameterValue('docId', $document->getId());
		}

		return $parameters;
	}

	/**
	 * Set $attributes and return a twig template file name OR set HtmlCallback on result
	 * @param \Change\Presentation\Blocks\Event $event
	 * @param \ArrayObject $attributes
	 * @throws \RuntimeException
	 * @return string|null
	 */
	protected function execute($event, $attributes)
	{
		$parameters = $event->getBlockParameters();

		if ($docId = $parameters->getParameter('docId'))
		{
			$documentManager = $event->getApplicationServices()->getDocumentManager();
			$document = $documentManager->getDocumentInstance($docId);
			if ($document )
			{
				/* @var $document \Rbs\Event\Documents\BaseEvent */
				$attributes['doc'] = $document;
			}
		}
		return "recipe-detail.twig";
	}
}
