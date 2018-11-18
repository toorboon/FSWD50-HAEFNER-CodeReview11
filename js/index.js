$(document).ready(function(){
    
//on init
  //jQuery Ajax Call for fetching the table on load of page
    //set the search string to '' in the beginning, so we see the whole list
    txt = '';
    category = document.title.toLowerCase();
    print_result(category, txt); 

//SET EVENT LISTENERS
    //jQuery Ajax Call for fetching the table on entering a search string in the search box
    $('#search_text').keyup(function(){
        var txt = $(this).val();
        print_result(category, txt); 
    });

    //jQuery fetches all the fields from the form and sending it to PHP
    $('#data_form').on('submit', function(e){
        insert_location(e,$('#data_form'));    
    })

    //on button close for the modals reload the page! 
    $('.close_button').on('click', function(){
        if (category == 'travelomatic') {
            category = 'index';
            window.location.replace(category + '.php');
        }
        window.location.replace(category + '.php');
    });

//MANIPULATE THE INSERT/EDIT FORM DEPENDING ON THE CATEGORY
    if (($('#category').val()) == ''){
        $('.sight_container,.event_container,.multi_container,.restaurant_container').hide();
    }
    //LÖSCHEN VOR aBGABE!!!!
    if (($('#category').val()) == 'restaurant'){
            $('.sight_container,.event_container').hide();
        } 
    $('#category').on('change', function(){
        if (($('#category').val()) == 'restaurant'){
            $('.sight_container,.event_container').hide();
            $('.restaurant_container').show();
        } 
        if (($('#category').val()) == 'event'){
            $('.sight_container,.restaurant_container,.multi_container').hide();
            $('.event_container').show();
        }
        if (($('#category').val()) == 'sight'){
            $('.restaurant_container,.event_container').hide();
            $('.sight_container').show();
        }
    });

//LOGOUT FUNCTION TO KICK THE USER OUT VIA AJAX
    //on click function for logout button
    $('#logout').on('click', function(){
        $.ajax({
          url:"includes/logout.inc.php",
          method: "post",
          success:function(response)
            {
              swal("Well Done!",response,"success").then(function(){window.location.replace('index.php');});
              console.log('User signed out.')
            }
          
        });
    }); 

    function delete_location(element){
        element_array = element.split('_');
        element_category = element_array[0];
        element_id = element_array[1];

        $.ajax({
          url:"includes/delete.inc.php",
          method: "post",
          data:{'category':element_category, 'id':element_id},
          dataType:"text",
          success:function(response)
            {
              swal("Well Done!",response,"success");
              print_result(category, txt);
              console.log('Record deleted!')
            }
        });
    }

    function print_result(category, txt){
            
        $('#result').html('');
        $.ajax({
            url:"includes/fetch.inc.php",
            method: "post",
            data:{'category':category, 'search':txt},
            dataType:"text",
            success:function(data)

            {
              $('#result').html(data);
              //on button delete, deleting the whole card with data in the database
              $('.delete_button').on('click', function(){
                delete_location($(this).attr('id'));
              });
            }
        });
    }

    function insert_location(event, form){
        event.preventDefault();
        $.ajax({
            url:"includes/insert.inc.php",
            method: "post",
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success:function(data)

            {
              swal('Well Done!',data,'success');
              $('#register_form').modal('toggle');
              print_result(category, txt); 
            }
        });
    }


}); //end of document.ready(function())

/*//on click function for logout button, so logout from Google is possible
  $('#logout').on('click', function(){
    $.ajax({
      url:"includes/logout.inc.php",
      method: "post",
      success:function(response)
        {
          swal("Well Done!",response,"success").then(function(){window.location.replace('index.php');});
          console.log('User signed out.')
        }
      
      }); 
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('even logged out from fucking Google');
    });
  });
 
 //Google Login Shit
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }*/

 

    