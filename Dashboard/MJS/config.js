const msalConfig = {
  auth: {
    clientId: '547eb884-898f-42a1-adfd-677423eb30ce',
    redirectUri: 'http://localhost/Oncopadi/Dashboard/MS'
  }
};

const msalRequest = {
  scopes: [
    'user.read',
    'mailboxsettings.read',
    'calendars.readwrite'
  ]
}