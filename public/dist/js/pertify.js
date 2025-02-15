
var ajaxRequested = false;
$(document).ready(function() {

	$(document).on('submit','.ajax_form',function(event){
	
	var $submitBTN = $(this).find('button[type="submit"]');
	$submitBTN.attr('disabled','disabled');
	var posturl=$(this).attr('action');
	var $this = $(this).closest('form');
	var formID =$(this).attr('id');
	var formClass =$(this).attr('class');
	var loadingHTML = ' <i class="fa fa-spinner fa-spin fa-1x fa-fw submit_loader"></i>'
	$submitBTN.append(loadingHTML);
	if(!formID)
	formID = formClass;
	window.ajaxRequested = true;
	$($this).find('.form-group').removeClass('has-error');
	$($this).find('.help-block').hide();
	thisform = $this;
	
	$(this).ajaxSubmit({		
		headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
					url: posturl,
					dataType: 'json',
					success: function(response){
					
						checkTosterResponse(response);
						response.formID = formID;
						$submitBTN.removeAttr('disabled');
						$submitBTN.find('.fa-spin').remove();
						window.ajaxRequested = false;
			
						if(response.redirectURL)
							
							window.location.href=response.redirectURL;
						if(response.scrollToThisForm)
							scrollToElement('#'+formID,1000);
						if(response.selfReload)
							window.location.reload();
						if(response.resetForm)
							$($this).resetForm();
						if(response.callBackFunction)
							callBackMe(response.callBackFunction,response);
					},
					error:function(response){
						$submitBTN.removeAttr('disabled'); 
						$submitBTN.find('.fa-spin').remove();
					}
				});
	return false;
	});
});
function callBackMe(functionName,data)
{
	window[functionName](data);
}
function scrollToElement(element,speed)
{
	$('html, body').animate({scrollTop:$(element).position().top + 10},speed);
}
function checkTosterResponse(data)
{
	if(data)
	{
	  if(data.message)
	  {
	    if(data.success)
	    {
	      //toastr.success(data.message);
            $.toast({
                heading: 'Success',
                text: data.message,
                icon: 'success',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',  // To change the background
                showHideTransition: 'fade'
            });
	    }
	    else
	    {
	       $.toast({
                heading: 'Error',
                text: data.message,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: 'red',  // To change the background
                showHideTransition: 'fade'
            });
	    }
	  }
	}
}