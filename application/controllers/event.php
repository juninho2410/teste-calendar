<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class event extends CI_Controller {
function index(){
echo "teste";


}
function insert(){
	session_start();
		$this->load->library('auth_calendar');
		if($this->auth_calendar->isAutenticated()){
		
		
		
		  $calendar = new Google_Calendar();
		  $calendar->setSummary('calendarSummary');

		  //$createdCalendar =  $this->auth_calendar->cal->calendars->insert($calendar);
		  //$this->auth_calendar->cal->calendars->delete($calendar->getId());
		  //print_r($calendar);
		  
		  $calendarList = new Google_CalendarList($this->auth_calendar->cal->calendarList->listCalendarList());
		  //print_r($calendarList->getItems());
		  
		$idCalendars=array();
		while(true) {
			  foreach ($calendarList->getItems() as $calendarListEntry) {
					$calendarListEntry= new Google_CalendarListEntry($calendarListEntry);
					//var_dump($calendarListEntry);
					//echo $calendarListEntry->getSummary();
					
					array_push($idCalendars,$calendarListEntry->getSummary());
				}
		  $pageToken = $calendarList->getNextPageToken();
		  if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$calendarList = $service->calendarList->listCalendarList($optParams);
		  } else {
			break;
		  }
		}
		
		  print_r($idCalendars);
		

			$event = new Google_Event();
			echo "<pre>";
			print_r($this->auth_calendar->cal);
			echo "</pre>";
			
			
			
			$event->setSummary('Appointment');
			$event->setLocation('Somewhere');
			$start = new Google_EventDateTime();
			$start->setDateTime('2012-10-24T10:00:00.000-07:00');
			$event->setStart($start);
			$end = new Google_EventDateTime();
			$end->setDateTime('2012-10-24T10:25:00.000-07:00');
			$event->setEnd($end);
			$attendee1 = new Google_EventAttendee();
			$attendee1->setEmail('attendeeEmail');
			// ...
			$attendees = array($attendee1);
			$event->attendees = $attendees;
			
			echo "<pre>";
			print_r($event->id);
			echo "</pre>";
			$createdEvent = new Google_Event($this->auth_calendar->cal->events->insert('primary', $event));
			echo $createdEvent->getId();
		}
		else{
			echo '<script>location.href="/code-igniter/calendar_auth"</script>';
		}

}

}


?>