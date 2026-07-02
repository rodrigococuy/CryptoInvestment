# 🚀 CryptoTracker: Proyecto de Examen

Una aplicación para visualizar el mercado de criptomonedas en tiempo real utilizando la API de CoinMarketCap.

## 🛠️ Tecnologías
- **Framework:** Laravel 11
- **Lenguaje:** PHP 8.5.7
- **Base de Datos:** MySQL (gestionado con Docker Sail)
- **Servicios:** Redis, Meilisearch
- **Fuente de datos:** API de CoinMarketCap

## 📋 Instrucciones de instalación

Sigue estos pasos para poner el proyecto en marcha en tu máquina local:

1. **Clonar el repositorio:**
   bash
   git clone [https://github.com/rodrigococuy/CryptoInvestment](https://github.com/rodrigococuy/CryptoInvestment)
   cd CryptoInvestment



2. ⚙️ Configurar el Entorno
Copia el archivo de ejemplo para crear tu configuración personalizada:

Bash
cp .env.example .env

## 🚀 Configuración Rápida
El proyecto viene configurado para funcionar de inmediato. Si deseas ver datos reales en vivo:

1. **Llave API:** El sistema ya incluye una configuración de prueba. 
COINMARKETCAP_API_KEY=eb0f46645f834894a980ca86ce338c0a
Si los datos no cargan, obtén tu propia llave gratuita en [pro.coinmarketcap.com](https://pro.coinmarketcap.com/) y colócala en tu archivo `.env` en la línea:


Iniciar los contenedores:
Levanta el entorno de Docker (asegúrate de tener Docker Desktop abierto):

Para que el contenedor tenga un nombre "amigable" y fácil de identificar en Docker Desktop (en lugar de nombres genéricos como proyecto-examen-laravel-1), puedes definirlo explícitamente en tu archivo docker-compose.yml.

1. Cómo asignar el nombre amigable
Abre tu archivo docker-compose.yml (que está en la raíz de tu proyecto) y busca la sección services -> laravel.test. Agrega la propiedad container_name así:


services:
    laravel.test:
        container_name: cryptotracker-app  # <--- ESTE ES EL NOMBRE AMIGABLE
        build:
            context: ./vendor/laravel/sail/runtimes/8.4
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: sail-8.4/app
        # ... resto de la configuración

        Al hacer este cambio, tu contenedor siempre aparecerá en Docker Desktop como cryptotracker-app.


        🚀 Iniciar los contenedores:
Levanta el entorno de Docker (asegúrate de tener Docker Desktop abierto):

Bash
./vendor/bin/sail up -d
(Espera unos segundos a que MySQL termine de arrancar).

3. ¿Por qué es buena idea esto?
Al asignarle un nombre fijo (container_name), facilitas mucho la vida cuando necesites ejecutar comandos rápidos sin tener que adivinar qué nombre le puso Docker automáticamente.

Por ejemplo, si alguna vez necesitas entrar a la terminal del contenedor directamente, ya no tendrás que buscar el nombre, simplemente escribirías:
docker exec -it cryptotracker-app bash



Preparar la base de datos:
Ejecuta las migraciones y carga los datos iniciales:

Bash
./vendor/bin/sail artisan migrate --seed
¡Acceder al proyecto!
Abre tu navegador y entra en: http://localhost

🛑 Notas importantes de mantenimiento
Apagado seguro: Para detener los servicios cuando termines de trabajar sin perder tus datos:

Bash
./vendor/bin/sail down
No usar -v: Evita ejecutar ./vendor/bin/sail down -v, ya que esto borrará permanentemente la base de datos de tu contenedor.

👤 Autor
Rodrigo Cocuy Sanchez