# Unisender-PHP-Light-Class

[![HitCount](http://hits.dwyl.io/neatek/Unisender-PHP-Light-Class.svg)](http://hits.dwyl.io/neatek/Unisender-PHP-Light-Class)

```
require_once 'unisender.class.php';
$uni = new Unisender("HERE_YOUR_API_KEY");

// Получить список рассылок
//var_dump($uni->getLists());

// Выслать подтверждение на рассылку
/*$pams = [
	'Name' => 'Neatek',
	'email' => 'someemail@gmail.com',
];

var_dump($uni->subscribe('7322182', $pams));
*/

$import = [
	'Neatek', // name
	'someemail@gmail.com', // email
	'897897897897' // mobile phone
];

// Импорт контакта в лист
// можно 7322182 перечислять через запятую.
var_dump( $uni->import('7322182', $import) );
```

# Support developer
If you like my job (plugin) you can send me some $$$ on beer.

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.me/neatek/3)

* Для русских пользователей вы можете использовать ссылку https://neatek.ru/support/ (Yandex деньги)
