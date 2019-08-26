<?php
/**
 * @package     capi\capi\Capi
 * @subpackage
 *
 * @copyright   Copyright (C) 2019 Annatech LLC. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Annatech\Capi;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class CapiUuid
{
	/**
	 * Returns uuid versions 1, 3, 4, or 5
	 * @param null $type
	 *
	 * @return bool|string
	 *
	 * @since 2.0
	 * @throws \Exception
	 */
	public static function getUuid($type=null){

		try {
			switch($type){
				case 'uuid1':
					// Generate a version 1 (time-based) UUID object
					$uuid1 = Uuid::uuid1();
					return $uuid1->toString();
					break;
				case 'uuid3':
					// Generate a version 3 (name-based and hashed with MD5) UUID object
					$uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
					return $uuid3->toString();
					break;
				case 'uuid4':
					// Generate a version 4 (random) UUID object
					$uuid4 = Uuid::uuid4();
					return $uuid4->toString();
					break;
				case 'uuid5':
					// Generate a version 5 (name-based and hashed with SHA1) UUID object
					$uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
					return $uuid5->toString();
					break;
				default:
					// Generate a version 1 (time-based) UUID object
					$uuid1 = Uuid::uuid1();
					return $uuid1->toString();
			}
		} catch (UnsatisfiedDependencyException $e) {

			// Some dependency was not met. Either the method cannot be called on a
			// 32-bit system, or it can, but it relies on Moontoast\Math to be present.
			
			// return 'Caught exception: ' . $e->getMessage();
			return false;

		}
	}
}