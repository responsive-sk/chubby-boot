.
├── bin
│   └── console -> ../src/console.php
├── config
│   ├── dev.php
│   ├── phpunit.php
│   └── prod.php
├── database
│   └── database.sqlite
├── frontend
│   ├── src
│   │   ├── components
│   │   │   └── layout
│   │   │       ├── Header.svelte
│   │   │       └── Hero.svelte
│   │   ├── core
│   │   │   └── ComponentRegistry.ts
│   │   ├── pages
│   │   │   └── Index.svelte
│   │   ├── stores
│   │   ├── styles
│   │   │   └── app.css
│   │   ├── types
│   │   ├── utils
│   │   └── app.ts
│   ├── package.json
│   ├── pnpm-lock.yaml
│   ├── svelte.config.js
│   ├── tsconfig.json
│   └── vite.config.js
├── .qodo
├── src
│   ├── Collection
│   │   ├── AbstractCollection.php
│   │   ├── ArticleCollection.php
│   │   ├── CollectionInterface.php
│   │   └── PetCollection.php
│   ├── Dto
│   │   ├── Collection
│   │   │   ├── ArticleCollectionFilters.php
│   │   │   ├── ArticleCollectionRequest.php
│   │   │   ├── ArticleCollectionResponse.php
│   │   │   ├── ArticleCollectionSort.php
│   │   │   ├── CollectionRequestInterface.php
│   │   │   ├── PetCollectionFilters.php
│   │   │   ├── PetCollectionRequest.php
│   │   │   ├── PetCollectionResponse.php
│   │   │   └── PetCollectionSort.php
│   │   └── Model
│   │       ├── ArticleRequest.php
│   │       ├── ArticleResponse.php
│   │       ├── CategoryRequest.php
│   │       ├── CategoryResponse.php
│   │       ├── ModelRequestInterface.php
│   │       ├── PetRequest.php
│   │       ├── PetResponse.php
│   │       ├── VaccinationRequest.php
│   │       └── VaccinationResponse.php
│   ├── Middleware
│   │   └── ApiExceptionMiddleware.php
│   ├── Model
│   │   ├── Article.php
│   │   ├── Category.php
│   │   ├── ModelInterface.php
│   │   ├── Pet.php
│   │   └── Vaccination.php
│   ├── Orm
│   │   ├── ArticleMapping.php
│   │   ├── CategoryMapping.php
│   │   ├── PetMapping.php
│   │   └── VaccinationMapping.php
│   ├── Parsing
│   │   ├── ArticleParsing.php
│   │   ├── ParsingInterface.php
│   │   └── PetParsing.php
│   ├── Repository
│   │   ├── ArticleRepository.php
│   │   ├── PetRepository.php
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
│   │   │   ├── ParserFactory.php
│   │   │   └── PetParsingFactory.php
│   │   ├── Repository
│   │   │   ├── ArticleRepositoryFactory.php
│   │   │   └── PetRepositoryFactory.php
│   │   └── RequestHandler
│   │       ├── Api
│   │       │   └── Crud
│   │       │       ├── ArticleCreateRequestHandlerFactory.php
│   │       │       ├── ArticleDeleteRequestHandlerFactory.php
│   │       │       ├── ArticleListRequestHandlerFactory.php
│   │       │       ├── ArticleReadRequestHandlerFactory.php
│   │       │       ├── ArticleUpdateRequestHandlerFactory.php
│   │       │       ├── PetCreateRequestHandlerFactory.php
│   │       │       ├── PetDeleteRequestHandlerFactory.php
│   │       │       ├── PetListRequestHandlerFactory.php
│   │       │       ├── PetReadRequestHandlerFactory.php
│   │       │       └── PetUpdateRequestHandlerFactory.php
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
│   │   ├── component-demo.html.twig
│   │   ├── cool-index.html.twig
│   │   ├── hero.html.twig
│   │   ├── home-page.html.twig
│   │   ├── home-page.twig
│   │   ├── products.html.twig
│   │   └── test-frontend.html.twig
│   ├── error
│   │   ├── 404.html.twig
│   │   ├── 404.twig
│   │   ├── error.html.twig
│   │   └── error.twig
│   ├── layout
│   │   ├── default.html.twig
│   │   └── default.twig
│   └── partials
│       └── components.twig
├── tests
│   ├── Helper
│   │   └── AssertHelper.php
│   ├── Integration
│   │   ├── AbstractIntegrationTestCase.php
│   │   ├── CorsControllerTest.php
│   │   ├── OpenapiRequestHandlerTest.php
│   │   ├── PetCrudRequestHandlerTest.php
│   │   └── PingRequestHandlerTest.php
│   ├── Unit
│   │   ├── Collection
│   │   │   ├── CollectionTest.php
│   │   │   └── PetCollectionTest.php
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
│   │   │   └── PetParsingTest.php
│   │   ├── Repository
│   │   │   └── PetRepositoryTest.php
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
│   │       │   ├── ParserFactoryTest.php
│   │       │   └── PetParsingFactoryTest.php
│   │       ├── Repository
│   │       │   └── PetRepositoryFactoryTest.php
│   │       └── RequestHandler
│   │           ├── Api
│   │           │   └── Crud
│   │           │       ├── PetCreateRequestHandlerFactoryTest.php
│   │           │       ├── PetDeleteRequestHandlerFactoryTest.php
│   │           │       ├── PetListRequestHandlerFactoryTest.php
│   │           │       ├── PetReadRequestHandlerFactoryTest.php
│   │           │       └── PetUpdateRequestHandlerFactoryTest.php
│   │           ├── OpenapiRequestHandlerFactoryTest.php
│   │           └── PingRequestHandlerFactoryTest.php
│   └── PhpServerExtension.php
├── var
│   ├── cache
│   │   ├── dev
│   │   └── phpunit
│   ├── log
│   │   └── dev.log
│   └── articlestore.db
├── composer.json
├── composer.lock
├── DEPLOYMENT.md
├── directory_tree.md
├── docker-compose.ci.yml
├── docker-compose.yml
├── .dockerignore
├── .gitignore
├── infection.json
├── LICENSE
├── openapi.yml
├── .phpactor.json
├── .php-cs-fixer.php
├── phpstan.neon
├── phpunit.integration.xml
├── phpunit.xml
├── README.md
├── sonar-project.properties
└── TODO.md

80 directories, 188 files
