find . -name "*.php" >POTFILES
xgettext -n --files-from=POTFILES --language=php --from-code=UTF-8

msginit --locale=zh_CN.utf-8 --input=messages.po
msgmerge -s -U cn.po messages.po
msgfmt cn.po
