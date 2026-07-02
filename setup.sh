#!/bin/bash

# 1. Configurar el archivo .env si no existe
if [ ! -f .env ]; then
    echo "Copiando .env.example a .env..."
    cp .env.example .env
fi

# 2. Construir los contenedores
echo "Construyendo contenedores..."
docker compose build laravel.test

# 3. Levantar los servicios
echo "Levantando servicios..."
docker compose up -d

# 4. Instalar dependencias
echo "Instalando dependencias de Composer..."
docker compose run --rm laravel.test composer install --ignore-platform-reqs

# 5. Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos inicie..."
sleep 15

# 6. Generar la key y migrar la base de datos
echo "Configurando la base de datos..."
docker compose exec laravel.test php artisan key:generate
docker compose exec laravel.test php artisan migrate

echo "¡Proyecto listo! Tu entorno está funcionando en http://localhost"