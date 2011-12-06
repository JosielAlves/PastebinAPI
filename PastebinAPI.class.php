<?php
class PastebinAPI
{
    public $APIKey;
    //Internal constants
    const APIBASEURL='http://pastebin.com/api/';
    //API paste expire date constants
    const PASTE_EXPIRENEVER='N';
    const PASTE_EXPIRE10MINUTES='10M';
    const PASTE_EXPIRE1HOUR='1H';
    const PASTE_EXPIRE1DAY='1D';
    const PASTE_EXPIRE1MONTH='1M';

    public function createPaste($pasteCode, $pasteName="", $pasteFormat="", $pastePrivate=0, $pasteExpireDate=self::PASTE_EXPIRENEVER)
    {
        $parameters=array(
            'api_option'=>'paste',
            'api_paste_code'=>$pasteCode,
            'api_paste_name'=>$pasteName,
            'api_paste_format'=>$pasteFormat,
            'api_paste_private'=>$pastePrivate,
            'api_paste_expire_date'=>$pasteExpireDate
        );
        $res=$this->makeRequest('api_post.php', $parameters);
        if(filter_var($res, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED|FILTER_FLAG_PATH_REQUIRED))
        {
            return $res;
        }
        return false;
    }

    private function formatParameters(array $parameters)
    {
        $parameters['api_dev_key']=$this->APIKey;
        $parameters=http_build_query($parameters, false, '&');
        return $parameters;
    }

    private function makeRequest($service, array $parameters=array())
    {
        $parameters=$this->formatParameters($parameters);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, self::APIBASEURL . $service);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Pastebin API');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $res=curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
