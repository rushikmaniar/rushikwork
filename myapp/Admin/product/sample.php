<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>contains demo</title>

<link rel=stylesheet href="css/my.css">



</head>
<body>
 <span>
 </span>
<div>John Resig</div>
<div><b>George Martin</div>
<div>Malcom John Sinclair</div>
<div>J. Ohn</div>
<input type="text" name="string" id="string" placeholder="Search" />
<button name="btn" id="btn-search">OK</button>
<table border="5" width="150">
	<tr><td>1</td><td>rushik</td></tr>
	<tr><td>2</td><td>meru</td></tr>
</table> 
</body>
</html>
 <script src="js/jquery-3.2.1.min.js"></script>
<script>
	/*$("#btn-search").on("click",function(){
				//alert("called");
				var string = $("#string").val();
				$("td").each(function(i,tdObj) {
					//var a = $(this).val();
					var txt = $(tdObj).text();
						
					console.log(txt);
				if(string == txt )
				{
					$(tdObj).focus();
					$(tdObj).addClass("selectedPage");

				}
				$(tdObj).on("blur",function(){
					$(tdObj).removeClass("selectedPage");
				});
				});

				console.log(string);
	});*/


	$("#string").on("input",function(){
				//alert("called");
				$.each($(".test"),function(index,value){
					var tdd = $(value).parent();
					console.log($(tdd).text($(tdd).text()));	
				});

				var search = $("#string").val();
				
				$("td:contains('"+search+"')").each(function () {
       				 var regex = new RegExp(search,'gi');
       				 //console.log($(this).text());
        				 $(this).html($(this).text().replace(regex, "<span style='color:red;' class='test'>"+search+"</span>"));
 				});

				//console.log(string);
	});


	</script>