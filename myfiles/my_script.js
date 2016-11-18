function getGameDeveloper(val)
{
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_dev.php",
	data:'developer_id='+val,
	success: function(data){ $("#game-list").html(data); } });
}

function getGameGenre(val)
{
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_genre.php",
	data:'genre_id='+val,
	success: function(data){ $("#game-list").html(data); } });
}

function getGamePlatform(val)
{
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_platform.php",
	data:'game_id='+val,
	success: function(data){ $("#platform-list").html(data); } });
}

function getGameReleaseDate(val)
{
	var game = $('#game-list').val();
	var platform = $('#platform-list').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_release_date.php",
	data: {date:val,game:game,platform:platform},
	success: function(data){ $("#dateresult").html(data); } });
}

function getGameSatisfaction(val)
{
	document.getElementById('satisfaction').value=val;
	var game = $('#game-list').val();
	var platform = $('#platform-list').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_satisfaction.php",
	data: {satisfaction:val,game:game,platform:platform},
	success: function(data){ $("#satisfactionresult").html(data); } });
}

function getGamePrice(val)
{
	var game = $('#game-list').val();
	var platform = $('#platform-list').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/get_game_price.php",
	data: {price:val,game:game,platform:platform},
	success: function(data){ $("#priceresult").html(data); } });
}

function getGameResults(val)
{
	var word = $('#searchbox').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/search_1.php",
	data: {word:word},
	success: function(data){ $("#searchresult").html(data); } });
}

function getDeveloperResults(val)
{
	var word = $('#searchbox').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/search_2.php",
	data: {word:word},
	success: function(data){ $("#searchresult").html(data); } });
}

function getGenreResults(val)
{
	var word = $('#searchbox').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/search_3.php",
	data: {word:word},
	success: function(data){ $("#searchresult").html(data); } });
}

function getPlatformResults(val)
{
	var word = $('#searchbox').val();
	$.ajax({
	type: "POST",
	url: "/myfiles/search_4.php",
	data: {word:word},
	success: function(data){ $("#searchresult").html(data); } });
}

function updateGenre(val1,val2)
{
	var r = confirm("Are you sure you want to update this record with Genre as "+val2+" ?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/update.php",
		data: {id:val1,genre:val2},
		success: function(data){ alert("The update was successful. You will now be redirected to the prediction page."); window.location.href = 'http://localhost/?q=predict_empty_values'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=predict_empty_values';
	}
}

function updateDeveloper(val1,val2)
{
	var r = confirm("Are you sure you want to update this record with Developer as "+val2+" ?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/update.php",
		data: {id:val1,developer:val2},
		success: function(data){ alert("The update was successful. You will now be redirected to the prediction page."); window.location.href = 'http://localhost/?q=predict_empty_values'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=predict_empty_values';
	}
}

function updatePlatform(val1,val2)
{
	var r = confirm("Are you sure you want to update this record with Platform as "+val2+" ?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/update.php",
		data: {id:val1,platform:val2},
		success: function(data){ alert("The update was successful. You will now be redirected to the prediction page."); window.location.href = 'http://localhost/?q=predict_empty_values'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=predict_empty_values';
	}
}

function updateDate(val1,val2)
{
	var r = confirm("Are you sure you want to update this record with Date as "+val2+" ?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/update.php",
		data: {id:val1,date:val2},
		success: function(data){ alert("The update was successful. You will now be redirected to the prediction page."); window.location.href = 'http://localhost/?q=predict_empty_values'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=predict_empty_values';
	}
}

function updatePrice(val1,val2)
{
	var r = confirm("Are you sure you want to update this record with Price as "+val2+" ?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/update.php",
		data: {id:val1,price:val2},
		success: function(data){ alert("The update was successful. You will now be redirected to the prediction page."); window.location.href = 'http://localhost/?q=predict_empty_values'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=predict_empty_values';
	}
}

function deleteGame(val1)
{
	var r = confirm("Are you sure you want to update this game from your collection?");
	if (r == true)
	{
		$.ajax({
		type: "POST",
		url: "/myfiles/delete.php",
		data: {id:val1},
		success: function(data){ alert("The delete was successful."); window.location.href = 'http://localhost/?q=your_collection'; } });
	}
	else
	{
		window.location.href = 'http://localhost/?q=your_collection';
	}
}