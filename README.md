### PHP - Todo - MVC

#### Prerequisites
* Docker and docker-compos

#### Run docker

```
docker run --rm -v $(pwd):/app composer install
```

#### Create database

You need to exec to mysql container and run below command for create table

```
// harorax476@yutongdt.com
create table tasks
(
	id int auto_increment primary key,
	name varchar(255) null,
	start_date date null,
	end_date date null,
	status enum('PLANNING', 'DOING', 'COMPLETE') default 'PLANNING' null,
	created_at timestamp default now() null,
	updated_at timestamp default now() null
);
```

#### Run app

```
docker-compose up -d
```