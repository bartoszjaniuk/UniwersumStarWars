$.ajax({
  method: "POST",
  url: "https://swapi.co/api/films",
  async: 'false',
  dataType: "json",
}).done(function( json ) {
    $.each(json.results, function(i, key){
		console.log(key);
		$("#filmy").append('<p>' + key.title + '</p>');
        $.each(key.planets, function(i, planet){
            $('#planet',"#filmy").append(planet);
        });          
    });
  });