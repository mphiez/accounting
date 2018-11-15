# Setup

Ikuti petunjuk ini untuk setup konfigurasi aplikasi sesuai tujuan deployment.

## Production

### Windows

1. Buka `cmd.exe` dengan elevated access (Run as Administrator).
2. Masuk ke direktori `application\Neuron\Application\Ncxtools\config\autoload`
3. Buat symbolic link dengan command: `mklink global.php global-production.php`.

### Linux/Mac

1. Masuk ke direktori `application/Neuron/Application/Ncxtools/config/autoload`
2. Buat symbolic link dengan command : `ln -s global-production.php global.php`.

## Development

### Windows

1. Buka `cmd.exe` dengan elevated access (Run as Administrator).
2. Masuk ke direktori `application\Neuron\Application\Ncxtools\config\autoload`
3. Buat symbolic link dengan command: `mklink global.php global-development.php`.

### Linux/Mac

1. Masuk ke direktori `application/Neuron/Application/Ncxtools/config/autoload`
2. Buat symbolic link dengan command : `ln -s global-development.php global.php`.