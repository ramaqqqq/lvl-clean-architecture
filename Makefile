fmt:
	php artisan format

run:
	php artisan serve

storage.link:
	php artisan storage:link

model:
	php artisan make:model $(filter-out $@,$(MAKECMDGOALS)) -m

migrate.up:
	php artisan migrate

migrate.rollback:
	php artisan migrate:rollback

resource:
	php artisan make:resource $(filter-out $@,$(MAKECMDGOALS))

repo:
	@mkdir -p app/Repositories
	@printf "<?php\n\nnamespace App\Repositories;\n\nclass $(name)\n{\n    // Repository logic\n}\n" > app/Repositories/$(name).php
	@echo "Repository $(name) created successfully in app/Repositories/"

svc:
	@mkdir -p app/Services
	@printf "<?php\n\nnamespace App\Services;\n\nclass $(name)\n{\n    // Service logic\n}\n" > app/Services/$(name).php
	@echo "Service $(name) created successfully in app/Services/"

ctrl.:
	@mkdir -p app/Http/Controllers
	@printf "<?php\n\nnamespace App\Http\Controllers;\n\nuse Illuminate\Http\Request;\n\nclass $(name) extends Controller\n{\n    // Controller methods\n}\n" > app/Http/Controllers/$(name).php
	@echo "Controller $(name) created successfully in app/Http/Controllers/"

ctrl:
	php artisan make:controller $(filter-out $@,$(MAKECMDGOALS))

ctrl.i:
	php artisan make:controller $(filter-out $@,$(MAKECMDGOALS)) -i

ctrl.list:
	php artisan route:list

docs-update:
	rm -rf swagger/v1
	swag init -d ./app,./routes -o swagger/v1 --ot json,yaml --pd true

up:
	docker compose up -d

restart:
	docker compose restart

stop:
	docker compose stop

down:
	docker compose down

logs:
	docker compose logs -n 30 -f

pull.jwt:
	composer require tymon/jwt-auth:2.1.1

publish.jwt:
	php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

secretkey.jwt:
	php artisan jwt:secret

exception.jwt:
	@touch .env
	@sed -i '/^JWT_SHOW_BLACKLIST_EXCEPTION=/d' .env
	@echo "JWT_SHOW_BLACKLIST_EXCEPTION=true" >> .env

install.api:
	php artisan install:api

