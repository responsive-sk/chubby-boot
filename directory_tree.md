.
├── bin
│   ├── console -> ../src/console.php
│   ├── insert-test-article.php
│   └── insert-test-data.php
├── config
│   ├── routes
│   │   ├── api.php
│   │   └── web.php
│   ├── container.php
│   ├── container_simple.php
│   ├── dev.php
│   ├── phpunit.php
│   ├── prod.php
│   └── routes.php
├── database
│   └── database.sqlite
├── frontend
│   ├── src
│   │   ├── components
│   │   │   ├── islands
│   │   │   │   ├── HeaderActions.svelte
│   │   │   │   ├── HeroOverlay.svelte
│   │   │   │   ├── Hero.svelte
│   │   │   │   ├── Logo.svelte
│   │   │   │   ├── MobileMenu.svelte
│   │   │   │   ├── PageLoader.svelte
│   │   │   │   └── SearchModal.svelte
│   │   │   ├── layout
│   │   │   ├── sections
│   │   │   ├── ui
│   │   │   │   ├── ArticleCard.svelte
│   │   │   │   ├── ArticleDetail.svelte
│   │   │   │   ├── Footer.svelte
│   │   │   │   ├── HeaderActions.svelte
│   │   │   │   ├── HeaderNew.svelte
│   │   │   │   ├── HeaderNew.svelteZAL
│   │   │   │   ├── Header.svelte
│   │   │   │   ├── Hero.svelte
│   │   │   │   ├── Navigation.svelte
│   │   │   │   ├── Nav.svelte
│   │   │   │   ├── SearchForm.svelte
│   │   │   │   └── TailwindHero.svelte
│   │   │   └── index.ts
│   │   ├── composables
│   │   │   └── index.ts
│   │   ├── core
│   │   │   └── ComponentRegistry.ts
│   │   ├── stores
│   │   │   ├── app.store.ts
│   │   │   ├── cart.store.ts
│   │   │   ├── index.ts
│   │   │   ├── ui.store.ts
│   │   │   └── user.store.ts
│   │   ├── styles
│   │   │   ├── app.css
│   │   │   └── global.css
│   │   ├── types
│   │   │   ├── app.d.ts
│   │   │   ├── global.d.ts
│   │   │   ├── htmx.d.ts
│   │   │   ├── ui.ts
│   │   │   └── vite-env.d.ts
│   │   ├── utils
│   │   │   ├── api.ts
│   │   │   ├── constants.ts
│   │   │   ├── formatters.ts
│   │   │   ├── htmx.utils.ts
│   │   │   ├── index.ts
│   │   │   └── validation.ts
│   │   └── app.ts
│   ├── package.json
│   ├── pnpm-lock.yaml
│   ├── svelte.config.js
│   ├── tsconfig.json
│   └── vite.config.js
├── src
│   ├── Collection
│   │   ├── AbstractCollection.php
│   │   ├── ArticleCollection.php
│   │   └── CollectionInterface.php
│   ├── Dto
│   │   ├── Collection
│   │   │   ├── ArticleCollectionFilters.php
│   │   │   ├── ArticleCollectionRequest.php
│   │   │   ├── ArticleCollectionResponse.php
│   │   │   ├── ArticleCollectionSort.php
│   │   │   └── CollectionRequestInterface.php
│   │   └── Model
│   │       ├── ArticleRequest.php
│   │       ├── ArticleResponse.php
│   │       ├── CategoryRequest.php
│   │       ├── CategoryResponse.php
│   │       └── ModelRequestInterface.php
│   ├── Middleware
│   │   └── ApiExceptionMiddleware.php
│   ├── Model
│   │   ├── Article.php
│   │   ├── Category.php
│   │   └── ModelInterface.php
│   ├── Orm
│   │   ├── ArticleMapping.php
│   │   └── CategoryMapping.php
│   ├── Parsing
│   │   ├── ArticleParsing.php
│   │   └── ParsingInterface.php
│   ├── Repository
│   │   ├── ArticleRepository.php
│   │   └── RepositoryInterface.php
│   ├── RequestHandler
│   │   ├── Api
│   │   │   └── Crud
│   │   │       ├── CreateRequestHandler.php
│   │   │       ├── DeleteRequestHandler.php
│   │   │       ├── ListRequestHandler.php
│   │   │       ├── ReadRequestHandler.php
│   │   │       └── UpdateRequestHandler.php
│   │   ├── ArticleListHtmlRequestHandler.php
│   │   ├── HomePageRequestHandler.php
│   │   ├── OpenapiRequestHandler.php
│   │   └── PingRequestHandler.php
│   ├── ServiceFactory
│   │   ├── Command
│   │   │   └── CommandsFactory.php
│   │   ├── DecodeEncode
│   │   │   ├── TypeDecodersFactory.php
│   │   │   └── TypeEncodersFactory.php
│   │   ├── Doctrine
│   │   │   └── EntityManagerFactory.php
│   │   ├── Framework
│   │   │   ├── ExceptionMiddlewareFactory.php
│   │   │   ├── MiddlewaresFactory.php
│   │   │   ├── RouteMatcherFactory.php
│   │   │   ├── RouteMatcherMiddlewareFactory.php
│   │   │   ├── RoutesByNameFactory.php
│   │   │   └── UrlGeneratorFactory.php
│   │   ├── Http
│   │   │   ├── ResponseFactoryFactory.php
│   │   │   └── StreamFactoryFactory.php
│   │   ├── Logger
│   │   │   └── LoggerFactory.php
│   │   ├── Middleware
│   │   │   └── ApiExceptionMiddlewareFactory.php
│   │   ├── Negotiation
│   │   │   ├── AcceptNegotiatorSupportedMediaTypesFactory.php
│   │   │   └── ContentTypeNegotiatorSupportedMediaTypesFactory.php
│   │   ├── Parsing
│   │   │   ├── ArticleParsingFactory.php
│   │   │   └── ParserFactory.php
│   │   ├── Repository
│   │   │   └── ArticleRepositoryFactory.php
│   │   └── RequestHandler
│   │       ├── Api
│   │       │   └── Crud
│   │       │       ├── ArticleCreateRequestHandlerFactory.php
│   │       │       ├── ArticleDeleteRequestHandlerFactory.php
│   │       │       ├── ArticleListRequestHandlerFactory.php
│   │       │       ├── ArticleReadRequestHandlerFactory.php
│   │       │       └── ArticleUpdateRequestHandlerFactory.php
│   │       ├── ArticleListHtmlRequestHandlerFactory.php
│   │       ├── HomePageRequestHandlerFactory.php
│   │       ├── OpenapiRequestHandlerFactory.php
│   │       └── PingRequestHandlerFactory.php
│   ├── console.php
│   ├── container.php
│   ├── Seeder.php
│   └── web.php
├── templates
│   ├── app
│   │   └── home-page.html.twig
│   ├── error
│   │   ├── 404.html.twig
│   │   ├── 404.twig
│   │   ├── error.html.twig
│   │   └── error.twig
│   ├── layout
│   │   └── default.html.twig
│   └── partials
│       ├── articles-list.html.twig
│       └── components.twig
├── tests
│   ├── Helper
│   │   └── AssertHelper.php
│   ├── Integration
│   │   ├── AbstractIntegrationTestCase.php
│   │   ├── ArticleCrudRequestHandlerTest.php
│   │   ├── CorsControllerTest.php
│   │   ├── OpenapiRequestHandlerTest.php
│   │   └── PingRequestHandlerTest.php
│   ├── Unit
│   │   ├── Collection
│   │   │   ├── ArticleCollectionTest.php
│   │   │   └── CollectionTest.php
│   │   ├── Dto
│   │   │   ├── Collection
│   │   │   │   ├── PetCollectionRequestTest.php
│   │   │   │   └── PetCollectionResponseTest.php
│   │   │   └── Model
│   │   │       ├── PetRequestTest.php
│   │   │       └── PetResponseTest.php
│   │   ├── Middleware
│   │   │   └── ApiExceptionMiddlewareTest.php
│   │   ├── Model
│   │   │   ├── PetTest.php
│   │   │   └── VaccinationTest.php
│   │   ├── Orm
│   │   │   ├── PetMappingTest.php
│   │   │   └── VaccinationMappingTest.php
│   │   ├── Parsing
│   │   │   └── ArticleParsingTest.php
│   │   ├── Repository
│   │   │   └── ArticleRepositoryTest.php
│   │   ├── RequestHandler
│   │   │   ├── Api
│   │   │   │   └── Crud
│   │   │   │       ├── CreateRequestHandlerTest.php
│   │   │   │       ├── DeleteRequestHandlerTest.php
│   │   │   │       ├── ListRequestHandlerTest.php
│   │   │   │       ├── ReadRequestHandlerTest.php
│   │   │   │       └── UpdateRequestHandlerTest.php
│   │   │   ├── OpenapiRequestHandlerTest.php
│   │   │   └── PingRequestHandlerTest.php
│   │   └── ServiceFactory
│   │       ├── Command
│   │       │   └── CommandsFactoryTest.php
│   │       ├── DecodeEncode
│   │       │   ├── TypeDecodersFactoryTest.php
│   │       │   └── TypeEncodersFactoryTest.php
│   │       ├── Framework
│   │       │   ├── ExceptionMiddlewareFactoryTest.php
│   │       │   ├── MiddlewaresFactoryTest.php
│   │       │   ├── RouteMatcherFactoryTest.php
│   │       │   ├── RouteMatcherMiddlewareFactoryTest.php
│   │       │   ├── RoutesByNameFactoryTest.php
│   │       │   └── UrlGeneratorFactoryTest.php
│   │       ├── Http
│   │       │   ├── ResponseFactoryFactoryTest.php
│   │       │   └── StreamFactoryFactoryTest.php
│   │       ├── Logger
│   │       │   └── LoggerFactoryTest.php
│   │       ├── Middleware
│   │       │   └── ApiExceptionMiddlewareFactoryTest.php
│   │       ├── Negotiation
│   │       │   ├── AcceptNegotiatorSupportedMediaTypesFactoryTest.php
│   │       │   └── ContentTypeNegotiatorSupportedMediaTypesFactoryTest.php
│   │       ├── Parsing
│   │       │   ├── ArticleParsingFactoryTest.php
│   │       │   └── ParserFactoryTest.php
│   │       ├── Repository
│   │       │   └── ArticleRepositoryFactoryTest.php
│   │       └── RequestHandler
│   │           ├── Api
│   │           │   └── Crud
│   │           │       ├── ArticleCreateRequestHandlerFactoryTest.php
│   │           │       ├── ArticleDeleteRequestHandlerFactoryTest.php
│   │           │       ├── ArticleListRequestHandlerFactoryTest.php
│   │           │       ├── ArticleReadRequestHandlerFactoryTest.php
│   │           │       └── ArticleUpdateRequestHandlerFactoryTest.php
│   │           ├── OpenapiRequestHandlerFactoryTest.php
│   │           └── PingRequestHandlerFactoryTest.php
│   └── PhpServerExtension.php
├── var
│   ├── cache
│   │   └── doctrine
│   │       └── orm
│   │           └── proxies
│   │               └── __CG__AppModelCategory.php
│   ├── log
│   │   └── log
│   └── articlestore.db
├── composer.json
├── composer.lock
├── debug_routematcher.php
├── debug_routes.php
├── DEPLOYMENT.md
├── directory_tree.md
├── docker-compose.ci.yml
├── docker-compose.yml
├── .dockerignore
├── find_routes.php
├── .gitignore
├── infection.json
├── LICENSE
├── openapi.yml
├── petstore.tar
├── .phpactor.json
├── .php-cs-fixer.php
├── phpstan.neon
├── phpunit.integration.xml
├── phpunit.xml
├── README.md
├── sonar-project.properties
├── test-factory.php
└── TODO.md

85 directories, 209 files
