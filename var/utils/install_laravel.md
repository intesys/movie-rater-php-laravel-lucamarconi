bin/bash

composer create-project laravel/laravel my-project

cd my-project

shopt -s dotglob
mv * ../
shopt -u dotglob
cd ..
rm -rf my-project

copy .env.example

adjust timezone and other configs in config/app.php


adjust .gitignore
