<?php
function filterTicketsByStatus($tickets, $status) {
  $filteredTickets = array_filter($tickets, function($ticket) use ($status) {
    return $ticket['ticket_status'] === $status;
  });
  return $filteredTickets;
}
function filterTicketsByPriority($tickets, $priority) {
  $filteredTickets = array_filter($tickets, function($ticket) use ($priority) {
    return $ticket['ticket_priority'] == $priority;
  });
  return $filteredTickets;
}
function filterTicketsByDepartment($tickets, $department) {
  $filteredTickets = array_filter($tickets, function($ticket) use ($department) {
    return $ticket['ticket_department_id'] == $department;
  });
  return $filteredTickets;
}
function filterTicketsByRegistrationTime($tickets, $timeRange)
{
    $filteredTickets = [];
    $currentTime = time();

    switch ($timeRange) {
        case 'today':
            $startTime = strtotime('today');
            break;

        case 'yesterday':
            $startTime = strtotime('yesterday');
            $endTime = strtotime('today') - 1;
            break;

        case '2 days ago':
            $startTime = strtotime('-2 days');
            $endTime = strtotime('-1 day') - 1;
            break;

        case 'last 7 days':
            $startTime = strtotime('-7 days');
            break;

        case 'last 2 weeks':
            $startTime = strtotime('-2 weeks');
            break;

        case 'this month':
            $startTime = strtotime('-1 month');
            break;

        case 'last 2 months':
            $startTime = strtotime('-2 months');
            break;

        case 'this year':
            $startTime = strtotime('-1 year');
            break;

        default:
            // Invalid time range, return all tickets
            return $tickets;
    }

    // Filter the tickets based on the registration time
    foreach ($tickets as $ticket) {
        $registrationTime = DateTime::createFromFormat('d/m/Y H:i', $ticket['ticket_register_time']);

        if ($registrationTime !== false) {
            $ticketTime = $registrationTime->getTimestamp();

            if (isset($endTime)) {
                if ($ticketTime >= $startTime && $ticketTime <= $endTime) {
                    $filteredTickets[] = $ticket;
                }
            } else {
                if ($ticketTime >= $startTime && $ticketTime <= $currentTime) {
                    $filteredTickets[] = $ticket;
                }
            }
        }
    }

    return $filteredTickets;
}
?>