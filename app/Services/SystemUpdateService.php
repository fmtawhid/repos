<?php
namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Log;

class SystemUpdateService {

    private array $headers;
    private array $contentTypes;
    private int $timeout = 20;
    private string $customUrl = "";
    private string $proxy = "";
    private array $curlInfo = []; 
    public const ORIGIN = 'https://client.themetags.net/api';
    public const TT_URL = self::ORIGIN . "/";

    public function __construct()
    {
        $this->contentTypes = [
            "application/json"    => "Content-Type: application/json",
            "multipart/form-data" => "Content-Type: multipart/form-data",
            "User-Agent" => "User-Agent: ".request()->userAgent(),
           
        ];

        $this->headers = [
            $this->contentTypes["application/json"],        
            $this->contentTypes['User-Agent'],        
          
        ];
    }
    # get version list
    public function versionLists($opts = [])
    {
        $url = self::TT_URL.'versions';       
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }
    # get version list
    public function verification($opts = [])
    {
        $url = self::TT_URL.'verification'; 
        $this->baseUrl($url);
      
        return $this->sendRequest($url, 'POST', $opts);
    }

    # get version update
    public function updates($opts = [])
    {
        $url = self::TT_URL.'update'; 
        $this->baseUrl($url);
      
        return $this->sendRequest($url, 'POST', $opts);
    }

   public function healthCheck($opts)
   {
        $url = self::TT_URL.'health-check';       
        $this->baseUrl($url);
        return $this->sendRequest($url, 'POST', $opts);
   }

    /**
     * @param  string  $url
     * @param  string  $method
     * @param  array   $opts
     * @return bool|string
     */
    private function sendRequest(string $url, string $method, array $opts = [])
    {
       
        $post_fields = json_encode($opts);
      
        $curl_info = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_POSTFIELDS     => $post_fields,
            CURLOPT_HTTPHEADER     => $this->headers,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FAILONERROR    => true,
            CURLOPT_AUTOREFERER    => true
    

        ];

        if ($opts == []) {
            unset($curl_info[CURLOPT_POSTFIELDS]);
        }

        if (!empty($this->proxy)) {
            $curl_info[CURLOPT_PROXY] = $this->proxy;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $curl_info);
        $response = curl_exec($curl);
   
        $info           = curl_getinfo($curl);
        $this->curlInfo = $info;

        curl_close($curl);
 
        if (!$response) Log::info("server communicate issue: ".curl_error($curl));
        
        return $response;
    }
  
    /**
     * @param  string  $url
     */
    private function baseUrl(string &$url)
    {
        if ($this->customUrl != "") {
            $url = str_replace(self::ORIGIN, $this->customUrl, $url);
        }
    }
}