<?php

include_once ROOT.'/models/base/model.php';
//содержит функции для работы с рейтингом в mainController и FilmModel
abstract class rating extends model
{
    public function getAVGRating($id)
    {

        $query = 'SELECT avg(r.rating) as avgRating FROM rating r WHERE r.filmid="'.$id.'"';
        return (!empty ($this->MyQuery($query)[0]['avgRating']))? $this->MyQuery($query)[0]['avgRating']: 0  ;
    }
    public function insertRating($filmid,$userid,$rating)
    {
        $query = 'INSERT INTO rating (filmid,userid,rating) VALUES ("'.$filmid.'","'.$userid.'","'.$rating.'")';
        $this->MyQuery($query);
    }
    public function updateRating($filmid,$userid,$rating)
    {
        $query = 'UPDATE rating SET rating="'.$rating.'" WHERE userid="'.$userid.'" AND filmid="'.$filmid.'"';
        $this->MyQuery($query);
    }
    public function getRating($userid,$filmid)
    {
        $query ='SELECT count(*) as count FROM rating WHERE userid="'.$userid.'" AND filmid="'.$filmid.'"';
        return $this->MyQuery($query)[0]['count'];
    }
    public function deleteRating($filmid)
    {
        $query = 'DELETE FROM rating WHERE filmid="'.$filmid.'"';
        $this->MyQuery($query);
    }
}