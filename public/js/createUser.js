let submitMail = false;
let submitPassword = false;
let passwordCheck = new PasswordCheck("createuser_pwd1", "createuser_pwd2", "createuser_notice_pwd", "createuser_submit");
let mailCheck = new MailCheck(mails, "createuser_mail", "createuser_notice_mail", "createuser_submit");