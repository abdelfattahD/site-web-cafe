


  //......................................................

 

  $(function(){
    $(".error-pass, .error-email ,.error-Fname,.error-Lname ,.error-cpass").hide();
    $(".overlay").hide();
    $(".confirmation").hide();
    
  })

  
  function checkEmail(email) {
    var emailReg = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    return emailReg.test(email);
  }
  function checkname(namef) {
    var nameReg = /[!#$%&’*()+/=?^_ `{|}~-]/g;
    return nameReg.test(namef);
  }
  function checklname(namel) {
    var nameReg = /[!#$%&’*()+/=?^_ `{|}~-]/g;
    return nameReg.test(namel);
  }

  function checkpass(password) {
    var nmrReg = /[0-9]/g;
    return nmrReg.test(password);
  }
  function checkpass1(password) {
  
    var nmrReg1 = /[!#$%&’*+/=?^_`{|}~-]/g;
  
    return nmrReg1.test(password);
  }
  

  
  function validateForm() {
    var countErrors = 0;
    var emailInput = $("input[name=email]");
    var passInput = $("input[name=password]");
    var passInputc = $("input[name=cpassword]");

    var full_name = $("input[type=fname]");
    var l_name = $("input[type=Lname]");



    




        
    if(!checkEmail($(emailInput).val())) {
      $(".error-email").fadeIn();
      $(".email-msg").html("layhafdak ktab email mgad");
      $("#col-lg-3" ).removeClass("has-success");

      $("#col-lg-3" ).addClass("has-error");

      countErrors++;
    } else {
      $("#col-lg-3" ).removeClass("has-error");

      $("#col-lg-3" ).addClass("has-success");
    }

if(checkname($(full_name).val())|| full_name.val() =='') {
    
      $(".error-Fname").fadeIn();
      $(".Fname-msg").html("layhafdak ktab name mgad");
      $("#col-lg-1" ).removeClass("has-success");

      $("#col-lg-1" ).addClass("has-error");

      countErrors++;
    } 
    else {
      $("#col-lg-1" ).removeClass("has-error");

      $("#col-lg-1" ).addClass("has-success"); }

 if(checklname($(l_name).val())|| l_name.val() =='') {
    
      $(".error-Lname").fadeIn();
      $(".Lname-msg").html("layhafdak ktab lname mgad");
      $("#col-lg-2" ).removeClass("has-success");

      $("#col-lg-2" ).addClass("has-error");

      countErrors++;
    } 
    else {
      $("#col-lg-2" ).removeClass("has-error");

      $("#col-lg-2" ).addClass("has-success"); }

   
    if(!checkpass($(passInput).val()) || !checkpass1($(passInput).val()) )  {
      $(".error-pass").fadeIn();
      $(".pass-msg").html("ktab motpass gggggggg");

      $("#col-lg-4" ).removeClass("has-success");

      $("#col-lg-4" ).addClass("has-error");
      countErrors++;
    } else {
      $("#col-lg-4" ).removeClass("has-error");
      $("#col-lg-4" ).addClass("has-success");
    


    }

    if(passInput.val() !== passInputc.val() )  {
      $(".error-cpass").fadeIn();
      $(".passc-msg").html("ktab motpass conf");

      $("#col-lg-5" ).removeClass("has-success");

      $("#col-lg-5" ).addClass("has-error");
      countErrors++;
    } else {
      $("#col-lg-5" ).removeClass("has-error");
      $("#col-lg-5" ).addClass("has-success");
    


    }

    
  
 
  
    if(passInput.val().length < 5) {
      $(".error-pass").fadeIn();
      $(".pass-msg").html("ktab motpass ktar 5 ar9am olatarch bok");
      countErrors++;
    } else {
      $(passInput).removeClass("warning");
    }
  
    setTimeout(function showErrorMsg() {
      $(".error-email, .error-pass,.error-cpass , .error-Fname, .error-Lname ").fadeOut();
    }, 2000)
  
    if(countErrors === 0) {
      $(".overlay").show();
      $(".confirmation").show();
      $("#containerR").css("display", "none");
      $("#containerB").css("display", "block");

      $.ajax({
        type: "POST",
        url: 'add.php',
        data:  {functionname: 'add'},
                success: function(data) {
          alert('Directory add');
        }
      });

 

    }
  }


 