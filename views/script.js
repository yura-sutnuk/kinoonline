
function editPoster()
{
  if(!document.getElementById("trPoster"))
  {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td align="right" id="trPoster">Постер (*.jpeg)</td> <td><span class="Button" onClick="fileSelect(form.poster);"><a >Загрузить файл</a></span>	<span id="posterValue" style="margin-left:10px"> Файл не выбран </span><input type="file" onChange="selected(poster,posterValue);"  class="hiddenElement" name="poster" accept="image/*,image/jpeg" ></td> ';
    editField.appendChild(tr);
  }
}

function editScreenshot()
{
  if(!document.getElementById("trScreenshot1"))
  {  var tr = document.createElement('tr');
	  tr.innerHTML = '<td align="right" id="trScreenshot1">Скриншот 1(*.jpeg)</td>	<td> <span class="Button" onClick="fileSelect(form.screen1);"><a >Загрузить файл</a></span>	<span id="screen1Value" style="margin-left:10px"> Файл не выбран </span> <input type="file" class="hiddenElement" onChange="selected(screen1,screen1Value);"  name="screen1" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr);
	 
	  var tr2 = document.createElement('tr');
	  tr2.innerHTML = '<td align="right" id="trScreenshot2">Скриншот 2(*.jpeg)</td>	<td> <span class="Button" onClick="fileSelect(form.screen2);"><a >Загрузить файл</a></span>	<span id="screen2Value" style="margin-left:10px"> Файл не выбран </span><input type="file" class="hiddenElement"  onChange="selected(screen2,screen2Value);"  name="screen2" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr2);
	 
	  var tr3 = document.createElement('tr');
	  tr3.innerHTML = '<td align="right" id="trScreenshot3">Скриншот 3(*.jpeg)</td>	<td><span class="Button" onClick="fileSelect(form.screen3);"><a >Загрузить файл</a></span>	<span id="screen3Value" style="margin-left:10px"> Файл не выбран </span><input type="file" class="hiddenElement" onChange="selected(screen3,screen3Value);"  name="screen3" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr3);
  }
}

function editFilm()
{
  if(!document.getElementById("trFilm"))
  { 
	  var tr = document.createElement('tr');
	  tr.innerHTML = '<td align="right" id="trFilm">Видео</td><td><input type="text" class="text" name="video"></td>  ';
	  editField.appendChild(tr);
  }
}

function Submit (obj)
{
	obj.submit();
}
function fileSelect (obj)
{
	obj.click();
}
function selected(obj,valueContainer)
{
	if(checkFileSize(obj.files[0].size))
	{
		alert('файл не должен быть больше 300КБ');
	}
	else
	{
		valueContainer.innerHTML = obj.files[0].name;
	}
	
	
}
function changeAvatar(obj)
{
	if(checkFileSize(obj.newAvatar.files[0].size))
	{
		alert('файл не должен быть больше 300КБ');
	}
	else
	{
		obj.submit();
	}
	
}
function checkFileSize(size)
{
	return size>300*1024;
}
function changeRating(filmId,userId,mark)
{
	var req = new XMLHttpRequest();
		req.open('POST','/changeRating/'+filmId+'/'+userId+'/'+mark, false);
		req.send();
		if(req.status==200)
		{
			var avgRating = (+req.responseText);
			var html='';
			for(var i=0; i<5;i++)
			{
				if(i<avgRating)
				{
					html += '<img onClick="changeRating('+filmId+','+userId+','+ (i+1) +');"  style="display:inline; cursor: pointer" src="/views/images/rate1.png"> ';
				}
				else
				{
					html += '<img onClick="changeRating('+filmId+','+userId+','+ (i+1) +');"  style="display:inline; cursor: pointer" src="/views/images/rate2.png"> ';
				
				}
			
			}
			document.getElementById('rating'+filmId).innerHTML = html;
		}
}


function addFavorite(filmId,userId)
{
	var req = new XMLHttpRequest();
	req.open('POST','/addFavorite/'+userId+'/'+filmId,false);
	req.send();

	if(req.status==200)
	{
		document.getElementById('favorite'+filmId).innerHTML='<span  onClick="deleteFavorite('+filmId+','+userId+')"; > Удалить из избранного </span>'
	}
	else
	{
		alert('error');
	}
	
}
function deleteFavorite(filmId,userId)
{
	var req = new XMLHttpRequest();
	req.open('POST','/deleteFavorite/'+userId+'/'+filmId,false);
	req.send();
	if(req.status==200)
	{
		document.getElementById('favorite'+filmId).innerHTML='<span  onClick="addFavorite('+filmId+','+userId+')"; > Добавить в избранное </span>';
	}
	else
	{
		alert('error');
	}
}

function showMenu()
{
	document.getElementById('menu').style.visibility='visible'
}
function hideMenu()
{
	document.getElementById('menu').style.visibility='hidden'
}
