I. Installation

1. Instal docker and docker-compose, on ubuntu `apt-get install docker docker-compose`
2. Instal git, on ubuntu `apt-get install git`
3. `git clone https://github.com/skrokbogumil/m-r-symfony.git`
4. enter project dir, go to docker directory `cd docker` run commands `docker-compose build` and `docker-compose up -d`
5. Return to main project directory, enter `cd ../` and run `bin/install.sh`
6. go to url `http://localhost/`


II. Project structure
```
├── assets
├── bin
├── config
│   ├── packages
│   └── routes
├── docker
│   ├── database
│   ├── nginx
│   └── php
├── migrations
├── public
│   └── bundles
├── src
│   ├── Controller
│   ├── DataFixtures
│   ├── Entity
│   ├── Form
│   ├── Repository
│   ├── Security
│   └── Service
├── templates
│   ├── bundles
│   ├── home
│   ├── registration
│   └── security
├── tests
├── translations
├── var
│   ├── cache
│   └── log
└── vendor
```