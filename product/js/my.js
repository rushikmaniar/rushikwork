/*
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-theme.min.css">
*/
/*
<script src="dist/js/bootstrap.min.js"></script>
*/


function change_style(a)
{
	var pageId=document.getElementById('link'+a);
	$(pageId).addClass("selectedPage");
}



			//$("#table-insert").hide();
			//$("#table-display").hide();
			
			$("#btn-insert").click(function() {
				//$("#table-insert").show();
				$("#table-insert").toggle("slideToggle(slow/400/fast)");
			});

			$("#btn-display").click(function() {
				//$("#table-display").show();
				$("#table-display").toggle("slideToggle(slow/400/fast)");

			});	
			
			$("#selectall").click(function() {

				if(this.checked)
				{
				$('#form-display input:checkbox').each(function(){
					$(this).prop('checked',true);
				});
			}
			else{
				$('#form-display input:checkbox').each(function(){
					$(this).prop('checked',false);
				});
			}
			});

			$("#string").on("input",function(){
				//alert("called");
				$.each($(".test"),function(index,value){
					var tdd = $(value).parent();
					//console.log($(tdd).text($(tdd).text()));	
				});
				var search = $("#string").val();
				$(".search:contains('"+search+"')").each(function () {
       				 var regex = new RegExp(search,'gi');
       				 //console.log($(this).text());
        				 $(this).html($(this).text().replace(regex, "<span style='color:red;' class='test'>"+search+"</span>"));
 				});
 			});


