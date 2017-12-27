# Development Guide

This guide is intended as a starting point for contributing to [codelouisville.org](https://codelouisville.org). If you have any questions, please point them to `@speercy` or `@brian` on the CodeLouisville Slack channel.

**Due to its dependence upon Laravel Valet, this guide is written primarily for Mac users.**

## Setup

You'll need the following tools installed and configured on your system before you can begin development:

* [Homebrew](https://brew.sh/)
* [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* [Laravel Valet](https://laravel.com/docs/5.5/valet#installation)

## Code

##### Clone the repository from GitHub

Start up your terminal and navigated to your desired location, then run:

    git clone git@github.com:CodeLouisville/code-louisville-org.git

##### Install required components

`cd` into the newly created code-louisville-org directory and run:

    composer install

##### Create .env file

    touch .env

Check with `@brian` or `@speercy` on Slack to get the contents of the `.env` file.

## Database

#### Launch MySQL and create a new database

    mysql -uroot -p

*Note: There is no default root password for MySQL on a Mac, so if you haven't set one yourself, you can just hit enter when you are prompted for a password.*

    create database codelouisville; exit;

##### Run migrations and seed database

    php artisan db:up

*Note: run this command every time you sit down to develop, that way you have the most up-to-date data in your local application.*

## Start contributing

You should now have the code and data needed to start working on the website.

##### Create and checkout new branch

    git checkout -b your_branch_name

##### Change things

After you've made your desired changes, add them to your staging area:

    git add .

...commit them:

    git commit -m "Your commit message"

...and push them:

    git push -u origin your_branch_name

*Note: you only have to include the* `-u origin your_branch_name` *part the first time. After that you can simply* `git push`.

##### When ready, create pull request

Login to GitHub and find the branch you created. Click the "New Pull Request" button, give a description, and submit!
