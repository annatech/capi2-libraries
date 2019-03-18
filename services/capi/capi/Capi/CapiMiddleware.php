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
use Slim\Http\Response as Response;

class CapiMiddleware
{
	/**
	 * CapiMiddleware middleware invokable class
	 *
	 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
	 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
	 * @param  callable                                 $next     Next middleware
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	function __invoke(Request $request,  Response $response, callable $next)
	{

		//$response->getBody()->write('BEFORE');
		//$response = $next($request, $response);
		//$response->getBody()->write('AFTER');

		return $next($request, $response);
	}

	function middleware(Request $request,  Response $response, callable $next)
	{
		// $application = JFactory::getApplication('site');
		// $app = $application->get('capi_app');
		


		// // Generic error handler
		// $app->errorHandler(function (Exception $e) use ($app) {
		// 	$app->render($e->getCode(),array(
		// 		'error' => true,
		// 		'msg'   => $this->_errorType($e->getCode()) .": ". $e->getMessage(),
		// 	));
		// });

		// // Not found handler (invalid routes, invalid method types)
		// $app->notFound(function() use ($app) {
		// 	$app->render(404,array(
		// 		'error' => TRUE,
		// 		'msg'   => 'Invalid route',
		// 	));
		// });

		// // Handle Empty response body
		// $app->hook('slim.after.router', function () use ($app) {
		// 	//Fix sugested by: https://github.com/bdpsoft
		// 	//Will allow download request to flow
		// 	if($app->response()->header('Content-Type')==='application/octet-stream'){
		// 		return;
		// 	}
		//
		//	if (strlen($app->response()->body()) == 0) {
		//		$app->render(500,array(
		//			'error' => TRUE,
		//			'msg'   => 'Empty response',
		//		));
		//	}
		// });
		
	}

	/**
	 * @param int $type
	 *
	 * @return string
	 * @since 1.0
	 */
	public static function _errorType($type=1){
		switch($type)
		{
			default:
			case E_ERROR: // 1 //
				return 'ERROR';
			case E_WARNING: // 2 //
				return 'WARNING';
			case E_PARSE: // 4 //
				return 'PARSE';
			case E_NOTICE: // 8 //
				return 'NOTICE';
			case E_CORE_ERROR: // 16 //
				return 'CORE_ERROR';
			case E_CORE_WARNING: // 32 //
				return 'CORE_WARNING';
			case E_CORE_ERROR: // 64 //
				return 'COMPILE_ERROR';
			case E_CORE_WARNING: // 128 //
				return 'COMPILE_WARNING';
			case E_USER_ERROR: // 256 //
				return 'USER_ERROR';
			case E_USER_WARNING: // 512 //
				return 'USER_WARNING';
			case E_USER_NOTICE: // 1024 //
				return 'USER_NOTICE';
			case E_STRICT: // 2048 //
				return 'STRICT';
			case E_RECOVERABLE_ERROR: // 4096 //
				return 'RECOVERABLE_ERROR';
			case E_DEPRECATED: // 8192 //
				return 'DEPRECATED';
			case E_USER_DEPRECATED: // 16384 //
				return 'USER_DEPRECATED';
		}
	}
}