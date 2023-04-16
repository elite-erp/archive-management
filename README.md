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
  - [x] list (+search +pagination)
  - [x] details
    - [x] documents (+search)
  - [x] create
      - [x] support validation errors
  - [x] edit
    - [x] validation errors
    - [x] photo upload
    - [x] password change
  - [ ] disable (or remove if not associated with data)
- [ ] Categories
  - [x] list (+search +documents)
    - [x] grid view
    - [ ] list view
  - [x] details
    - [x] documents
  - [x] create
  - [x] edit
  - [ ] disable (or remove if not associated with data)
- [ ] Documents
  - [x] list (+search +pagination)
    - [ ] aside view
    - [x] grid view
  - [x] details
    - [x] print
    - [x] add attachments
    - [x] remove attachements
  - [x] create
  - [x] edit
  - [ ] disable (or remove if not associated with data)
- [x] Auth
  - [x] login
  - [x] logout
  - [x] profile
    - [x] documents (+search +pagination)
    - [x] change password or name
- [ ] CPanel
  - [ ] chart
  - [ ] register buttons
  - [ ] counters
- [ ] About Us
  - [ ] developers contact info


## components
- [x] input
    - [x] error
    - [x] type
    - [x] icons
    - [x] placeholder
    - [-] radio
    - [-] textarea
- [x] button
- [x] modal
- [x] flash message
- [x] pagination
- [x] icon
- [x] select

## API
- [?] users
  - [x] create
  - [x] find
  - [x] find one
  - [x] update
  - [?] delete (or archive)
- [ ] documents
  - [x] create
  - [x] find
  - [x] find one
  - [x] update
  - [?] delete (or archive)
- [ ] categories
  - [x] create
  - [x] find
  - [x] find one
  - [x] update
  - [?] delete (or archive)
- [x] attachements
  - [x] create
  - [x] delete (or archive)
- [ ] cpanel
  - [ ] chart
  - [ ] counters


## Sat Apr 15 12:34:15 AM CAT 2023
- [x] refactor document fetch with photo
- [x] search documents
- [x] soft deletes
- [x] flash messages
- [ ] cpanel
  - [ ] chart
  - [ ] counters
  - [ ] buttons
- [ ] documents
  - [ ] add attachment
  - [ ] remove attachment