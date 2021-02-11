<?php

namespace App\Http\Controllers\Payments;

use App\Events\PaymentReceived;
use App\Http\Controllers\Controller;
use App\Models\C2BTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    // controller constants
    public $baseURL;

    // constructor
    public function __construct()
    {
        if (env('APP_ENV') === 'local') {
            $this->baseURL = 'https://sandbox.safaricom.co.ke';
        } else {
            $this->baseURL = 'https://api.safaricom.co.ke';
        }
    }

    // MISCELLANEOUS/HELPERS
    // access token
    public function generateAccessToken()
    {
        $credentials = base64_encode(
            config('payments.mpesa.api_key').":".config('payments.mpesa.api_secret')
        );
        $url = "$this->baseURL/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic $credentials"));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;
    }

    // STK PUSH
    // stk push password
    public function LMOPassword()
    {
        $lipa_time = now()->format('YmdHms');
        $passkey = config('payments.mpesa.lmo_passkey');
        $BusinessShortCode = config('payments.mpesa.lmo_short_code');
        $timestamp =$lipa_time;
        return base64_encode("$BusinessShortCode$passkey$timestamp");
    }

    // initiate stk push
    public function stkInit(Request $request)
    {
        $url = "$this->baseURL/mpesa/stkpush/v1/processrequest";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => config('payments.mpesa.lmo_short_code'),
            'Password' => $this->LMOPassword(),
            'Timestamp' => now()->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request->input('amount'),
            'PartyA' => '254' . substr($request->input('phone_number'), -9),
            'PartyB' => config('payments.mpesa.lmo_short_code'),
            'PhoneNumber' => '254' . substr($request->input('phone_number'), -9),
            'CallBackURL' => config('payments.mpesa.stk_callback'),
            'AccountReference' => "Noria Telecom",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        return curl_exec($curl);
    }

    // save stk push
    public function stkSave(Request $request)
    {
        Log::stack(['payments'])->info($request->getContent() . "\n");
        return response()->json(['message' => 'Request Processed...'], 200);
    }


    // C2B
    // validation response
    public function validationResponse($result_code, $result_description)
    {
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    // mpesa validation
    public function c2bValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->validationResponse($result_code, $result_description);
    }

    // c2b confirmation
    public function c2bConfirmation(Request $request)
    {
        $content = json_decode($request->getContent());
        Log::channel('mpesa')->info($request->getContent() . "\n");
        $txn = C2BTransaction::create([
            'TransactionType' => $content->TransactionType,
            'TransID' => $content->TransID,
            'TransTime' => $content->TransTime,
            'TransAmount' => $content->TransAmount,
            'BusinessShortCode' => $content->BusinessShortCode,
            'BillRefNumber' => $content->BillRefNumber,
            'InvoiceNumber' => $content->InvoiceNumber,
            'OrgAccountBalance' => $content->OrgAccountBalance,
            'ThirdPartyTransID' => $content->ThirdPartyTransID,
            'MSISDN' => $content->MSISDN,
            'FirstName' => $content->FirstName,
            'MiddleName' => $content->MiddleName,
            'LastName' => $content->LastName
        ]);

        PaymentReceived::dispatch($txn);
        Log::stack(['payments'])->info($txn . "\n");
        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }

    // register urls
    public function c2bRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . '/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => config('payments.mpesa.pb_number'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => config('payments.mpesa.c2b_confirmation'),
            'ValidationURL' => config('payments.mpesa.c2b_validation')
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }

    // maybe simulate...?
    public function c2bSimulate()
    {
        $url = $this->baseURL . '/mpesa/c2b/v1/simulate';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '. $this->generateAccessToken()));
        $curl_post_data = array(
           'ShortCode' => config('payments.mpesa.pb_number'),
           'CommandID' => 'CustomerPayBillOnline',
           'Amount' => '100',
           'Msisdn' => '254728656735',
           'BillRefNumber' => 'Joe Tester'
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);
        echo $curl_response;
    }

}
