<!DOCTYPE html>
<html lang="en" class="light-style">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Email Notification</title>
  <style type="text/css">
    /* General styling */
    body {
      margin: 0;
      padding: 0;
      width: 100% !important;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f0f2f5;
      color: #4d4d4d;
    }

    table {
      border-spacing: 0;
      width: 100%;
    }

    td {
      padding: 0;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #f8f9fa;
      text-align: center;
      padding: 20px;
    }

    .header img {
      max-height: 50px;
    }

    .content {
      padding: 20px 30px;
    }

    .content h1 {
      font-size: 24px;
      font-weight: 700;
      color: #333333;
      margin: 0 0 10px;
    }

    .content p {
      font-size: 16px;
      line-height: 1.5;
      color: #555555;
      margin: 0 0 15px;
    }

    .highlight {
      color: #ff6b6b;
      font-weight: 700;
    }

    .table-container {
      margin: 20px 0;
    }

    .table-container table {
      width: 100%;
      border-collapse: collapse;
    }

    .table-container th,
    .table-container td {
      padding: 10px;
      border: 1px solid #e5e5e5;
      text-align: left;
      font-size: 14px;
    }

    .table-container th {
      background-color: #f8f9fa;
      font-weight: bold;
    }

    .button-container {
      text-align: center;
      margin: 30px 0;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      color: #ffffff;
      background-color: #3b82f6;
      border-radius: 4px;
    }

    .footer {
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: #aaaaaa;
    }
  </style>
</head>
<body>
  <center>
    <table role="presentation" class="email-container">
      <!-- Header Section -->
      <tr>
        <td class="header">
          <img src="http://domain_name/project_name/uploads/user/2023/11/project_name-1afd991002e3f68e95922e8edc588d3b.png" alt="project_name Logo" />
        </td>
      </tr>

      <!-- Content Section -->
      <tr>
        <td class="content">
          <h1>Hey <span class="highlight">{{ $user->name }}</span>!</h1>

          <!-- Table Section -->
          <div class="table-container">
            <p>A new grocery list for the upcoming week has been created as below.</p>
            @if ($groceries->isNotEmpty())
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($groceries as $grocery)
                    <tr>
                      <td>{{ $grocery->name }}</td>
                      <td>{{ $grocery->amount }} {{ $grocery->unit }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <p>You have no groceries scheduled for deletion.</p>
            @endif
          </div>
        </td>
      </tr>

      <!-- Footer Section -->
      <tr>
        <td class="footer">
          <p>&copy; {{ date('Y') }} project_name. All rights reserved.</p>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>
