<?php

// セッション
$session = $container->get('session');

// CSRF
$app->add($container->get('csrf'));

$app->get('/',function ($request, $response, $args) {

    // getパラメータ取得
    $req = $request->getQueryParams();

    // 値判定と初期値設定、正確なバリデーションは今後実装する
    if (empty($req['user_id'])){
        $user_id = 1000000;
    }else{
        $user_id = $req['user_id'];
    }

    // リポジトリー取得
    $repository = $this->get('repository.user');

    // 検索結果取得
    $result = $repository->findByID($user_id);

    // テンプレートに必要な値を渡しレスポンス
    return $this->view->render($response,'chapter1.twig',
        [
        'user' => $result->name
        ]);
});

$app->get('/data_post_sample',function ($request, $response, $args) {
    // CSRF
    $csrf = $this->get('csrf');
    $name_key = $csrf->getTokenNameKey();
    $value_key = $csrf->getTokenValueKey();
    $name = $csrf->getTokenName();
    $value = $csrf->getTokenValue();

    // getパラメータ取得
    $req = $request->getQueryParams();

    // 値判定と初期値設定、正確なバリデーションは今後実装する
    if (empty($req['id'])){
        $id = 1;
    }else{
        $id = $req['id'];
    }

    // リポジトリー取得
    $repository = $this->get('repository.sample');

    // 検索結果取得
    $result = $repository->findByID($id);
    return $this->view->render($response,'data_post_sample.twig',[url => "/data_post_sample",'data1' => $result->data1,'name_key' => $name_key,'value_key' => $value_key,'name' => $name,'value' => $value]);
});

$app->post('/data_post_sample',function($request,$response,$args) {
    // postパラーメタ取得
    $input = $request->getParsedBody();

    // バリデーション
    $validator = new \Ap\Validator\Sample();

    if ($validator->validate($input)) {
        // リポジトリー取得
        $repository = $this->get('repository.sample');
       
        // データ挿入
        $sample = new \Ap\Model\Samples($input);
        $result = $repository->insert($sample);
    
        return $response->withRedirect('/data_post_sample');
    }

    // フラッシュメッセージは今後実装
    var_dump($validator->errors());
});

