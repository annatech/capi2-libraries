<?php
/**
 * @package     capi\capi\Capi
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Capi;


class CapiError
{
	/**
	 * @param $request
	 * @param $response
	 * @param $exception
	 *
	 * @return mixed
	 *
	 * @since version
	 */
	public function __invoke($request, $response, $exception) {
		return $response
			->withStatus($response->getStatusCode())
			->withHeader('Content-Type', 'text/html')
			->write($exception->getMessage());
	}
}