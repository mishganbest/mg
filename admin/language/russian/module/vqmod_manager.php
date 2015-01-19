<?php
// Button
$_['button_backup']        = 'Сохранить';
$_['button_cancel']        = 'Отмена';
$_['button_clear']         = 'Очистить';
$_['button_download_log']  = 'Скачать лог';
$_['button_vqcache_dump']  = 'Скачать дамп кеша';

// Heading
$_['heading_title']        = 'VQMod Менеджер';

// Columns
$_['column_action']        = 'Вкл / Выкл';
$_['column_author']        = 'Автор';
$_['column_delete']        = 'Действие';
$_['column_file_name']     = 'Имя файла';
$_['column_id']            = 'Название / Описание';
$_['column_status']        = 'Состояние';
$_['column_version']       = 'Версия скрипта';
$_['column_vqmver']        = 'Версия VQMod';

// Entry
$_['entry_author']         = 'Автор:'; // Change
$_['entry_backup']         = 'Резервное копирование файлов:';
$_['entry_ext_store']      = 'Последняя версия:';
$_['entry_ext_version']    = 'Версия VQMod менеджера:';
$_['entry_forum']          = 'OpenCart форум поддержки:';
$_['entry_license']        = 'Лицензия:';
$_['entry_upload']         = 'Загрузить скрипт VQMod:';
$_['entry_vqcache']        = 'Кэш VQMod:';
$_['entry_vqmod_path']     = 'Директория VQMod:';
$_['entry_website']        = 'Сайт:';

// Text Highlighting
$_['highlight']            = '<span class="highlight">%s</span>';

// VQMod Manager Use Errors
$_['error_delete']         = 'Не удается удалить VQMod скрипт!';
$_['error_filetype']       = 'Неверный тип файла! Нужно загрузить файл с раширением xml';
$_['error_install']        = 'Не удается установить VQMod скрипт!';
$_['error_invalid_xml']    = 'Синтаксис XML-файла неправильный для скрипта VQMod !';
$_['error_log_size']       = 'Смотрите журнал ошибок %sMBs. Предел для VQMod Менеджера-6 МБ. Если вам нужно просмотреть ошибки, вам необходимо скачать журнал по FTP. В противном случае очистите его ниже.';
$_['error_moddedfile']     = 'Сценарий не может модифицировать файл \'%s\' ввиду его отсутствия!';
$_['error_move']           = 'Не удается сохранить файл на сервере. Пожалуйста, проверьте разрешения  на запись для каталога.';
$_['error_permission']     = 'Вы не имеете права изменять модуль VQMod Менеджер!';
$_['error_uninstall']      = 'Не удается удалить VQMod скрипт!';
$_['error_vqmod_opencart'] = 'Внимание: \'vqmod_opencart.xml\' требуется для VQMod чтобы функционировать должным образом!';

// $_FILE Upload Errors
$_['error_form_max_file_size']   = 'Скрипт VQMod превышает максимальный допустимый размер!';
$_['error_ini_max_file_size']    = 'Скрипт VQMod превышает максимальный допустимый размер загружаемого файла в настройках php.ini!';
$_['error_no_temp_dir']          = 'Временная папка не найдена!';
$_['error_no_upload']            = 'Файл для загрузки не выбран!';
$_['error_partial_upload']       = 'Загрузка неполная!';
$_['error_php_conflict']         = 'Неизвестный PHP конфликт!';
$_['error_unknown']              = 'Неизвестная ошибка!';
$_['error_write_fail']           = 'Ошибка записи в VQMod скрипт!';

// VQMod Installation Errors
$_['error_error_log_write']            = 'Unable to write to VQMod error log!  Please set "<span class="error-install">/vqmod</span>" directory permissions to 755 or 777 and try again.';
$_['error_error_logs_write']           = 'Unable to write to VQMod error log!  Please set "<span class="error-install">/vqmod/logs</span>" directory permissions to 755 or 777 and try again.';
$_['error_opencart_version']           = 'OpenCart 1.5.x or later is required to use VQMod Manager!';
$_['error_opencart_xml']               = 'Required file "<span class="error-install">/vqmod/xml/vqmod_opencart.xml</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_opencart_xml_disabled']      = 'Warning: "<span class="error-install">vqmod_opencart.xml</span>" is disabled!  VQMod scripts will not function!';
$_['error_opencart_xml_version']       = 'You appear to be using a version of "<span class="error-install">vqmod_opencart.xml</span>" that is out-of-date for your OpenCart version!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_vqcache_dir']                = 'Required directory "<span class="error-install">/vqmod/vqcache</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_vqcache_write']              = 'Unable to write to "<span class="error-install">/vqmod/vqcache</span>" directory!  Set permissions to 755 or 777 and try again.';
$_['error_vqcache_files_missing']      = 'VQMod does not appear to be properly generating vqcache files!';
$_['error_vqmod_core']                 = 'Required file "<span class="error-install">vqmod.php</span>" is missing!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_vqmod_dir']                  = 'The "<span class="error-install">/vqmod</span>" directory does not appear to exist!';
$_['error_vqmod_install_link']         = 'VQMod does not appear to have been integrated with OpenCart!  Please run the VQMod installer at <a href="%1$s">%1$s</a>.  If you have previously run the installer ensure that you are using the latest version of VQMod found at <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a>.';
$_['error_vqmod_opencart_integration'] = 'VQMod does not appear to have been integrated with OpenCart!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_vqmod_script_dir']           = 'Required directory "<span class="error-install">/vqmod/xml</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="http://code.google.com/p/vqmod/" target="_blank">http://code.google.com/p/vqmod/</a> and try again.';
$_['error_vqmod_script_write']         = 'Unable to write to "<span class="error-install">/vqmod/xml</span>" directory!  Please set directory permissions to 755 or 777 and try again.';

