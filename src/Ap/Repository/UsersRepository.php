<?php
namespace Ap\Repository;
use Ap\Model\Users;

class UsersRepository
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * メールアドレスでユーザーが存在するかを確認する
     *
     * @param $id
     *
     * @return User
     */
    public function findByID($id)
    {
        $sql = 'select * from users where id = ?';
        $sth = $this->db->prepare($sql);
        $sth->bindValue('1',$id, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_BOTH);
        $user = new Users($result);
        return $user;
    }
}
