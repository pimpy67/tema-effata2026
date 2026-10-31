# Deploy tema-effata2026

## Percorsi utili

- **Locale (MAMP):** `/Applications/MAMP/htdocs/wp-effata2026/wp-content/themes/tema-effata2026`
- **Server (Docker volume):** `/var/lib/docker/volumes/wordpress-effata_wp_data/_data/wp-content/themes/tema-effata2026`
- **GitHub:** https://github.com/pimpy67/tema-effata2026
- **IP server:** 76.13.37.133

---

## Deploy normale (dopo ogni modifica)

### 1. Dal Mac (nella cartella del tema)
```bash
cd /Applications/MAMP/htdocs/wp-effata2026/wp-content/themes/tema-effata2026

git add css/style.css
git commit -m "descrizione della modifica"
git push
```

### 2. Dal server Hostinger (via SSH)
```bash
cd /var/lib/docker/volumes/wordpress-effata_wp_data/_data/wp-content/themes/tema-effata2026
git pull
```

---

## Accesso SSH al server
```bash
ssh root@76.13.37.133
```

---

## Primo setup git sul server (già fatto, non ripetere)
```bash
git init
git remote add origin https://pimpy67:TOKEN@github.com/pimpy67/tema-effata2026.git
git fetch origin main
git reset --hard origin/main
```
