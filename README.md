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
  - [ ] list (+search +pagination)
  - [ ] details
  - [ ] create
  - [ ] edit
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
  - [ ] login
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
- [ ] input (+radio +textarea +select +error support)
- [ ] button
- [ ] modal
- [ ] flash message


## API
- [ ] users
  - [ ] create
  - [ ] find
  - [ ] find one
  - [ ] update
  - [ ] delete (or archive)
- [ ] documents
  - [ ] create
  - [ ] find
  - [ ] find one
  - [ ] update
  - [ ] delete (or archive)
- [ ] categories
  - [ ] create
  - [ ] find
  - [ ] find one
  - [ ] update
  - [ ] delete (or archive)
- [ ] attachements
  - [ ] create
  - [ ] find
  - [ ] find one
  - [ ] update
  - [ ] delete (or archive)
- [ ] cpanel
  - [ ] chart
  - [ ] counters