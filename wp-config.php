<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'softgroup');

/** Имя пользователя MySQL */
define('DB_USER', 'themole');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'themole');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%oEf~.>a.Q;WXAQ?c29Mz,+PjlZ:o@/r8kZ2oAc_DX%!5qp2bK @MMgTU2 F9$N[');
define('SECURE_AUTH_KEY',  '[>IjY3{,l-zALN-ih$=&_dj eb*QNb[Od$9tMg/!/L;F_bS>@Ju_cBu!9d3Iieen');
define('LOGGED_IN_KEY',    'sZwM*x]hY]9oo2l4]Mmbgi+*R% 8 ]+/+9f8|9`{h8R]3*tysx{WCzXu#A]x4$1Y');
define('NONCE_KEY',        ']W6>t_T7n<mVJoQ15M(TxAf_o.m^<n@${.6LucHT~(8mpxkw>Gsb,Gd=%Vu$_~vX');
define('AUTH_SALT',        '@YQhVOl^5s#DXi^2WkLyX(:r.Vt;BE7DQj_,18P :+~(c# %h-wKZsVsbEQ,V`gx');
define('SECURE_AUTH_SALT', 'f8cF3{ex?,o5v[t>?zx|:wNZ*A6K?3h/c?K52?B:k)l.-_GGm{0)NMkDjbJ1)E>Z');
define('LOGGED_IN_SALT',   'S#th7mH_J{}F~w<&oK3-u|!RPsbh 6%=DgUcFTupr_Ykfn3b%a;yZWTlKEIJHLt8');
define('NONCE_SALT',       'Yf+<(A&k|s5-EUm%`U ys02f+O(j.i6HGA9HS{/yM?dmP}*M9+jXgoz2GTO:uD8l');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
