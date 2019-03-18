<?php
/**
 * @package     capi\capi\Capi
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Capi;

use Monolog;
use JComponentHelper;
use JFactory;

class CapiSettings
{
	/**
	 *
	 * @return array
	 *
	 * @since 2.0
	 */
	public function getSettings() {

		$settingsObject = $this->defineSettings();

		$settings = [
			'settings' => [
				'determineRouteBeforeAppMiddleware' => true,
				'displayErrorDetails' => $settingsObject->displayErrorDetails,

				'logger' => [
					'name' => $settingsObject->name,
					'level' => $settingsObject->level,
					'path' => $settingsObject->path,
				],
				'runtime' => [
					'capi_base_path' => $settingsObject->capi_base_path,
					'userid' => '',
					'username' => '',
					'token' => '',
					'mode' => $settingsObject->mode,
					'rate.limit' => $settingsObject->rate_limit
				],
			],
		];
		return $settings;
	}

	/**
	 * Define Settings
	 * @return mixed
	 *
	 * @since 2.0
	 */
	private function defineSettings(){
		/**
		 * Instiate stdClass
		 */
		$settings = new \stdClass();

		/**
		 * displayErrorDetails
		 */
		$settings->displayErrorDetails = true;

		/**
		 * name
		 */
		$settings->name = 'slim-app';

		/**
		 * level
		 */
		$settings->level = Monolog\Logger::DEBUG;

		/**
		 * path
		 */
		$settings->path = __DIR__ . '/../logs/app.log';

		/**
		 * capi_base_path
		 * 
		 * Conditional check ensures that '/capi/v2' default base path is always configured by default, unless overriden.
		 */
		if(JComponentHelper::getParams('com_services')->get('capi_base_path')){
			$settings->capi_base_path = JComponentHelper::getParams('com_services')->get('capi_base_path');
		}else{
			$settings->capi_base_path = '/capi/v2';
		}

		/**
		 * mode
		 */
		$settings->mode = JComponentHelper::getParams('com_services')->get('mode');

		/**
		 * rate_limit
		 */
		$settings->rate_limit = JComponentHelper::getParams('com_services')->get('api_rate_limit');
		return $settings;
	}

	/**
	 *
	 * @return mixed
	 *
	 * @since 2.0
	 */
	public static function getXtime(){
		return microtime(true);
	}
}