<?php
/**
 * @package     capi\capi\Capi
 * @subpackage
 *
 * @copyright   Copyright (C) 2019 Annatech LLC. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
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