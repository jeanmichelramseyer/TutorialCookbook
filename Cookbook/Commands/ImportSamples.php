<?php
namespace Tutorial\Cookbook\Commands;

use Change\Commands\Events\Event;

/**
 * @name \Tutorial\Cookbook\Commands\ImportSamples
 */
class ImportSamples
{
	/**
	 * @param Event $event
	 */
	public function execute(Event $event)
	{
		$applicationServices = $event->getApplicationServices();
		$documentManager = $applicationServices->getDocumentManager();
		$response = $event->getCommandResponse();

		$response->addInfoMessage("Importing recipes samples...");
		$resourcePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Samples';

		try {
			$import = new \Rbs\Generic\Json\Import($applicationServices->getDocumentManager());
			$import->setDocumentCodeManager($applicationServices->getDocumentCodeManager());

			$preSave = function($document, $jsonArray) use ($resourcePath, $documentManager, $response) {
				if ($document instanceof \Rbs\Media\Documents\Image) {
					$mediaPath = $resourcePath. DIRECTORY_SEPARATOR . 'media';
					$storageURI = $document->getPath();
					copy($mediaPath . DIRECTORY_SEPARATOR . basename($storageURI), $storageURI);
				}
				elseif ($document instanceof \Tutorial\Cookbook\Documents\Recipe)
				{
					$response->addCommentMessage("\t- ".$jsonArray['label']);
				}
			};
			$import->getOptions()->set('preSave', $preSave);

			$json = json_decode(file_get_contents($resourcePath . DIRECTORY_SEPARATOR . 'recipes.json'), true);
			try
			{
				$applicationServices->getTransactionManager()->begin();
				$import->fromArray($json);
				$applicationServices->getTransactionManager()->commit();
			}
			catch (\Exception $e)
			{
				throw $applicationServices->getTransactionManager()->rollBack($e);
			}
			$response->addInfoMessage('Done.');
		}
		catch (\Exception $e)
		{
			$response->addErrorMessage("Failed :\n".$e->getMessage().
				"\nAnd trace :\n".$e->getTraceAsString());
		}

	}
}