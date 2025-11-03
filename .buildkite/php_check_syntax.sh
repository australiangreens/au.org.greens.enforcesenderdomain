#!/bin/bash
set -eo pipefail

for file in `find "./" -type f -name "*.php"` ; do
    php -l $file
done

for file in `find "./" -type f -name "*.module"` ; do
    php -l $file
done

for file in `find "./" -type f -name "*.inc"` ; do
    php -l $file
done
