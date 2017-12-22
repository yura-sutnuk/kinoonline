<?php 

class globalFunctions 
{
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
	

}