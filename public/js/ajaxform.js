$(function(){
    $("#showform").click(function(){
    	//alert ('aaa');
        $("#winpopup").dialog({
        	autoOpen: false,
    		show: {
    			effect: "blind",
    			duration: 1000
    		},
    		hide: {
    			effect: "explode",
    			duration: 1000
    		},
    		modal: true,
    		buttons: {
    		  "Submit": addUser,
    		  Cancel: function() {
    		    dialog.dialog( "close" );
    		  }
    		},
    		close: function() {
    		  form[ 0 ].reset();
    		  allFields.removeClass( "ui-state-error" );
    		}
    	});
       $("#winpopup").load($(this).attr('href'));
       $("#winpopup").dialog("open");
       
         
        return false;
    });    
});

function addUser() {
   alert("aaa");
   $("form[name='TestEntity']").submit();
   $("#winpopup").dialog( "close" );
  }