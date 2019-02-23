## Laravel Local Email System

**Local Email System** is a simple messaging system.

### Installation

-   `git clone https://github.com/parvez-git/Laravel-Local-Email-System.git`
-   `cd Local-Email-System-master`
-   `cp .env.example .env`
-   `php artisan key:generate`
-   Create a database and inform _.env_
-   `php artisan migrate --seed` to create and populate tables
-   `php artisan serve` to start the app on http://localhost:8000/


### Credentials

To test application the database is seeding with users :

-   Admin : email = admin@admin.com, password = 123456
-   User One : email = userone@user.com, password = 123456
-   User Two (blocked) : email = usertwo@user.com, password = 123456