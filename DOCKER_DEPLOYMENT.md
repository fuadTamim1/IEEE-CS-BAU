# Docker Deployment Guide for Hostinger VPS

## What I Fixed

1. **Removed conflicting Docker files**: `compose.yaml` (Laravel Sail) and old `docker-compose.yaml` - these were causing confusion
2. **Created production-ready multi-stage Dockerfile**: Optimized with Alpine Linux for smaller images
3. **Set up proper docker-compose.yml**: Production configuration with all required services
4. **Added .dockerignore**: Excludes unnecessary files from Docker build
5. **Created Docker configuration files**:
   - `docker/nginx/default.conf` - Nginx configuration
   - `docker/php/php.ini` - PHP configuration
   - `docker/php/www.conf` - PHP-FPM configuration

---

## Step-by-Step Deployment to Hostinger VPS

### Prerequisites
- SSH access to your Hostinger VPS
- Docker and Docker Compose installed on the VPS
- Domain name pointed to your VPS IP

### Step 1: Install Docker & Docker Compose on Hostinger VPS

SSH into your VPS and run:

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Add your user to docker group
sudo usermod -aG docker $USER
newgrp docker

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify installation
docker --version
docker-compose --version
```

### Step 2: Clone/Upload Your Project

```bash
# Option A: Clone from Git
cd /home/username
git clone your-repo-url ieee-cs-platform
cd ieee-cs-platform

# Option B: Upload via SCP
scp -r ./IEEE_CS_Platform your-vps-user@your-vps-ip:/home/username/
cd /home/username/IEEE_CS_Platform
```

### Step 3: Configure Environment Variables

```bash
# Edit your .env file
nano .env

# Make sure these are set correctly:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=ieee_cs_db
DB_USERNAME=ieee_user
DB_PASSWORD=strong_password_here
DB_ROOT_PASSWORD=root_password_here

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Step 4: Build and Start Containers

```bash
# Build the Docker image (this takes ~5-10 minutes)
docker-compose build

# Start containers in detached mode
docker-compose up -d

# Check if all containers are running
docker-compose ps

# Check logs to verify everything started
docker-compose logs -f

# If you see any errors, check individual service logs:
docker-compose logs app    # PHP-FPM logs
docker-compose logs web    # Nginx logs
docker-compose logs mysql  # MySQL logs
```

### Step 5: Initialize Database and Application

```bash
# Run migrations
docker-compose exec app php artisan migrate --force

# Seed database (if needed)
docker-compose exec app php artisan db:seed

# Generate application key (if needed)
docker-compose exec app php artisan key:generate

# Clear caches
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

### Step 6: Configure SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Get SSL certificate
sudo certbot certonly --standalone -d yourdomain.com -d www.yourdomain.com

# Update nginx config to use SSL
sudo nano docker/nginx/default.conf

# Uncomment the HTTPS redirect section and add:
listen 443 ssl http2;
ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

# Restart nginx container
docker-compose restart web
```

### Step 7: Useful Docker Commands

```bash
# View logs
docker-compose logs -f app
docker-compose logs -f web

# Execute artisan commands
docker-compose exec app php artisan tinker
docker-compose exec app php artisan queue:work

# Access bash shell
docker-compose exec app sh

# Stop all containers
docker-compose down

# Start containers
docker-compose up -d

# Rebuild containers
docker-compose up -d --build

# Remove unused volumes/images
docker system prune -a
```

### Step 8: Set Up Automatic SSL Renewal (Cron)

```bash
# Add to crontab
sudo crontab -e

# Add this line (runs renewal check daily at 3 AM)
0 3 * * * certbot renew --quiet
```

### Step 9: Backup Your Database

```bash
# Manual backup
docker-compose exec mysql mysqldump -u ieee_user -p ieee_cs_db > backup.sql

# Automated daily backup (add to crontab)
0 2 * * * docker-compose -f /home/username/IEEE_CS_Platform/docker-compose.yml exec -T mysql mysqldump -u ieee_user -pYOUR_PASSWORD ieee_cs_db > /home/username/backups/db_$(date +\%Y\%m\%d).sql
```

### Step 10: Enable Auto-restart on Server Reboot

```bash
# Create systemd service file
sudo nano /etc/systemd/system/ieee-cs.service

# Add this content:
[Unit]
Description=IEEE CS Platform Docker
After=docker.service
Requires=docker.service

[Service]
Type=simple
WorkingDirectory=/home/username/IEEE_CS_Platform
ExecStart=/usr/local/bin/docker-compose up
ExecStop=/usr/local/bin/docker-compose down
Restart=always

[Install]
WantedBy=multi-user.target

# Enable the service
sudo systemctl daemon-reload
sudo systemctl enable ieee-cs.service
sudo systemctl start ieee-cs.service
```

---

## Directory Structure After Setup

```
IEEE_CS_Platform/
├── dockerfile
├── docker-compose.yml
├── .dockerignore
├── .env
├── docker/
│   ├── nginx/
│   │   └── default.conf
│   ├── php/
│   │   ├── php.ini
│   │   └── www.conf
│   └── mysql/
└── [rest of your Laravel app]
```

---

## Troubleshooting

**Containers won't start:**
```bash
docker-compose logs
```

**Permission denied errors:**
```bash
docker-compose exec app chmod -R 755 storage bootstrap/cache
```

**Database connection issues:**
```bash
docker-compose exec mysql mysql -u ieee_user -p -e "SELECT 1;"
```

**High memory usage:**
Check `docker/php/www.conf` and reduce `pm.max_children` value

---

## Final Notes

- Remove old Docker files: `compose.yaml`, `docker-compose.prod.yaml`, `docker-compose.yaml`
- Keep only: `dockerfile`, `docker-compose.yml`, `.dockerignore`, and the `docker/` folder
- Your app will be accessible at `http://yourvps-ip` or `https://yourdomain.com`
