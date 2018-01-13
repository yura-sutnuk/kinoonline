<?php

include_once ROOT . '/models/base/favorite.php';

class FilmModel extends favorite
{
    public function insertComment($id_user, $id_film, $text)
    {
        $query = 'INSERT INTO comments (id_user, id_film, text, date) VALUES ("' . $id_user . '","' . $id_film . '","' . $text . '",now())';
        $this->MyQuery($query);
    }

    //получаем коментарии всех юзеров для данного фильма
    public function getCommentData($filmId)
    {
        $query = "SELECT comments.text, comments.date, users.login, users.avatar, users.id FROM comments, users ";
        $query .= "WHERE comments.id_film = '" . $filmId . "' AND users.id=comments.id_user";
        return $this->MyQuery($query);

    }

    //получает следующий id фильма
    public function getNextId()
    {
        $query = "SELECT AUTO_INCREMENT as AI FROM information_schema.TABLES WHERE TABLE_NAME = 'films'";
        return $this->MyQuery($query)[0]['AI'];
    }

    //получаем число фильмов удовлетворяющих условию $where (если не задано условие то всех фильмов)
    public function getFilmsCount($where = array('id' => ''))
    {
        $query = 'select count(*) as count from films WHERE ';
        foreach ($where as $field => $value)
        {
            $query .= $field . ' LIKE "%' . $value . '%" AND';
        }
        $query = rtrim($query, 'AND');

        return $this->MyQuery($query)[0]['count'];
    }

    public function deleteFilm($id)
    {
        $query = "DELETE FROM films WHERE id='" . $id . "'";
        $this->MyQuery($query);
    }

    public function deleteAllSeries($id)
    {
        $query = "DELETE FROM series WHERE filmId='" . $id . "'";
        $this->MyQuery($query);
    }

    public function deleteSeries($id)
    {
        $query = "DELETE FROM series WHERE id='" . $id . "'";
        $this->MyQuery($query);
    }

    public function addFilm($arr)
    {
        $query1 = 'INSERT INTO films(';
        $query2 = ') VALUES (';

        $size = count($arr);
        for ($i = 0; $i < $size - 1; $i++) {
            $query1 .= key($arr) . ',';
            $query2 .= '\'' . current($arr) . '\',';
            next($arr);
        }

        $query1 .= key($arr);
        $query2 .= '\'' . current($arr) . '\'';
        $id = $this->getNextId();
        $this->MyQuery($query1 . $query2 . ')');

        return $id;
    }

    public function addSeries($filmId, $video, $name)
    {
        $query = 'INSERT INTO series (filmId,src,name) VALUES ';
        $size = count($video);
        for ($i = 0; $i < $size; $i++) {
            $query .= '("' . $filmId . '","' . $video[$i] . '","' . $name[$i] . '"),';
        }
        $query = rtrim($query, ',');
        $this->MyQuery($query);
    }

    public function getSeries($id)
    {
        $query = 'SELECT id,src,name FROM series WHERE filmId ="' . $id . '" ORDER BY id';
        return $this->MyQuery($query);
    }

    public function updateSeries($id, $name, $src)
    {
        $query = 'UPDATE series SET name="' . $name . '",src="' . $src . '" WHERE id="' . $id . '"';
        $this->MyQuery($query);
    }

    public function updateFilm($arr, $id)
    {
        $query = 'UPDATE films SET ';
        $size = count($arr);
        for ($i = 0; $i < $size - 1; $i++) {
            $query .= key($arr) . ' ="' . current($arr) . '", ';
            next($arr);
        }
        $query .= key($arr) . ' ="' . current($arr) . '" WHERE id= "' . $id . '"';
        //var_dump($query);
        return $this->MyQuery($query);
    }

    public function getFilmById($id)
    {
        $query = "SELECT * FROM films WHERE id='" . $id . "'";
        $result = $this->MyQuery($query);
        return $result;
    }

    public function getFilmsOnPage($start, $end, $where = ['id' => ''])
    {
        $query = 'SELECT *, (SELECT AVG(rating) FROM rating WHERE filmId=f.id) AS avgRating FROM films f WHERE ';
        foreach ($where as $field => $value) {
            $query .= $field . ' LIKE "%' . $value . '%" AND';
        }
        $query = rtrim($query, 'AND');
        $query .= ' LIMIT ' . $start . ',' . $end;
        var_dump($query);
        return $this->MyQuery($query);
    }

}