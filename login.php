
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8' />
  </head>
  <body>
   
    <button id="authorize-button" style="visibility: hidden">Authorize</button>
    <script type="text/javascript">
      
      var clientId = '396111735866.apps.googleusercontent.com';
      var apiKey = 'AIzaSyDOh4Lx8s5PK9XnQuARa0K_es4QMdY0yvQ';
      var scopes = 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile';
 function handleClientLoad() {
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,1);
      }

      function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
      }


      function handleAuthResult(authResult) {
        var authorizeButton = document.getElementById('authorize-button');
        if (authResult && !authResult.error) {
          authorizeButton.style.visibility = 'hidden';
          makeApiCall();
        } else {
          authorizeButton.style.visibility = '';
          authorizeButton.onclick = handleAuthClick;
        }
      }

      function handleAuthClick(event) {
    	  try {
    	        window.setTimeout(function () {
    	            gapi.auth.authorize({ client_id: clientId, scope: scopes, immediate: false }, handleAuthResult);
    	        }, 1000);
    	    } catch (e) { alert(e.message); }
      }

      // Load the API and make an API call.  Display the results on the screen.
      function makeApiCall() {
        gapi.client.load('plus', 'v1', function() {
          var request = gapi.client.plus.people.get({
            'userId': 'me'
          });
          request.execute(function(resp) {
            var heading = document.createElement('h4');
            var image = document.createElement('img');
            image.src = resp.image.url;
            heading.appendChild(image);
            heading.appendChild(document.createTextNode(resp.displayName));

            document.getElementById('content').appendChild(heading);
          });
        });
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
    <div id="content"></div>
    <p>Retrieves your profile name using the Google Plus API.</p>
  </body>
</html>
//added this line in my local
