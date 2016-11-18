<script src="http://localhost/myfiles/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="http://localhost/myfiles/my_script.js" type="text/javascript"></script>

<form id="searchform" onsubmit="return false">

	<table border='1'>
	<tr>
	<th><center><font size = '4'>Type in any keyword related to the game you are looking for and we'll get the results for you.</font></center></th>
	</tr>
	<tr><td><center>
		<input type="text" name="searchbox" id="searchbox" onChange="getGameResults(this.value)";>
	</center></td></tr>
	</tr><td>
	<center><input type="button" id="button" value="Search" /></center>
	<br>
	<center><div id="searchresult"></div></center>
	</td></tr>
	</table>

</form>