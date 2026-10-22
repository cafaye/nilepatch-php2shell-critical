FROM php:7.4-apache
# VULNERABLE: PHP 7.4 is EOL — no official fix for php2shell (CVE-2026-109618, CVE-2026-109619)
# Mitigations required: block multipart/form-data, disable session upload progress, memory_limit=-1
COPY . /var/www/html/
RUN chmod -R 755 /var/www/html
