<?php

namespace Latrell\ProxyCurl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @property bool $error
 * @property string $response
 * @method static \Latrell\ProxyCurl\ProxyCurl init()
 * @method static \Latrell\ProxyCurl\ProxyCurl setCity(string $city_code)
 * @method static \Latrell\ProxyCurl\ProxyCurl setStrict(bool $strict)
 * @method static \Latrell\ProxyCurl\ProxyCurl setUserAgent(string $user_agent)
 * @method static \Latrell\ProxyCurl\ProxyCurl setReferer(string $referer)
 * @method static \Latrell\ProxyCurl\ProxyCurl setHeader(string $key, string $value)
 * @method static \Latrell\ProxyCurl\ProxyCurl setOpt(string $option, string $value)
 * @method static \Latrell\ProxyCurl\ProxyModel getShortS5Proxy()
 * @method static string get(string $url, array $data = [])
 * @method static string post(string $url, $data = [])
 * @method static bool|string getResponseHeaders(string $header_key = null)
 * @method static \Latrell\ProxyCurl\ProxyCurl close()
 *
 * @see \Latrell\ProxyCurl\ProxyCurl
 */
class ProxyCurl extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'proxy-curl';
	}
}