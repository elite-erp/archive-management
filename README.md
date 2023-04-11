# Erp Archive

## Install
1- install dependances
```bash
composer install
npm i -g pnpm
pnpm i
```
2- copy env file
```bash
cp .env.example .env
```
3- setup database as needed (mysql or postgresql)

## Update
```bash
composer update
pnpm i
```

## Start Development
```bash
php artisan serve
pnpm dev
```

## Features
- [ ] Users
  - [?] list (+search +pagination)
      - search is not finished
  - [?] details
    - [ ] documents list is not finished
  - [x] create
      - [x] support validation errors
  - [x] edit
    - [x] validation errors
    - [x] photo upload
    - [x] password change
  - [ ] disable (or remove if not associated with data)
- [ ] Categories
  - [ ] list (+search +documents)
    - [ ] grid view
    - [ ] list view
  - [ ] details
    - [ ] documents
  - [ ] create
  - [ ] edit
  - [ ] disable (or remove if not associated with data)
- [ ] Documents
  - [ ] list (+search +pagination)
    - [ ] aside view
    - [ ] grid view
  - [ ] details
    - [ ] print
    - [ ] add attachments
    - [ ] remove attachements
  - [ ] create
  - [ ] edit
  - [ ] disable (or remove if not associated with data)
- [ ] Auth
  - [x] login
  - [ ] logout
  - [ ] profile
    - [ ] documents (+ search +pagination)
    - [ ] change password or name
- [ ] CPanel
  - [ ] chart
  - [ ] register buttons
  - [ ] counters
- [ ] About Us
  - [ ] developers contact info


## components
- [?] input
    - [x] error
    - [x] type
    - [x] icons
    - [x] placeholder
    - [ ] select
    - [ ] radio
    - [ ] textarea
- [x] button
- [x] modal
- [-] flash message


## API
- [?] users
  - [x] create
  - [x] find
  - [x] find one
  - [x] update
  - [ #] delete (or archive)
- [ ] documents
  - [# ] create
  - [ #] find
  - [ #] find one
  - [ #] update
  - [ #] delete (or archive)
- [ ] categories
  - [ #] create
  - [ #] find
  - [ #] find one
  - [ #] update
  - [# ] delete (or archive)
- [ ] attachements
  - [ ] create
  - [ ] find
  - [ ] find one
  - [ ] update
  - [ ] delete (or archive)
- [ ] cpanel
  - [ ] chart
  - [ ] counters