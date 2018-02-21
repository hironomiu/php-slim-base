<?php

namespace Ap\Validator;

use Respect\Validation\Validator as v;
// http://documentup.com/Respect/Validation/

class Sample 
{
    private $validator;
    private $errors = [];

    /**
     * バリデータを作成
     */
    public function __construct()
    {
        $this->validator = v::create()
        ->key('data1', v::stringType()->setName('data1')->notEmpty()->length(4, 255))
        ->key('data2', v::stringType()->setName('data2')->notEmpty()->length(1, 255))
        ;
    }

    /**
     * $input のバリデーションを行う
     *
     * @param array $input チェックする値を含む配列
     *
     * @return bool 有効かどうか
     */
    public function validate($input)
    {
        try {
            $this->validator->assert($input);
        } catch (\InvalidArgumentException $e) {
            $this->errors = $e->findMessages([
                'data1' => 'data1を確認してください',
                'data2' => 'data2を確認してください',
                                                 ]);
            return false;
        }
        return true;
    }
    /**
     * エラーメッセージの配列を返す
     */
    public function errors()
    {
        return $this->errors;
    }
}

