<?php
namespace Latrell\ProxyCurl\Console;

use Illuminate\Console\Command;
use Latrell\ProxyCurl\Facades\ProxyCurl;

class CurlCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'proxy:curl
							{url : 请求地址}
							{--C|city= : IP城市代码，默认全国。}
							{--X|request=GET : 使用的请求命令。}
							{--U|user_agent= : 设置UserAgent。}
							{--H|header= : 自定义头信息。}
							{--I|head : 显示响应报文头部信息。}
							{--L|location : 跟随重定向。}
							{--D|data= : POST数据。}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '使用代理IP发起CURL请求。';

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
	 */
	public function handle()
	{
		$curl = ProxyCurl::init();

		$method = strtolower($this->option('request'));
		if (! in_array($method, ['get', 'post'])) {
			$this->error('The request can only be GET or POST.');
			return;
		}

		$user_agent = $this->option('user_agent');
		if (! is_null($user_agent)) {
			$curl->setUserAgent($user_agent);
		}

		$header = $this->option('header');
		$header = array_filter(explode("\n", $header));
		foreach ($header as $item) {
			list($key, $value) = explode(':', $item, 2);
			$curl->setHeader(trim($key, $value), trim($key, $value));
		}

		if ($this->option('location')) {
			$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
		}

		$city_code =  $this->option('city');
		$curl->setCity($city_code);

		$url = $this->argument('url');
		switch ($method) {
			case 'get':
				$curl->get($url);
				break;
			case 'post':
				$data = $this->option('data') ?: [];
				$curl->post($url, $data);
				break;
		}

		if ($curl->error) {
			$this->error($curl->error_code . ': ' . $curl->error_message);
			return;
		}

		$response = $curl->response;

		if ($this->option('head')) {
			$response = join("\n", $curl->getResponseHeaders()) . "\n\n" . $response;
		}

		$this->line($response);
	}
}
