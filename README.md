<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About This Project

This project build for Job Apply to PeerPower only.
This Prooject build with PHP, Laravel framework, Vue framework and Database MySQL

After clone this project
Run
- ```cd PeerPowerTest```
- ```composer install```
- ```npm install```
- ```mv .env.example .env```
- ```php artisan key:generate``` => for generate new app_key
- set up MySQL in .env file for Database set up
- ```php artisan cache:clear ```
- ```php artisan config:clear```
- ```php artisan storage:link```
- in your local computer or docker create database name "peerpowertest" or if you already have database change it in the .env file if you prefer to use that
- ```php artisan migrate``` => to create table
- ```npm run dev``` or ```npm run build``` or ```npm run watch```
- ```php artisan serve``` => for run server 

