<?php
namespace App\Illuminate\Translate;

use Illuminate\Support\Facades\Http;

class IflytekTranslate implements TranslateInterface
{
    private string $url = 'https://itrans.xfyun.cn/v2/its';

    private string $app_key;
    private string $app_id;
    private string $app_secret;

    public function __construct(array $options = [])
    {
        $this->app_id = $options['app_id'];
        $this->app_key = $options['app_key'];
        $this->app_secret = $options['app_secret'];
    }

    public function handle($src_text)
    {
        //在控制台-我的应用-机器翻译获取
        $api_sec = $this->app_secret;
        //在控制台-我的应用-机器翻译获取
        $api_key = $this->app_key;

        $url = $this->url;

        $body = [
            'common' => ['app_id' => $this->app_id],
            'business' => ['from' => 'cn', 'to' => 'en'],
            'data' => ['text' => base64_encode($src_text)],
        ];
        // 组装http请求头
        $date = gmdate('D, d M Y H:i:s') . ' GMT';
        $digest = 'SHA-256=' . base64_encode(hash('sha256', json_encode($body), true));
        $builder = sprintf('host: %s
date: %s
POST /v2/its HTTP/1.1
digest: %s', 'itrans.xfyun.cn', $date, $digest);

        $sha = base64_encode(hash_hmac('sha256', $builder, $api_sec, true));
        $authorization = sprintf(
            'api_key="%s", algorithm="%s", headers="%s", signature="%s"',
            $api_key,
            'hmac-sha256',
            'host date request-line digest',
            $sha
        );
        $header = [
            'Authorization' => $authorization,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json,version=1.0',
            'Host' => 'itrans.xfyun.cn',
            'Date' => $date,
            'Digest' => $digest,
        ];

        $response = Http::timeout(3)->withHeaders($header)->asJson()->post($url, $body);
        if ($response['code'] != 0) {
            logger($response);
            return '';
        }
        return $response['data']['result']['trans_result']['dst'];
    }
}
