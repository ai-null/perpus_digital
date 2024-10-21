<h1 align="center">Perpus Digital</h1>

<p align="center">
    E-Library built with Laravel 11 and bootstrap 5.
    <br/>The design link can be accessed <a href="https://www.figma.com/design/OwJoPM00Iyg0LKcgKhCaYA/KP-SMAM7?node-id=0-1&t=fr9arhrDUSqdgzYt-0">here</a>
</p>

<h3>Users</h3>
<p align="center">
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/index.png" width="30%" />
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/contacts.png" width="30%" />
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/login.png" width="30%" />
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/register.png" width="30%" />
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/dashboard.png" width="30%" />
    <img src="https://raw.githubusercontent.com/ai-null/perpus_digital/master/public/img/demo/book_detail.png" width="30%" />
</p>

<h3>Admins</h3>
<p align="center">
    <img width="30%" alt="image" src="https://github.com/user-attachments/assets/0278e453-9b93-4d38-b850-fe2659fc4647" />
    <img width="30%" alt="image" src="https://github.com/user-attachments/assets/f70ff3c0-5543-4793-8ba4-241c9142623d" />
    <img width="30%" alt="image" src="https://github.com/user-attachments/assets/ab3eb78c-b844-4c51-833b-f8b2e846b499" />
    <img width="30%" alt="image" src="https://github.com/user-attachments/assets/fced4827-0afc-435c-8b16-7373f61bf7b7" />
</p>

<br />

## Features
- Users :
    - book catalog dashboard
    - book borrowing transaction
    - search & filter book by its categories
- Admins :
    - analytics for book transaction
    - book reservation transaction management
    - categories management
    - books management

<br/>

## Prerequisite
* Laravel 11
* PHP 8.2+
* MySQL 8.3+
* AWS S3 Configuration

<br/>

## How to build
1. Git clone this repo
   
   ```$ git clone https://github.com/ai-null/perpus_digital.git```
2. Run composer install to install dependencies
   
   ```$ composer install```
3. Run migrate
   
   ```$ php artisan migrate:fresh```
4. (Optional) run seeder
   
   ```$ php artisan db:seed```
5. Run the program

   ```$ php artisan serve```


<br/>


## Depedencies
| Library | Description |
| ------  | ----------- |
| [FakerPHP](https://fakerphp.org/) | for database seeding |
| [FileSystem AWS S3](https://packagist.org/packages/league/flysystem-aws-s3-v3) | for storing image assets |

<br/>

## License
```
MIT License

Copyright (c) 2020 Ainul

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
