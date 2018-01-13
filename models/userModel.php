<?php

include_once(ROOT.'/models/base/model.php');

class userModel extends model
{
    //возвращает id последнего добавленного юзера
    private function lastInsertID()
    {
        $query = 'SELECT LAST_INSERT_ID() as id FROM users';
        return $this->MyQuery($query)[0]['id'];
    }

    public function loginExist($login)
    {
        $query = 'SELECT id FROM users WHERE login="'.$login.'"';
        $result = $this->MyQuery($query);
        if(empty($result))
        {
            return false;
        }
        return true;
    }

    public function addNewUser($userData)
    {
        $query1='INSERT INTO users (';
        $query2=') VALUES (';

        $size = count($userData);
        for($i=0;$i<$size;$i++)
        {
            $query1 .= key($userData).',';
            $query2 .= '\''.current($userData).'\',';
            next($userData );
        }

        $query1 .= 'registerDate ';
        $query2 .= 'now()';
        $this->MyQuery($query1.$query2.')');

        return $this->lastInsertID();
    }
    public function addNewUserData($data)
    {
        $query1='INSERT INTO userData (';
        $query2=') VALUES (';

        $size = count($data);
        for($i=0;$i<$size-1;$i++)
        {
            $query1 .= key($data).',';
            $query2 .= '\''.current($data).'\',';
            next($data );
        }

        $query1 .= key($data);
        $query2 .= '"'.current($data).'"';
        return $result=$this->MyQuery($query1.$query2.')');
    }
    public function updateUserData($data, $table='userData')
    {
        $query1='UPDATE '.$table.' SET ';

        $size = count($data);
        for($i=0;$i<$size-1;$i++)
        {
            $query1 .= key($data).'=';
            $query1 .= '\''.current($data).'\',';
            next($data );
        }

        $query1 .= key($data).'=\''.current($data).'\' WHERE id=\''.$data['id'].'\'';
        return $result=$this->MyQuery($query1);
    }

    public function userEnter($login)
    {
        $query = "SELECT * FROM users WHERE login='".$login."'";
        return $this->MyQuery($query)[0];
    }

    public function getFieldsValueById($fields, $id, $table='users')
    {
        $query = 'SELECT ';
        $size = count($fields);
        for($i=0; $i<$size-1; $i++)
        {
            $query .= current($fields) .', ';
            next($fields);
        }
        $query .= current($fields) . ' FROM '.$table.' WHERE id="'.$id.'"';
        return $this->MyQuery($query)[0];
    }


}
