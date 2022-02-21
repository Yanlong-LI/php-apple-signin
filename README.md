php-apple-signin Apple 苹果账号登陆
=======
PHP library to manage Sign In with Apple identifier tokens, and validate them server side passed through by the iOS client.

> PHP库来管理使用Apple标识符令牌的登录，并验证iOS客户端通过的服务器端。

Parity replacement griffinledingham/php-apple-signin (Library out of maintenance)

>平价替换 griffinledingham/php-apple-signin （停止维护的库）

Installation 安装
------------

Use composer to manage your dependencies and download php-apple-signin:

需要您的项目使用 composer 管理依赖，使用下方命令安装此库。

```bash
composer require yanlongli/php-apple-signin
```

Example
-------
```php
<?php
use AppleSignIn\ASDecoder;
// ASAuthorizationAppleIDCredential credential
$clientUser = "example_client_user"; //credential.user
$identityToken = "example_encoded_jwt"; // credential.identityToken

// option 
// ASDecoder::$publicKeys = Cache apple keys;

$appleSignInPayload = ASDecoder::getAppleSignInPayload($identityToken);

/**
 * Obtain the Sign In with Apple email and user creds.
 */
$email = $appleSignInPayload->getEmail();
$user = $appleSignInPayload->getUser();

/**
 * Determine whether the client-provided user is valid.
 */
$isValid = $appleSignInPayload->verifyUser($clientUser);

?>
```

# change log

## v2.0
Simplify the code and update the data decoding with the dependent library
> 简化代码，随依赖库更新数据解码

# FAQ

[FAQ](doc/faq.md)
