<?php

$app->get('/',function ($request, $response, $args) {

    $repository = $this->get('repository.user');

    $user_id = mt_rand(1,1000000);

    $result = $repository->findByID($user_id);

    return $this->view->render($response,'chapter1.twig',
        [
        'user' => $result->name
        ]);
});

$app->get('/data_post_sample',function ($request, $response, $args) {
    return $this->view->render($response,'data_post_sample.twig',[url => "/data_post_sample"]);
});

$app->post('/data_post_sample',function($request,$response,$args) {
    return $response->withRedirect('/data_post_sample');
});

