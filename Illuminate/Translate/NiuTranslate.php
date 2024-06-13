<?php
namespace App\Illuminate\Translate;

use Illuminate\Support\Facades\Http;

class NiuTranslate implements TranslateInterface
{
    private string $url = 'https://api.niutrans.com/NiuTransServer/translation';

    private string $api_key;

    public function __construct(array $options = [])
    {
        $this->api_key = $options['api_key'];
    }

    public function handle($src_text)
    {
        $response = Http::timeout(3)->asJson()->get($this->url, [
            'src_text' => $src_text,
            'from' => 'zh',
            'to' => 'en',
            'apikey' => $this->api_key
        ]);
        if (!empty($response['error_msg'])) {
            logger($response);
            return '';
        }
        return $response['tgt_text'];
    }
}
