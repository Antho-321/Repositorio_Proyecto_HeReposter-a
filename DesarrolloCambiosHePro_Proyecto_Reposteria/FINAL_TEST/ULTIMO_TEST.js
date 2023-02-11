const nodemailer = require("nodemailer");
const { google } = require("googleapis");
const OAuth2 = google.auth.OAuth2;
const accountTransport = require("./account_transport.json");

const mail_rover = async (callback) => {
    const oauth2Client = new OAuth2(
        accountTransport.auth.clientId,
        accountTransport.auth.clientSecret,
        "https://developers.google.com/oauthplayground"
    );
    oauth2Client.setCredentials({
        refresh_token: accountTransport.auth.refreshToken,
        tls: {
            rejectUnauthorized: false
        }
    });
    try {
        const { token } = await oauth2Client.getAccessToken();
        const accessToken = token;
        accountTransport.auth.accessToken = accessToken;
        callback(nodemailer.createTransport(accountTransport));
    } catch (err) {
        console.error(err);
    }
};

async function sendEmail() {
    const para = process.argv[2];
    const asunto = process.argv[3];
    const cuerpo = process.argv[4];
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

    try {
        let info = await transporter.sendMail({
            from: "pankey.ibarra@gmail.com",
            to: para,
            subject: asunto,
            text: cuerpo,
            html: "<b>Cuerpo del correo en HTML</b>",
        });
        console.log("Message sent: %s", info.messageId);
    } catch (err) {
        console.error(err);
    }
}

mail_rover(sendEmail);