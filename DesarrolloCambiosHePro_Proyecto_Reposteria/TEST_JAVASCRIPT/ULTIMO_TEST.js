const nodemailer = require("nodemailer");
const { google } = require("googleapis");
const OAuth2 = google.auth.OAuth2;
const accountTransport = require("./account_transport.json");
//let 
const mail_rover = async (callback) => {
    const oauth2Client = new OAuth2(
        accountTransport.auth.clientId,
        accountTransport.auth.clientSecret,
        "https://developers.google.com/oauthplayground",
    );
    oauth2Client.setCredentials({
        refresh_token: accountTransport.auth.refreshToken,
        tls: {
            rejectUnauthorized: false
        }
    });
    oauth2Client.getAccessToken((err, token) => {
        if (err)
            return console.log(err);;
        const accessToken = token;
        accountTransport.auth.accessToken = accessToken;
        callback(nodemailer.createTransport(accountTransport));
    });
};

async function sendEmail() {
    const accessToken = accountTransport.auth.accessToken;
  let transporter = nodemailer.createTransport({
    host: "smtp.gmail.com",
    port: 465,
    secure: true, // use SSL
    auth: {
      type: "OAuth2",
      user: "pankey.ibarra@gmail.com",
      clientId: "192282288096-u9r7es2bg7js56q1k3c8i7tncvi0mnq8.apps.googleusercontent.com",
      clientSecret: "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",
      accessToken: accessToken,
      refreshToken: "1//042B5EMDogIMgCgYIARAAGAQSNwF-L9Iref0Zipaiv9pKC7xvuWZ__QcFtMp-DeXYZ4l5y9avzuSQZsr5LEIPGUI3giSelfYzAmQ",
    },
  });

  let info = await transporter.sendMail({
    from: "pankey.ibarra@gmail.com", // sender address
    to: "anthonyluisluna225@gmail.com", // list of receivers
    subject: "OTRA PRUEBA", // Subject line
    text: "TESTEANDOOOO", // plain text body
    html: "<b>Cuerpo del correo en HTML</b>", // html body
  });

  console.log("Message sent: %s", info.messageId);
}

sendEmail();