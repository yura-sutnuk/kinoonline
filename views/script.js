
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
	if(checkFileSize(obj.files[0].size))
	{
		alert('файл не должен быть больше 300КБ');
	}
	else{
		ava.submit();
	}
	
}
function checkFileSize(size)
{
	return size>300*1024;
}
function changeRating(filmid,userid,mark)
{
	var req = new XMLHttpRequest();
		req.open('POST','/changeRating/'+filmid+'/'+userid+'/'+mark, false);
		req.send();
		if(req.status==200)
		{
			location.reload();
		//	document.getElementById('w').innerHTML=req.responseText;
			//alert( req.responseText );
		}
		else
		{
		//	alert( req.status );
		}
		
		/*// 4. Если код ответа сервера не 200, то это ошибка
		if (req.status != 200) {
		// обработать ошибку
		alert( req.status + ': ' + req.statusText ); // пример вывода: 404: Not Found
		} else {
		// вывести результат
		alert( req.responseText ); // responseText -- текст ответа.
		}*/
		
		
		   /* function refresh(param){
             var XMLHttpRequestObject = false;
             if (window.XMLHttpRequest)
                XMLHttpRequestObject = new XMLHttpRequest();
             else if(window.ActiveXobject)
                XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");               
                
             if (XMLHttpRequestObject)
             {
                XMLHttpRequestObject.open('GET','handler.php?alb='+param);
                XMLHttpRequestObject.onreadystatechange = function(){
                    if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
                        document.getElementById('result').innerHTML = XMLHttpRequestObject.responseText;
                    }   
                }  
                XMLHttpRequestObject.send(null);
             }     
           }*/
}

