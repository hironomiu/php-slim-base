<?php

$app->get('/',function ($request, $response, $args) {

    $con = $this->get('pdo');

    $user_id = mt_rand(1,1000000);
    $follow_user_id = mt_rand(1,1000000);

    // SQL
    $sql = 'select name from users where id = ?';
    $sth = $con->prepare($sql);
    $sth->bindValue('1',$user_id, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_BOTH);

    return $this->view->render($response,'chapter1.twig',
        [
        'user' => $result['name']
        ]);
});

