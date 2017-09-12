/*
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-theme.min.css">
*/
/*
<script src="dist/js/bootstrap.min.js"></script>
*/
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
$("#img_selectall").on("click", function() {
    if (this.checked) {
        $('.del_checkbox:checkbox').each(function() {
            $(this).prop('checked', true);
        });
    } else {
        $('.del_checkbox:checkbox').each(function() {
            $(this).prop('checked', false);
        });
    }
});
$("#string").on("input", function() {
    //alert("called");
    $.each($(".test"), function(index, value) {
        var tdd = $(value).parent();
        //console.log($(tdd).text($(tdd).text()));	
    });
    var search = $("#string").val();
    $(".search:contains('" + search + "')").each(function() {
        var regex = new RegExp(search, 'gi');
        //console.log($(this).text());
        $(this).html($(this).text().replace(regex, "<span style='color:red;' class='test'>" + search + "</span>"));
    });
});
$(".switch").on("click", function() {
    var productId = $(this).attr("data-id");
    var status = $(this).attr("data-status");
    var updateSattus = 0;
    if (status == 0) {
        updateSattus = 1;
    }
    //console.log(productId);
    //console.log(updateSattus);
    $.ajax({
        url: 'update_switch.php',
        data: { "rowid": productId, "status": updateSattus }, // pass data 
        dataType: 'text',
        success: function(data) {
            //success logic
            //alert("success");	
        },
        error: function(data) {
            //error logic
            // alert("something wrong");
        }
    });
});
//insert status
var insertstatus;
$('#someSwitchOptionSuccess_insert').on('click', function() {
    this.value = this.checked ? 1 : 0;
    insertstatus = this.value;
    // console.log(insertstatus);
    //alert(this.value);
});
/*	$("#btn_add").on("click",function(){
		var id = $(this).attr("data-id");
		//console.log(insertstatus);
		$.ajax({
				type : "text",
			  url: "update_switch.php",
			  data:{"rowid":id,"status":insertstatus},
			  cache: false,
			  success:function(data){
	            //success logic
	            alert("success");	
	        	}, 	       
		        error:function(data){
		            //error logic
		           alert("something wrong");
		        }
	});
	});		*/
//select all checkbox
$("#img_selectall").on("click", function() {
    //alert("called");
    if (this.checked) {
        $('.img_check:checkbox').each(function() {
            $(this).prop('checked', true);
        });
    } else {
        $('.img_check:checkbox').each(function() {
            $(this).prop('checked', false);
        });
    }
});