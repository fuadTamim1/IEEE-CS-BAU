<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Ticket Response</title>
</head>
<body>
    <h2>Hello {{ $ticket->first_name }} {{ $ticket->last_name }},</h2>

    <p>Thank you for contacting IEEE CS. We have responded to your request below:</p>

    <blockquote style="border-left: 4px solid #ccc; margin: 16px 0; padding-left: 12px;">
        {!! nl2br(e($reply->message)) !!}
    </blockquote>

    <p><strong>Your original message:</strong></p>
    <blockquote style="border-left: 4px solid #eee; margin: 16px 0; padding-left: 12px;">
        {!! nl2br(e($ticket->message)) !!}
    </blockquote>

    <p>Best regards,<br>IEEE Computer Society Team</p>
</body>
</html>
