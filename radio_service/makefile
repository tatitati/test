install:
	@printf "Installing composer dependencies......\n\n"
	@(cd app && php composer.phar install)
	@printf "Running tests......\n\n"
	@(cd app && php vendor/bin/phpunit)
	@printf "\n\nRunning site: http://my-docker.com/\n\n"
	@printf "Building and running containers......\n\n"
	@docker-compose up



