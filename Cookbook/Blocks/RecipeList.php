<?php
namespace Tutorial\Cookbook\Blocks;

/**
 * @name \Tutorial\Cookbook\Blocks\RecipeList
 */
class RecipeList extends \Change\Presentation\Blocks\Standard\Block
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
		$parameters->addParameterMeta('itemsPerPage', 10);
		$parameters->addParameterMeta('pageNumber', 1);
		$parameters->addParameterMeta('recipeListBlockTitle', null);

		$request = $event->getHttpRequest();
		$parameters->setParameterValue('pageNumber', intval($request->getQuery('pageNumber-' . $event->getBlockLayout()->getId(), 1)));
		$parameters->setLayoutParameters($event->getBlockLayout());

		return $parameters;
	}


	/**
	 * Set $attributes and return a twig template file name OR set HtmlCallback on result
	 * @param \Change\Presentation\Blocks\Event $event
	 * @param \ArrayObject $attributes
	 * @return string|null
	 */
	protected function execute($event, $attributes)
	{
		$query = $event->getApplicationServices()->getDocumentManager()->getNewQuery('Tutorial_Cookbook_Recipe');
		$query->andPredicates($query->published());
		$query->addOrder('title');

		$totalCount = $query->getCountDocuments();
		if (!$totalCount)
		{
			return null;
		}

		$parameters = $event->getBlockParameters();
		$attributes['blockTitle'] = $parameters->getParameter('recipeListBlockTitle');
		$itemsPerPage = $parameters->getParameter('itemsPerPage');
		$pageCount = ceil($totalCount / $itemsPerPage);
		$pageNumber = $this->fixPageNumber($parameters->getParameter('pageNumber'), $pageCount);

		$attributes['pageNumber'] = $pageNumber;
		$attributes['totalCount'] = $totalCount;
		$attributes['pageCount'] = $pageCount;
		$attributes['items'] = array();

		$urlManager = $event->getUrlManager();

		/* @var $document \Tutorial\Cookbook\Documents\Recipe */
		foreach ($query->getDocuments(($pageNumber-1)*$itemsPerPage, $itemsPerPage) as $document)
		{
			$url = $urlManager->getCanonicalByDocument($document)->toString();
			$item = array('url' => $url, 'doc' => $document);
			$attributes['items'][] = $item;
		}

		return "recipe-list.twig";
	}
}
