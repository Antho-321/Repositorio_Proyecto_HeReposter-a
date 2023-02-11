// Load the Google Identity Services client library
var script = document.createElement('script');
script.src = 'https://accounts.google.com/gsi/client';
document.head.appendChild(script);

script.onload = function () {
  // Initialize the API client with the desired API key and scope
  gapi.auth2.init({
    client_id: '192282288096-u9r7es2bg7js56q1k3c8i7tncvi0mnq8.apps.googleusercontent.com',
    scope: 'https://www.googleapis.com/auth/gmail.send'
  }).then(function () {
    // Construct the email message
    var message = "To: anthonyluisluna225@gmail.com\n" +
      "Subject: EMAIL_SUBJECT\n\n" +
      "EMAIL_BODY";
    var base64EncodedEmail = btoa(message);

    // Call the Gmail API to send the email
    var request = gapi.client.gmail.users.messages.send({
      userId: 'me',
      resource: {
        raw: base64EncodedEmail
      }
    });

    request.execute(function (response) {
      console.log(response);
    });
  });
};