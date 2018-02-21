<?php
namespace Ap\Repository;
use Ap\Model\Samples;

class SamplesRepository
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * データ登録
     *
     * @param $sample
     */
    public function insert($sample)
    {
        $sql = 'insert into samples(id,data1,data2,created_at,updated_at) values(null,?,?,now(),now())';
        $sth = $this->db->prepare($sql);
        $ret = $sth->bindValue('1', $sample->data1, \PDO::PARAM_STR);
        $ret = $sth->bindValue('2', $sample->data2, \PDO::PARAM_STR);
        $ret = $sth->execute();

    }

    /**
     * IDでレコードを抽出する
     *
     * @param $id
     *
     * @return Samples
     */
    public function findByID($id)
    {
        $sql = 'select * from samples where id = ?';
        $sth = $this->db->prepare($sql);
        $sth->bindValue('1',$id, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_BOTH);
        $sample = new Samples($result);
        return $sample;
    }
}
