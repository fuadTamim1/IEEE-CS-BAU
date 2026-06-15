#!/bin/bash
# IEEE CS Platform Docker Deployment Script
# Run this on the Hostinger VPS after uploading the project

set -e

PROJECT_DIR="/home/ubuntu/ieee_cs_platform"
cd "$PROJECT_DIR"

echo "🚀 Starting IEEE CS Platform Docker Deployment..."
echo ""

# Step 1: Check if docker is installed
echo "📦 Checking Docker installation..."
if ! command -v docker &> /dev/null; then
    echo "❌ Docker not found! Installing..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sudo sh get-docker.sh
    sudo usermod -aG docker $USER
    rm get-docker.sh
fi

# Step 2: Check if docker-compose is installed
echo "📦 Checking Docker Compose installation..."
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose not found! Installing..."
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
fi

echo "✅ Docker and Docker Compose are installed"
echo ""

# Step 3: Verify .env file exists
echo "⚙️  Checking environment configuration..."
if [ ! -f ".env" ]; then
    echo "❌ .env file not found!"
    echo "Please create .env file with the following variables:"
    echo "  APP_ENV=production"
    echo "  APP_DEBUG=false"
    echo "  APP_URL=https://yourdomain.com"
    echo "  DB_DATABASE=ieee_cs_db"
    echo "  DB_USERNAME=ieee_user"
    echo "  DB_PASSWORD=your_password"
    exit 1
fi
echo "✅ .env file found"
echo ""

# Step 4: Remove old Docker files if they exist
echo "🧹 Cleaning up old Docker configurations..."
rm -f docker-compose.yaml docker-compose.prod.yaml compose.yaml 2>/dev/null || true
echo "✅ Cleanup complete"
echo ""

# Step 5: Build Docker image
echo "🔨 Building Docker image (this may take 5-10 minutes)..."
docker-compose build --progress=plain

echo "✅ Docker image built successfully"
echo ""

# Step 6: Start containers
echo "▶️  Starting containers..."
docker-compose up -d

echo "✅ Containers started"
echo ""

# Step 7: Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready..."
for i in {1..30}; do
    if docker-compose exec -T mysql mysqladmin ping -h localhost &> /dev/null; then
        echo "✅ MySQL is ready"
        break
    fi
    if [ $i -eq 30 ]; then
        echo "❌ MySQL failed to start after 30 seconds"
        exit 1
    fi
    sleep 1
done
echo ""

# Step 8: Run migrations
echo "🔄 Running database migrations..."
docker-compose exec -T app php artisan migrate --force --no-interaction

echo "✅ Migrations completed"
echo ""

# Step 9: Clear caches
echo "🧹 Clearing application caches..."
docker-compose exec -T app php artisan cache:clear
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

echo "✅ Caches cleared"
echo ""

# Step 10: Display container status
echo "📊 Container Status:"
docker-compose ps
echo ""

# Step 11: Display next steps
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✨ Deployment Complete!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📍 Your application is now running!"
echo ""
echo "🌐 Access your app at:"
echo "   http://$(hostname -I | awk '{print $1}')"
echo "   https://yourdomain.com (after SSL is configured)"
echo ""
echo "📝 Useful commands:"
echo "   docker-compose logs -f app        # View PHP logs"
echo "   docker-compose logs -f web        # View Nginx logs"
echo "   docker-compose exec app bash      # Access PHP container"
echo "   docker-compose exec mysql bash    # Access MySQL container"
echo ""
echo "🔒 Next steps:"
echo "   1. Configure SSL with Let's Encrypt (see DOCKER_DEPLOYMENT.md Step 6)"
echo "   2. Set up automatic backups (see DOCKER_DEPLOYMENT.md Step 9)"
echo "   3. Enable auto-restart (see DOCKER_DEPLOYMENT.md Step 10)"
echo ""
echo "📚 For detailed instructions, see: DOCKER_DEPLOYMENT.md"
echo ""
