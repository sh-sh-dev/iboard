# iBoard
Simple sale managing system that mode for @iBoard.

Includes sale insert, list view, statistics and etc.

### Installation

```bash
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate (after configuration)
```

#### Configuration

the environment variables can be found at `.env.example`, copy these to `.env` and fill the variables according your needs.

Note: Registration can be enabled by setting `APP_REGISTER_ENABLED` to true at the setup process, do not forget to disable it after.
