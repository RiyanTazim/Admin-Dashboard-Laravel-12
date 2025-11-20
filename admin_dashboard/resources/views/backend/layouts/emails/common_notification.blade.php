<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $subjectLine ?? 'Notification' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .email-header {
            background-color: #FFE4C4;
            padding: 10px;
            max-width: 100px;
            margin: 0 auto;
            max-height: 40px;
            text-align: center;
            color: #ffffff;
        }

        .email-content {
            padding: 40px;
            color: #333333;
        }

        .email-content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }

        .email-footer {
            background-color: #FFE4C4;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }

        @media screen and (max-width: 600px) {
            .email-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table class="email-container" width="100%" cellpadding="0" cellspacing="0">

                    {{-- Header --}}
                    <tr>
                        <td class="email-header">
                            @if (!empty($logoUrl))
                                <img src="{{ $logoUrl ?? ''}}" alt="Blinke Logo" style="max-width: 100px; height: 50px;">
                            @else
                                <h1>Blinke</h1>
                            @endif
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td class="email-content">
                            <p style="font-size: 18px; margin-top: 0;">
                                Hello {{ $notifiable->name ?? 'there' }},
                            </p>

                            @if (!empty($customMessage))
                                <p>{!! nl2br(e($customMessage)) !!}</p>
                            @else
                                <p>You have received a new notification. Please log in to your account to view more details.</p>
                            @endif

                            <p>
                                Thank you for using our application!
                            </p>

                            <p style="margin-bottom: 0;">
                                Best regards,<br>
                                <strong>Blinke Team</strong>
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td class="email-footer">
                            &copy; {{ date('Y') }} Blinke. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
