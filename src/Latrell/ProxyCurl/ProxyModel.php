<?php

namespace Latrell\ProxyCurl;

class ProxyModel
{
	public $ip;
	public $port;
	public $address;
	public $isp;
	public $timeout;

	public function __toString()
	{
		return json_encode([
			'ip' => $this->ip,
			'port' => $this->port,
			'address' => $this->address,
			'isp' => $this->isp,
		], JSON_UNESCAPED_UNICODE);
	}
}