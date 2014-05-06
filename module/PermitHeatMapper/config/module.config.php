<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    
    'doctrine' => array(
        'driver' => array(
          'application_entities' => array(
            'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => array(__DIR__ . '/../src/PermitHeatMapper/Entity')
          ),

          'orm_default' => array(
                'drivers' => array(
                    'PermitHeatMapper\Entity' => 'application_entities'
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'types' => array(
                    'geometry' => 'CrEOF\Spatial\DBAL\Types\GeometryType',
                    'polygon'  => 'CrEOF\Spatial\DBAL\Types\Geometry\PolygonType',
                    'point'    => 'CrEOF\Spatial\DBAL\Types\Geometry\PointType',
                ),
                'string_functions' => array(
                    'ST_Point'     => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STPoint',
                    'ST_Contains'  => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STContains',
                    'ST_SetSRID'   => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STSetSRID',
                    'ST_DWithin'   => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STDWithin',
                    'ST_MakePoint' => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STMakePoint',
                    'ST_AsGeoJSON' => 'CrEOF\Spatial\ORM\Query\AST\Functions\PostgreSql\STAsGeoJson',
                ),
                'proxy_dir' => 'daasfdasta/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            )
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'alt-viz' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/alt-viz',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Index',
                        'action'     => 'alt-viz',
                    ),
                ),
            ),
            'about' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/about',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Index',
                        'action'     => 'about',
                    ),
                ),
            ),
            'data' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/data',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Index',
                        'action'     => 'show-data',
                    ),
                ),
            ),
            'average-change' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/average-change',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Index',
                        'action'     => 'average-change',
                    ),
                ),
            ),
            
            'permit' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/permit',
                    'defaults' => array(
                        'controller' => 'PermitHeatMapper\Controller\Permit',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/permit-heat-mapper',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PermitHeatMapper\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $dbParams = array( 
                    'hostname' => 'tioga.jimsmiley.us',
                    'port'     => '5432',
                    'user'     => 'landi',
                    'password' => 'ApCFRDHvmWcxVdfjFZz0',
                    'database' => 'landi',
                );
                
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'pgsql:host=tioga.jimsmiley.us;port=5432;dbname=landi;user=landi;password=ApCFRDHvmWcxVdfjFZz0',
                    //'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => 'landi',
                    'username'  => 'landi',
                    'password'  => 'ApCFRDHvmWcxVdfjFZz0',
                    'hostname'  => 'tioga.jimsmiley.us',
                ));
                if (php_sapi_name() == 'cli') {
                    $logger = new Zend\Log\Logger();
                    // write queries profiling info to stdout in CLI mode
                    $writer = new Zend\Log\Writer\Stream('php://output');
                    $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                } else {
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                }
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                } else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            },
                    
            'entitymanager' => function($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_default');
                return $em; 
            },
            'PermitHeatMapper\Mapper\PermitMapper' => function($sm) {
                $em = $sm->get('entitymanager');
                return new \PermitHeatMapper\Mapper\PermitMapper($em);
            },
            'PermitHeatMapper\Mapper\CityLimitsMapper' => function($sm) {
                $em = $sm->get('entitymanager');
                return new \PermitHeatMapper\Mapper\CityLimitsMapper($em);
            },
            'PermitHeatMapper\Mapper\GridSquareMapper' => function($sm) {
                $em = $sm->get('entitymanager');
                return new \PermitHeatMapper\Mapper\GridSquareMapper($em);
            },
            'PermitHeatMapper\Mapper\NeighborhoodPermitCountMapper' => function($sm) {
                $em = $sm->get('entitymanager');
                return new \PermitHeatMapper\Mapper\NeighborhoodPermitCountMapper($em);
            },
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PermitHeatMapper\Controller\Index'         => 'PermitHeatMapper\Controller\IndexController',
            'PermitHeatMapper\Controller\Permit'        => 'PermitHeatMapper\Controller\PermitController',
            'PermitHeatMapper\Controller\NeighborhoodPermitCount'       => 'PermitHeatMapper\Controller\NeighborhoodPermitCountController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'permit-heat-mapper/index/index' => __DIR__ . '/../view/permit-heat-mapper/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
