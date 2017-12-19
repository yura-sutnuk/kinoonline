<?php 

class globalFunctions 
{
	protected  function upload($index,$destination,$newName='')
	{
		
		if(!empty($_FILES[$index]['tmp_name']))
		{	echo $destination.$_FILES[$index]['name'].'||';
			$destination .= ($newName==='')? $_FILES[$index]['name'] : $newName.'.jpg';
			echo $destination;
			move_uploaded_file($_FILES[$index]['tmp_name'], $destination);
			//return basename($_FILES[$index]['name']);
			return basename($destination);
		}
	}
	

}