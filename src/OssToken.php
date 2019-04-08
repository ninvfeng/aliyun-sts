<?php

namespace Sts;

use Sts\AssumeRoleRequest;
use Sts\Core\DefaultAcsClient;
use Sts\Core\Profile\DefaultProfile;

class OssToken{

    //传入配置
    public function __construct($config=[]){
        $this->config=$config;
    }

    public function getStsAcount(){

        $bucket          = $this['config']['bucket'];
        $region          = $this['config']['region'];
        $endPoint     = $this['config']['endPoint'];
        $AccessKeyId     = $this['config']['AccessKeyId'];
        $AccessKeySecret = $this['config']['AccessKeySecret'];
        $roleArn         = $this['config']['roleArn'];

        DefaultProfile::addEndpoint($region, $region, "Sts", $endPoint);
        $iClientProfile = DefaultProfile::getProfile($region, $AccessKeyId, $AccessKeySecret);
        $client = new DefaultAcsClient($iClientProfile);

        $request = new AssumeRoleRequest();
        
        $request->setRoleSessionName("hk-oss-user");
        $request->setRoleArn($roleArn);
        
        $request->setDurationSeconds(3600);
        $response = $client->getAcsResponse($request);

        $AccessKeySecret = $response->Credentials->AccessKeySecret;
        $AccessKeyId = $response->Credentials->AccessKeyId;
        $SecurityToken = $response->Credentials->SecurityToken;

        $data = [
            'AccessKeySecret'=>$AccessKeySecret,
            'AccessKeyId'=>$AccessKeyId,
            'SecurityToken'=>$SecurityToken,
            'bucket'=>$bucket,
            'region'=>$region,
            'endpoint'=>$endPoint,
        ];

        return $data;
    }
}