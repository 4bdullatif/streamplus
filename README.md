## Prerequisites
- Docker installed on your machine. [Docker Installation Guide](https://docs.docker.com/get-docker/)
- Docker Compose installed. [Docker Compose Installation Guide](https://docs.docker.com/compose/install/)


## Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/4bdullatif/streamplus.git
cd streamplus
```

### 2. Set Up Environment Variables
Create a .env file based on the example .env.example file.
```bash
cp .env.example .env
```
### 3. Edit the .env file to configure the database connection:

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=streamplus
DB_USERNAME=streamplus_user
DB_PASSWORD=streamplus_password
```

### 4. Build and Run Docker Containers
```bash
docker-compose up --build
```

### 4. Run The Migrations & Generate app secret
```bash
docker exec -it streamplus-app php artisan key:generate
docker exec -it streamplus-app php artisan migrate
```

### 5. Run the app
```bash
http://localhost:8000
```
