
function editPoster()
{
  if(!document.getElementById("trPoster"))
  {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td align="right" id="trPoster">Постер (*.jpeg)</td> <td><input type="file"  name="poster" accept="image/*,image/jpeg" ></td> ';
    editField.appendChild(tr);
  }
}

function editScreenshot()
{
  if(!document.getElementById("trScreenshot1"))
  {  var tr = document.createElement('tr');
	  tr.innerHTML = '<td align="right" id="trScreenshot1">Скриншот 1(*.jpeg)</td>	<td><input type="file"  name="screen1" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr);
	 
	  var tr2 = document.createElement('tr');
	  tr2.innerHTML = '<td align="right" id="trScreenshot2">Скриншот 2(*.jpeg)</td>	<td><input type="file"  name="screen2" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr2);
	 
	  var tr3 = document.createElement('tr');
	  tr3.innerHTML = '<td align="right" id="trScreenshot3">Скриншот 3(*.jpeg)</td>	<td><input type="file"  name="screen3" accept="image/*,image/jpeg" ></td> ';
	  editField.appendChild(tr3);
  }
}

function editFilm()
{
  if(!document.getElementById("trFilm"))
  { 
	  var tr = document.createElement('tr');
	  tr.innerHTML = '<td align="right" id="trFilm">Видео</td><td><input type="text" class="text" name="video" ></td>  ';
	  editField.appendChild(tr);
  }
}


