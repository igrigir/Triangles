<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/triangles' => [[['_route' => 'triangle_summary', '_controller' => 'App\\Controller\\TriangleController::getSummary'], null, ['GET' => 0], null, false, false, null]],
        '/triangles/all' => [[['_route' => 'get_all_triangles', '_controller' => 'App\\Controller\\TriangleController::getAllTriangles'], null, ['GET' => 0], null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/triangle/(?'
                    .'|([^/]++)/([^/]++)/([^/]++)(*:46)'
                    .'|id/([^/]++)(*:64)'
                    .'|([^/]++)/edit(*:84)'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:123)'
                    .'|wdt/([^/]++)(*:143)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:189)'
                            .'|router(*:203)'
                            .'|exception(?'
                                .'|(*:223)'
                                .'|\\.css(*:236)'
                            .')'
                        .')'
                        .'|(*:246)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        46 => [[['_route' => 'add_triangle', '_controller' => 'App\\Controller\\TriangleController::addTriangle'], ['a', 'b', 'c'], ['POST' => 0], null, false, true, null]],
        64 => [[['_route' => 'get_triangle_by_id', '_controller' => 'App\\Controller\\TriangleController::getTriangleById'], ['id'], ['GET' => 0], null, false, true, null]],
        84 => [[['_route' => 'edit_triangle', '_controller' => 'App\\Controller\\TriangleController::editTriangle'], ['id'], ['POST' => 0], null, false, false, null]],
        123 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        143 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        189 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        203 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        223 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        236 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        246 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
