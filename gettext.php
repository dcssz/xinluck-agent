<?php
error_reporting(-1);
ini_set('display_errors', 'on');
putenv('LC_ALL=zh_CN');
setlocale(LC_ALL, 'zh_CN');
bind_textdomain_codeset('zh_CN', 'UTF-8');
bindtextdomain('zh_CN_2', './assets/locales');
textdomain('zh_CN_2');

echo _('額度剩餘');