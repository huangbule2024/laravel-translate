<?php
namespace App\Illuminate\Translate;

use Illuminate\Support\Manager;

class TranslateManage extends Manager
{

    public function getDefaultDriver()
    {
        return $this->config->get('translate.driver');
    }

    public function handle($src_text)
    {
        return $this->driver()->handle($src_text);
    }

    public function createNiuDriver()
    {
        return new NiuTranslate($this->config->get('translate.niu'));
    }

    public function createIflytekDriver()
    {
        return new IflytekTranslate($this->config->get('translate.iflytek'));
    }
}
