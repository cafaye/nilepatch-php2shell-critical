FROM php:7.4-apache

# Security mitigations for php2shell (CVE-2026-109618, CVE-2026-109619)
RUN { \
      echo "session.upload_progress.enabled = 0"; \
      echo "memory_limit = -1"; \
    } > /usr/local/etc/php/conf.d/99-security.ini

COPY . /var/www/html/
RUN chmod -R 755 /var/www/html
