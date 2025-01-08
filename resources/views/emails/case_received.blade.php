<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Received</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #5a5a5a;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            font-size: 14px;
            text-align: center;
            color: #777;
            margin-top: 40px;
        }

        .footer p {
            margin: 5px 0;
        }

        .case-id {
            font-weight: bold;
            color: #2d87f0;
        }

        .case-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e1e1e1;
        }

        .case-details p {
            margin: 5px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #2d87f0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn:hover {
            background-color: #1c6bb5;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Case Has Been Received!</h1>
        </div>

        <div class="content">
            <p>Dear {{ $customer_name }},</p>

            <p>Thank you for reaching out to us. We have received your case and will begin processing it shortly.</p>

            <div class="case-details">
                <p><strong>Case Number:</strong> <span class="case-id">{{ $case_number }}</span></p>
                <p><strong>Submission Date:</strong> {{ $date_opened }}</p>
                <p><strong>Case Description:</strong> {{ $problem_description }}</p>
            </div>

            <a href="{{ $tracking_link }}" class="btn">Track Your Case</a>

            <p>
                {{-- We will keep you updated on the progress of your case.  --}}
                Further if you have any questions, feel free to contact us.
            </p>
        </div>

        <div class="footer">
            <p>Best regards,</p>
            <p><strong>{{ $company_name }}</strong></p>
            <p>
                <a href="mailto:{{$company_email}}">{{$company_email}}</a>
                |
                <a href="{{$company_website}}">Visit Our Website</a>
            </p>
        </div>
    </div>
</body>
</html>
