namespace Repository;
use Model\User;

class UserRepository
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * メールアドレスでユーザーが存在するかを確認する
     *
     * @param $email
     *
     * @return User
     */
    public function findByEmail($email)
    {
        $sql = 'select name from users where id = ?';
        $sth = $con->prepare($sql);
        $sth->bindValue('1',$user_id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_BOTH);
        $user = new User($data);
        return $user;
    }
}
