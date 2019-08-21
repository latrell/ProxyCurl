<?php

namespace Latrell\ProxyCurl;

class ProxyModel
{
	public $ip;
	public $port;
	public $address;
	public $isp;
	public $export_ip;
	public $timeout;
	public $use_time;

	public function __toString()
	{
		return json_encode([
			'ip' => $this->ip,
			'port' => $this->port,
			'address' => $this->address,
			'isp' => $this->isp,
			'export_ip' => $this->export_ip,
		], JSON_UNESCAPED_UNICODE);
	}
}