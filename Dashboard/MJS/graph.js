let graphClient = undefined;

function initializeGraphClient(msalClient, account, scopes)
{
  // Create an authentication provider
  const authProvider = new MSGraphAuthCodeMSALBrowserAuthProvider
  .AuthCodeMSALBrowserAuthenticationProvider(msalClient, {
    account: account,
    scopes: scopes,
    interactionType: msal.InteractionType.PopUp
  });

  // Initialize the Graph client
  graphClient = MicrosoftGraph.Client.initWithMiddleware({authProvider});
}

async function getUser() {
  return graphClient
    .api('/me')
    // Only get the fields used by the app
    .select('id,displayName,mail,userPrincipalName,mailboxSettings')
    .get();
}

function checkSupport() {
    let r = graphClient.api('/me/calendar').get()
    console.log(r)
    return r
}


async function getEvents() {
  const user = JSON.parse(sessionStorage.getItem('graphUser'));

  // Convert user's Windows time zone ("Pacific Standard Time")
  // to IANA format ("America/Los_Angeles")
  // Moment needs IANA format
  let ianaTimeZone = getIanaFromWindows(user.mailboxSettings.timeZone);
  console.log(`Converted: ${ianaTimeZone}`);

  // Configure a calendar view for the current week
  // Get midnight on the start of the current week in the user's timezone,
  // but in UTC. For example, for Pacific Standard Time, the time value would be
  // 07:00:00Z
  let startOfWeek = moment.tz(ianaTimeZone).startOf('week').utc();
  // Set end of the view to 7 days after start of week
  let endOfWeek = moment(startOfWeek).add(7, 'day');

  try {
    // GET /me/calendarview?startDateTime=''&endDateTime=''
    // &$select=subject,organizer,start,end
    // &$orderby=start/dateTime
    // &$top=50
    let response = await graphClient
      .api('/me/calendarview')
      // Set the Prefer=outlook.timezone header so date/times are in
      // user's preferred time zone
      .header("Prefer", `outlook.timezone="${user.mailboxSettings.timeZone}"`)
      // Add the startDateTime and endDateTime query parameters
      .query({ startDateTime: startOfWeek.format(), endDateTime: endOfWeek.format() })
      // Select just the fields we are interested in
      .select('subject,organizer,start,end')
      // Sort the results by start, earliest first
      .orderby('start/dateTime')
      // Maximum 50 events in response
      .top(50)
      .get();

    updatePage(Views.calendar, response.value);
  } catch (error) {
    updatePage(Views.error, {
      message: 'Error getting events',
      debug: error
    });
  }
}

async function createNewEvent() {

  $('.load_text').text('Generating Meeting Link')
  $('.modal_back').show()

  const user = JSON.parse(sessionStorage.getItem('graphUser'));

  let urlParams = new URLSearchParams(window.location.search);

  // Get the user's input
  const subject = urlParams.get('T') || 'Oncopadi VTB Meeting'
  const attendees = "superadmin@oncopadiarc.com";
  const start = new Date()
  const end = new Date(new Date().setDate(new Date().getDate() + 1))
  const body = "PROSE Care Meeting With Patients";

  // Require at least subject, start, and end
  if (!subject || !start || !end) {
    updatePage(Views.error, {
      message: 'Please provide a subject, start, and end.'
    });
    return;
  }

  // Build the JSON payload of the event
  let newEvent = {
    subject: subject,
    start: {
      dateTime: start,
      timeZone: user.mailboxSettings.timeZone
    },
    end: {
      dateTime: end,
      timeZone: user.mailboxSettings.timeZone
    },
    isOnlineMeeting: true,
    onlineMeetingProvider: "skypeForConsumer"
  };

  if (attendees) {
    const attendeeArray = attendees.split(';');
    newEvent.attendees = [];

    for (const attendee of attendeeArray) {
      if (attendee.length > 0) {
        newEvent.attendees.push({
          type: 'required',
          emailAddress: {
            address: attendee
          }
        });
      }
    }
  }

  if (body) {
    newEvent.body = {
      contentType: 'text',
      content: body
    };
  }

  try {
    // POST the JSON to the /me/events endpoint
    let r = await graphClient
      .api('/me/events')
      .post(newEvent)
      .then(function(result){
        echoMeetingLink(result.onlineMeetingUrl, urlParams.get('ID'))
      })

    // Return to the calendar view
    getEvents();
  } catch (error) {
    updatePage(Views.error, {
      message: 'Error creating event',
      debug: error
    });
  }

//   await checkSupport();

  function echoMeetingLink(link, meeting_id){
    
    $('.load_text').text('Attaching Meeting Link')

    var formData = [link, meeting_id]

    $.ajax({
        async: false,
        url: './API/attach_meeting_link.php',
        data: { data: formData },
        type: 'POST',
        success: function(data) {
            console.log(data)
            $('.modal_back').hide()
            if(data == '1'){
              Swal.fire('Awesome','Meeting link attached successfully','success')
            }else{
              Swal.fire('Oops','Meeting link failed to attach','error')
            }
        }
    })
  }

}