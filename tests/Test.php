<?php

namespace Latrell\ProxyCurl\Tests;

use Latrell\ProxyCurl\Exception as ProxyCurlException;
use Latrell\ProxyCurl\Facades\ProxyCurl;
use Latrell\ProxyCurl\ProxyModel;
use Orchestra\Testbench\TestCase;

class Test extends TestCase
{
	/**
	 * @throws ProxyCurlException
	 */
	public function testGetShortS5Proxy()
	{
		$proxy = ProxyCurl::init()->getShortS5Proxy();
		$this->assertEquals(ProxyModel::class, get_class($proxy));
		$this->assertTrue(true);
	}

	/**
	 * @throws ProxyCurlException
	 */
	public function testGetRequest()
	{
		$curl = ProxyCurl::init();
		$curl->get('https://ifconfig.me/ip');
		$this->assertNotEmpty($curl->response);
	}

	protected function getPackageProviders($app)
	{
		return [
			'Latrell\\ProxyCurl\\ProxyCurlServiceProvider',
		];
	}

	protected function getPackageAliases($app)
	{
		return [
			'ProxyCurl' => 'Latrell\\ProxyCurl\\Facades\\ProxyCurl',
		];
	}

	/**
	 * Define environment setup.
	 *
	 * @param \Illuminate\Foundation\Application $app
	 *
	 * @return void
	 */
	protected function getEnvironmentSetUp($app)
	{
		$app['config']->set('cache.default', 'redis');
	}
}
