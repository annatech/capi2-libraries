<?php
/**
 * @package     Capi
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Capi;

use Joomla\CMS\Plugin\PluginHelper;
use JFactory;
use JLoader;
use JPluginHelper;
use Slim\Exception\NotFoundException;
use Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
use \Slim\App;

class CapiView
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	public function render($status=200, $data = NULL) {
		$app = \Slim\Slim::getInstance();

		$status = intval($status);

		$response = $this->all();

		//append error bool
		if (!$this->has('error')) {
			$response['error'] = false;
		}

		//append status code
		$response['status'] = $status;

		//add flash messages
		if(isset($this->data->flash) && is_object($this->data->flash)){
			$flash = $this->data->flash->getMessages();
			if (count($flash)) {
				$response['flash'] = $flash;
			} else {
				unset($response['flash']);
			}
		}

		$app->response()->status($status);
		$app->response()->header('Content-Type', 'application/json');

		$jsonp_callback = $app->request->get('callback', null);

		if($jsonp_callback !== null){
			$app->response()->body($jsonp_callback.'('.json_encode($response).')');
		} else {
			$app->response()->body(json_encode($response));
		}

		$app->stop();
	}

}