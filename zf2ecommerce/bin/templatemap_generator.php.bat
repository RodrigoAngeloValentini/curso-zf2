@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/zendframework/zendframework/bin/templatemap_generator.php
php "%BIN_TARGET%" %*
