<!DOCTYPE html>
<html>

<head>
    <title> cv-manager </title>
</head>

<body>

    hey {{ $details['user'] }} <br>

    this is to notify you that you are invited for {{ $details['status'] }} as
    {{ $details['technology'] }} <br>
    date: {{ $details['interview_date'] }}<br>
    Assigned Interviewer: {{ $details['interviewers_list'] }}
    <p>plese complete this taks: {{ $details['task'] }} </p>
    please contact if you have any queries. <br>

    <p>Thank you</p>
</body>

</html>
