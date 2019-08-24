<?php
/**
 * @package     capi\capi\Capi
 * @subpackage
 *
 * @copyright   Copyright (C) 2019 Annatech LLC. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace capi;

use \Slim\Http\Response;
use \Slim\Http\Request;

/**
 * @package     Capi
 *
 * @since       version
 */
class CapiRouter extends CapiApp
{
	/**
	 * CapiRouter constructor.
	 *
	 * @param $app
	 */
	function __construct($app)
	{
		/**
		 * @OA\Get(
		 *     path="/about",
		 *     summary="Default base path returns cAPI applications details such as: version, copyright, license, support, capi, and about.",
		 *     operationId="getAbout",
		 *     tags={"capi"},
		 *     @OA\Response(response="200", description="Return cAPI application details.")
		 * )
		 */
		$app->get('/about', function (Request $request, Response $response, $args) {

			$detail             = new \stdClass();
			$detail->version    = null;
			$detail->copyright  = null;
			$detail->license    = null;
			$detail->support    = null;
			$detail->capi       = null;
			$detail->about      = null;

			/**
			 * TODO: Configure conditional checks to allow the user to customize the information returned here.
			 */

			$detail->version    = '2.0-alpha';
			$detail->copyright  = 'Copyright (C) 2019 Steve Tsiopanos | Annatech LLC. All rights reserved.l';
			$detail->license    = 'http://www.gnu.org/licenses/gpl-2.0.html';
			$detail->support    = 'https://www.annatech.com';
			$detail->capi       = 'https://capi.app';
			$detail->about      = 'cAPI is the fantastic result of integrating Slim micro-framework with Joomla! CMS. By leveraging Joomla\'s advanced, extensible architecture and robust ACL, cAPI can transform your website into a true middleware service for anything ranging from SQL servers, MongoDB servers and even Microsoft\'s Active Directory (think of the SSO possibilities!).';

			return $response->withJson(
				$detail, 200
			);
		})->setName('getAbout');

		/**
		 * @OA\Get(
		 *     path="/return",
		 *     summary="Mirrors the API request.",
		 *     operationId="getReturn",
		 *     tags={"capi"},
		 *     @OA\Response(response="200", description="Return cAPI request details.")
		 * )
		 */
		$app->get('/return', function(Request $request, Response $response, $args){
			$route = $request->getAttribute('route');
			$headerObject = $request->getHeaders();
			foreach ($headerObject as $name => $values) {
				$headers[$name] = implode(", ", $values);
			}
			$parsedBody = $request->getParsedBody();
			$uri = $request->getUri();

			return $response->withJson(array(
				'method'        => $route->getMethods(),
				'name'          => $route->getName(),
				'headers'       => $headers,
				'body'          => $parsedBody,
				'host'          => $uri->getHost(),
				'path'          => $uri->getPath(),
				'query_params'  => $uri->getQuery(),
				'params'        => $args
			),200
			);
		});
	}
}