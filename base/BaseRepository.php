<?php

class BaseRepository
{
    protected mysqli $connection;
    protected string $table_name;

    public function __construct(string $table_name)
    {
        $this->connection = new mysqli("localhost", 'root', '', "web");
        $this->table_name = $table_name;
    }

    public function create(array $data)
    {
        $fields = '';
        $values = '';

        foreach ($data as $key => $value){
            $fields .= $key.',';

            if(gettype($value)==='string'){
                $values .= '\''.$value.'\',';
                continue;
            }

            $values .= $value.',';
        }

        $values = trim($values, ',');
        $fields = trim($fields, ',');

        $sql = "insert into $this->table_name ($fields) values ($values)";
        $this->connection->query($sql);
    }

    public function get_by_id(int $id)
    {
        $sql = "select * from $this->table_name where id = $id";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function get_all()
    {
        $sql = "select * from $this->table_name";
        return $this->connection->query($sql)->fetch_all();
    }

    public function update(array $data)
    {
        if(!array_key_exists('id', $data)){
            echo 'Обновление без id';
            return;
        }

        $id = $data['id'];
        $values = '';

        foreach ($data as $key => $value){
            $values .= $key.'=';

            if(gettype($value)==='string'){
                $values .= '\''.$value.'\',';
                continue;
            }

            $values .= $value.',';
        }

        $values = trim($values, ',');

        $sql = "update $this->table_name set $values where id = $id";
        $this->connection->query($sql);

    }

    public function delete(int $id)
    {
        $sql = "delete from $this->table_name where id = $id";
        $this->connection->query($sql);
    }

    public function delete_all()
    {
        $sql = "delete from $this->table_name";
        $this->connection->query($sql);
    }

}