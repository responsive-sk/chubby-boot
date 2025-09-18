# Refactor Pet CRUD to Article CRUD

## Overview
Refactor the existing Pet CRUD system to use Article instead. This involves changing routes, request handlers, repositories, parsing, service factories, and mappings from Pet to Article. The Article model and related components are already created.

## Tasks
- [ ] Update routes in RoutesByNameFactory.php from /api/pets to /api/articles
- [ ] Create ArticleParsing.php similar to PetParsing.php
- [ ] Create Article DTOs (ArticleRequest.php, ArticleResponse.php) similar to Pet DTOs
- [ ] Update service factories to use Article instead of Pet
- [ ] Update request handlers to use Article
- [ ] Update tests to use Article
- [ ] Ensure database tables are created for articles and categories
- [ ] Test endpoints: / (ping), /api/articles (CRUD)

## Acceptance Criteria
- App starts without errors
- GET / returns ping JSON
- /api/articles endpoints functional with SQLite
- New tables created for Article/Category
