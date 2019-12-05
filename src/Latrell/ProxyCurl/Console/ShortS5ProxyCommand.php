<?php
namespace Latrell\ProxyCurl\Console;

use Illuminate\Console\Command;
use Latrell\ProxyCurl\Exception as ProxyCurlException;
use Latrell\ProxyCurl\Facades\ProxyCurl;

class ShortS5ProxyCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'proxy:short-s5
							{--N|num=1 : 提取数量，单次最多400个。}
							{--C|city= : IP城市代码，默认全国。}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '获取短效Socks5代理IP。';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 * @throws ProxyCurlException
	 */
	public function handle()
	{
		$num = $this->option('num');
		$city_code = $this->option('city');
		$proxy = ProxyCurl::init()->setCity($city_code)->getShortS5Proxy($num);
		$this->line($proxy);
	}
}
