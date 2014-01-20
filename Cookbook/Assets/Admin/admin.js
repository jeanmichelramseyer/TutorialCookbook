(function () {
	"use strict";

	var app = angular.module('RbsChange');

	// Register default editors:
	// Do not declare an editor here if you have an 'editor.js' for your Model.
	__change.createEditorsForLocalizedModel('Tutorial_Cookbook_Recipe');

	/**
	 * Routes and URL definitions.
	 */
	app.config(['$provide', function ($provide)
	{
		$provide.decorator('RbsChange.UrlManager', ['$delegate', function ($delegate)
		{
			$delegate.model('Tutorial_Cookbook').route('home', 'Tutorial/Cookbook', { 'redirectTo': 'Tutorial/Cookbook/Recipe/'});
			$delegate.routesForLocalizedModels(['Tutorial_Cookbook_Recipe']);
			return $delegate;
		}]);
	}]);
})();