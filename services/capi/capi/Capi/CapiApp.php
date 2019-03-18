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
use JComponentRouterBase;

class CapiApp
{
	/**
	 * @var
	 * @since 2.0
	 */
	public $app;

	/**
	 * @var
	 * @since version
	 */
	protected $application;

	/**
	 * @var
	 * @since 2.0
	 */
	protected $container;

	/**
	 * CapiApp constructor.
	 * @throws Slim\Exception\MethodNotAllowedException
	 * @throws Slim\Exception\NotFoundException
	 * @since 2.0
	 */
	public function __construct()
	{
		/**
		 * Get cAPI Settings
		 */
		$settings = (new CapiSettings)->getSettings();

		/**
		 * Get Slim Container
		 */
		$this->container = new \Slim\Container($settings);

		/**
		 * Slim Response Time Start Timestamp
		 */
		$this->container['x_time'] = function ($c) {
			return CapiSettings::getXtime();
		};
		
		/**
		 * Create Slim App Instance
		 */
		$this->loadSlimApp();

		/**
		 * Assign Error Handler
		 */
		$this->container['errorHandler'] = function ($c) {
			return new CapiError();
		};

		/**
		 * Add Middleware to Slim Instance
		 */
		$this->app->add(new CapiMiddleware($this->app));
		
		/**
		 * Add View to Slim Instance
		 */
		// $app->add(new CapiView($app));

		/**
		 * Call Default Router Methods
		 */
		new CapiRouter($this->app);

		/**
		 * Load cAPI Services Plugins
		 */
		$this->loadServicesPlugins($this->app);

		/**
		 * Run Slim Application
		 */
		$this->app->run();

		return;
	}

	/**
	 *
	 * @return \Slim\App
	 *
	 * @since 2.0
	 */
	protected function loadSlimApp(){
		/**
		 * Create Slim App Instance
		 */
		$this->app = new \Slim\App($this->container);
		
		$this->app->add(function ($request, $response, $next)  {
			/**
			 * clone environment , using clone prevent to overide
			 */
			$env = clone $this->environment;

			$capi_base_path = $this->get('settings')['runtime']['capi_base_path'];

			$env->set('SCRIPT_NAME',$capi_base_path);
			$this->request = \Slim\Http\Request::createFromEnvironment($env);

			$response = $next($this->request, $response);
			return $response;
		});

		return $this->app;
	}

	/**
	 *
	 *
	 * @since 2.0
	 */
	protected function loadServicesPlugins(){

		/**
		 * Get Joomla application
		 */
		$application = JFactory::getApplication('site');

		/**
		 * Save Slim App Instance to Joomla Application
		 */
		$application->set('capi_app',$this->app);

		JLoader::registerPrefix('Services', JPATH_PLUGINS . '/services');
		PluginHelper::importPlugin('services');
	}

}