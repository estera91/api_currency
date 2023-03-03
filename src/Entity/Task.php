<?php // src/Entity/Task.php
namespace App\Entity;

class Task
{
    /*
     * Amount for make conversion
     * @(folat)
     */
    public $amount;
    /*
     * Type of conversion 0- sgd to pln, 1 pln to sgd
     * @(bool)
     */
    public $type;
    /*
     * Amount after calculations
     * @(bool)
     */
    public $result;
    /*
     * Description
     * @(string)
     */
    public $desc;
    
    public function getTask(): string
    {
        return $this->task;
    }

    public function setTask(string $task): void
    {
        $this->task = $task;
    }

    //----------------
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
    //----------------------------------------
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
    /**
     * Function responsible for sending curl request according to given parameters
     * @param string $method - (string) can be "GET" or "POST"
     * @param string $url  - (string) url address for request
     * @param array $headers - (array) headers for request
     * @param bool $arrayResponse - (bool) information that decide if in return value should be in array format
     * @return string or array with data from request
     */
    public function sendRequest($method,$url,$headers,$arrayResponse){
         $curl = curl_init();
         curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => $headers
                 ]);
        if($arrayResponse){
            $response = json_decode(curl_exec($curl),true);
        }else{
            $response = curl_exec($curl);
        }
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
                return "cURL Error #:" . $err;
        } else {
            return $response;
        }
        
    }
    /**
     * Function for preparing data for make an request into an API
     * @return boolean
     */
    public function apiRequestLocal(){

        $url = 'http://api_currency/api/calculator/currency_dicts/1';
        $method = "GET";
        $headers = [];
        $response = $this->sendRequest($method, $url, $headers,true);
        if($response && $this->type==0){
            $this->result = $response['unit_sgd_pln']*$this->amount;
            $this->desc = "PLN";
        }elseif($response){
            $this->result = $response['unit_pln_sgd']*$this->amount;
            $this->desc = "SGD";
        }
        return true;      
    }
  
}