// VQMod Manager Dependency Errors
$_['error_simplexml']       = '<a href="http://php.net/manual/en/book.simplexml.php" target="_blank">SimpleXML</a> must be installed for VQMod Manager to work properly!  Contact your host for more info.';
$_['error_ziparchive']      = '<a href="http://php.net/manual/en/class.ziparchive.php" target="_blank">ZipArchive</a> must be installed to download VQMod script files!  Contact your host for more info.';

// VQMod Log Errors
$_['error_mod_aborted']     = 'Mod Aborted';
$_['error_mod_skipped']     = 'Operation Skipped';

// VQMod Variable Settings
$_['setting_cachetime']       = 'cacheTime:<br /><span class="help">Deprecated as of VQMod 2.2.0</span>';
$_['setting_dir_separator']   = 'Directory Separator:';
$_['setting_logfolder']       = 'Log Folder:<br /><span class="help">VQMod 2.2.0 and later</span>';
$_['setting_logging']         = 'Лог ошибок:';
$_['setting_modcache']        = 'modCache:';
$_['setting_path_replaces']   = 'Path Replacements:<br /><span class="help">Changes do not go into effect until the mods.cache file is deleted.</span>';
$_['setting_protected_files'] = 'Protected Files:';
$_['setting_usecache']        = 'useCache:<br /><span class="help">Deprecated as of VQMod 2.1.7</span>';

// Success
$_['success_clear_vqcache'] = 'Кэш VQMod очищен!';
$_['success_clear_log']          = 'Журнал ошибок очищен';
$_['success_delete']             = 'Скрипт VQMod удален!';
$_['success_install']            = 'Скрипт VQMod активирован!';
$_['success_uninstall']          = 'Скрипт VQMod деактивирован!';
$_['success_upload']             = 'Скрипт VQMod загружен!';

// Tabs
$_['tab_about']             = 'О скрипте';
$_['tab_error_log']         = 'Лог ошибок';
$_['tab_settings']          = 'Настройка и обслуживание';
$_['tab_scripts']           = 'VQMod скрипты';

// Text
$_['text_autodetect']      = 'VQMod будет установлен по этому пути. Нажмите Сохранить, чтобы подтвердить путь для полной установки.';
$_['text_autodetect_fail'] = 'Файл установки VQMod не лбнаружен.  Пожалуйста, скачайте и установите <a href="http://code.google.com/p/vqmod/downloads/list" target="_blank">последнюю версию</a> или введите путь нестандартной установки сервера.';
$_['text_cachetime']        = '%s seconds';
$_['text_delete']          = 'Удалить';
$_['text_disabled']        = 'Отключен';
$_['text_enabled']         = 'Включен';
$_['text_install']         = 'Включить';
$_['text_module']          = 'Модули';
$_['text_no_results']      = 'Скрипты VQMod не найдены!';
$_['text_separator']        = ' &rarr; ';
$_['text_success']         = 'Настройки VQMod Менеджера обновлены!';
$_['text_unavailable']     = '&mdash;';
$_['text_uninstall']       = 'Выключить';
$_['text_upload']           = 'Загрузить';
$_['text_usecache_help']    = 'useCache устарела по состоянию на VQMod 2.1.7'; // @TODO
$_['text_vqcache_help']    = 'Некоторые системные файлы будут присутствовать всегда, даже после очистки кэша.';

// Version
$_['vqmod_manager_author']  = 'rph';
$_['vqmod_manager_license'] = 'Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)';
$_['vqmod_manager_version'] = '2.0';

// Javascript Warnings
$_['warning_required_delete']    = 'Внимание! Удаление\\\'vqmod_opencart.xml\\\' Приведет к остановке всех скриптов VQMod. Продолжить?';
$_['warning_required_uninstall'] = 'Внимание! Удаление\\\'vqmod_opencart.xml\\\' Приведет к остановке всех скриптов VQMod. Продолжить?';
$_['warning_vqmod_delete']       = 'Внимание! Удаление скриптов VQMod не может быть отменено! Вы уверены, что хотите это сделать?';
?>