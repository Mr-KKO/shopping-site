<?php

return [
    'alipay' => [
        'app_id'         => '',
        'ali_public_key' => '',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',    # 公众号 app id
        'mch_id'      => '',    # 商户号
        'key'         => '',    # API 密钥
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];