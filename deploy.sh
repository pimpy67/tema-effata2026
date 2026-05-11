#!/bin/bash

VPS="root@76.13.37.133"
REMOTE="/var/lib/docker/volumes/wordpress-effata_wp_data/_data/wp-content/themes/tema-effata2026"
LOCAL="/Applications/MAMP/htdocs/wp-effata2026/wp-content/themes/tema-effata2026"

echo "🚀 Deploy Effatà in corso..."

# CSS
scp "$LOCAL/css/style.css" "$VPS:$REMOTE/css/style.css"

# JS
scp "$LOCAL/js/custom.js" "$VPS:$REMOTE/js/custom.js"

# PHP templates
for f in \
  page-5x1000.php \
  page-adotta-ora.php \
  page-chi-siamo.php \
  page-come-aiutarci.php \
  page-iscriviti.php \
  progetti.php \
  archive.php \
  footer.php \
  header.php \
  functions.php
do
  if [ -f "$LOCAL/$f" ]; then
    scp "$LOCAL/$f" "$VPS:$REMOTE/$f"
    echo "  ✓ $f"
  fi
done

# Immagini img/
echo "  Sincronizzando img/..."
rsync -avz --progress "$LOCAL/img/" "$VPS:$REMOTE/img/"

echo "✅ Deploy completato!"
