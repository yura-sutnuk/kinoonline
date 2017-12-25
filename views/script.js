

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
		//tr.innerHTML = '<td align="right" id="trFilm">Видео</td><td><input type="text" class="text" name="video"></td>  '; 
		tr.innerHTML = '<td align="right" id="trFilm"><span>Видео</span> <input type="text" class="text" name="video"></td>';
		tr.innerHTML += '<td align="left" id="trFilm2"><span>Название</span> <input type="text" class="text" name="videoName"></td>'
		editField.appendChild(tr);
		var elem = document.getElementsByClassName('active')[0];
		var newInput = document.createElement('input');
		newInput.type="hidden";
		newInput.name="seriesId"
		newInput.value = elem.id;
		editField.appendChild(newInput);
		document.getElementsByName('video')[0].value = document.getElementById('frame').src;
		document.getElementsByName('videoName')[0].value = elem.innerHTML;
		var newButton = document.createElement('input')
		newButton.type = 'submit';
		newButton.className = 'button'; 
		newButton.value = 'Удалить серию'; 
		newButton.name = 'deleteSeries'; 
		 
		document.getElementById('trFilm2').appendChild(newButton);
  }
  else
  {
		var elem = document.getElementsByClassName('active')[0];
		document.getElementsByName('seriesId')[0].value = elem.id;
		document.getElementsByName('video')[0].value = document.getElementById('frame').src;
		document.getElementsByName('videoName')[0].value = elem.innerHTML;
  }
}
function addFilm()
{
	var tr = document.createElement('tr');
	tr.innerHTML = '<td align="right"><span>Видео</span> <input type="text" class="text addvideo" name="addvideo[]"></td>';
	tr.innerHTML += '<td align="left"><span>Название</span> <input type="text" class="text addname" name="namevideo[]"></td>'
	editField.appendChild(tr);
}

function move(left)
{
	var elem = document.getElementsByClassName('Series');
	var endLeft = parseInt(elem[elem.length-1].style.left);
	var endRight = parseInt(elem[0].style.left);
	if(left==-1 && endLeft<=450)
	{
	return;
	}
	if(left==1 && endRight>=0)
	{
	return;
	}
	//alert(elem[0].style.left);
	for(var i=0;i<elem.length;i++)
	{
		elem[i].style.left=parseInt(elem[i].style.left)+left*90;
	}
		//alert(elem[0].style.left);
}
function load(src,id,obj)
{	
	
	document.getElementById('frame').src=src;
	document.getElementsByClassName('active')[0].classList.remove('active'); 
	obj.classList.add('active');
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
