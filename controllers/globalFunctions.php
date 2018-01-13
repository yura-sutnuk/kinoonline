<?php

include_once(ROOT."/models/FilmModel.php");

abstract class globalFunctions
{
    protected $linkHref;
    protected $model;


	/*
	функция для загрузки изображений на сервер
	$index - индекс в масиве _FILES
	$destination - куда копировать
	$newName='' - новое имя файла, если не задано остается старое 
	
	функция возвращает имя загруженого файла на сервере
	*/
	protected  function upload($index,$destination,$newName='')
	{
		
		if(!empty($_FILES[$index]['tmp_name']))
		{	
			$destination .= ($newName==='')? $_FILES[$index]['name'] : $newName.'.jpg';
			move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
			return basename($destination);
		}
	}


    public function getPages($count,$maxFilmsOnPage,$currentPage)
    {
        $pageCount = (int)ceil($count/$maxFilmsOnPage);
        $start = $currentPage-2 > 0? $currentPage-2 : 1;
        $end = $currentPage+2 < $pageCount? $currentPage+2 : $pageCount;
        $htmlPage = '';
        if ($currentPage-2>1)
        {
            $htmlPage = "<a class='page' href ='/".$this->linkHref."'/1/' >1</a> <span> ... </span>";
        }
        foreach (range($start,$end) as $page)
        {
            if($currentPage == $page )
            {
                $htmlPage .=  "<a class='page' id='activePage' href='/". $this->linkHref.$page ."/'>".$page."</a>";

            }
            else
            {
                $htmlPage .= "<a class='page' href='/". $this->linkHref.$page."/'>".$page."</a>";
            }
        }

        if($currentPage+2 < $pageCount)
        {
            $htmlPage .= "<span>...</span><a class='page' href='/". $this->linkHref.$pageCount."/ '>".$pageCount."</a>";
        }

        return $htmlPage;
    }





}