<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- Add two inputs for "phoneNumber" and "code" -->
    <input type="tel" id="phoneNumber" value="+919694754693"/>
    <input type="text" id="code" />

    <!-- Add two buttons to submit the inputs -->
    <button id="sign-in-button" onclick="submitPhoneNumberAuth()">
      Send OTP
    </button>
    <button id="confirm-code" onclick="submitPhoneNumberAuthCode()">
      ENTER CODE
    </button>

  <button id="signOut" style="display:none;" onclick="signOut()">
      Sign Out
    </button>


    <!-- Add a container for reCaptcha -->
    <div id="recaptcha-container"></div>

    <!-- Add the latest firebase dependecies from CDN -->
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>

    <script>
      // Paste the config your copied earlier
     var firebaseConfig = {
        apiKey: "AIzaSyBuy8iXlGErtQysS_3Ufyi3R5Iw1c08StY",
        authDomain: "xtraclass-986f2.firebaseapp.com",
        databaseURL: "https://xtraclass-986f2.firebaseio.com",
        projectId: "xtraclass-986f2",
        storageBucket: "xtraclass-986f2.appspot.com",
        messagingSenderId: "806157778989",
        appId: "1:806157778989:web:07e05146b35012e81f38a4",
        measurementId: "G-78GGR8TN7J"
    };

      firebase.initializeApp(firebaseConfig);

      // Create a Recaptcha verifier instance globally
      // Calls submitPhoneNumberAuth() when the captcha is verified

    
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "normal",
          callback: function(response) {
            submitPhoneNumberAuth();
          }
        }
      ); 

      // This function runs when the 'sign-in-button' is clicked
      // Takes the value from the 'phoneNumber' input and sends SMS to that phone number
      function submitPhoneNumberAuth() {
        var phoneNumber = document.getElementById("phoneNumber").value;
        var appVerifier = window.recaptchaVerifier;

        console.log(appVerifier);
        firebase
          .auth()
          .signInWithPhoneNumber(phoneNumber, appVerifier)
          .then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      // This function runs when the 'confirm-code' button is clicked
      // Takes the value from the 'code' input and submits the code to verify the phone number
      // Return a user object if the authentication was successful, and auth is complete
      function submitPhoneNumberAuthCode() {
        var code = document.getElementById("code").value;
        confirmationResult
          .confirm(code)
          .then(function(result) {
            var user = result.user;
            console.log(user);
            $("#signOut").show();
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      //This function runs everytime the auth state changes. Use to verify if the user is logged in
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          console.log("USER LOGGED IN");
             $("#signOut").show();
        } else {
          // No user is signed in.
          console.log("USER NOT LOGGED IN");
             $("#signOut").hide();
        }
      });
    function signOut(){
    firebase.auth().signOut().then(function() {
  // Sign-out successful.
    }).catch(function(error) {
  // An error happened.
    });
}

 /* function sendOtp(){
    var phoneNumber = '+919694754693';
   var appVerifier = window.recaptchaVerifier;
firebase.auth().signInWithPhoneNumber(phoneNumber,appVerifier)
    .then(function (confirmationResult) {
      // SMS sent. Prompt user to type the code from the message, then sign the
      // user in with confirmationResult.confirm(code).
      window.confirmationResult = confirmationResult;
    }).catch(function (error) {
      // Error; SMS not sent
      // ...
    });
} */
    </script>
  </body>
</html>