# aliyun-sts

fork from `hpyer/aliyun-sts`, deleted laravel supports and changed directory structure.

# 安装 
composer require ninvfeng/aliyun-sts

# 使用
```
$config['bucket']          = 'oss bucket';
$config['region']          = 'oss-cn-shenzhen';
$config['endPoint']        = 'oss-cn-shenzhen.aliyuncs.com';
$config['AccessKeyId']     = 'AccessKeyId';
$config['AccessKeySecret'] = 'AccessKeySecret';
$config['roleArn']         = '角色权限信息, 阿里云控制台查看';
$config['roleName']        = '角色名称';
$obj=new Sts\OssToken($config);
$res=$obj->getStsAcount();
response($res);
```