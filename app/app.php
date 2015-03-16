<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=to_do');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../views'
    ));

// Loading initial pages

    $app->get('/', function() use ($app) {

        return $app['twig']->render('index.html.twig');
    });

    $app->get("/tasks", function() use ($app) {
       return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->get("/categories", function() use ($app) {
       return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });


// Using info from forms

    $app->post('/categories', function() use($app){
        $category = new Category($_POST['name']);
        $category->save();

        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    $app->get('/tasks', function() use ($app) {

        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->post("/tasks", function() use($app){
        $task = new Task($_POST['name']);
        $task->save();

        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->post("/delete_tasks", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete_categories", function() use ($app) {
        Category::deleteAll();
        return $app['twig']->render('index.html.twig');
    });


    return $app;

?>
