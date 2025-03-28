<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        body {
            height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            font-family: "Arial", sans-serif;
            line-height: normal;
        }

        .max-600 {
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        h2 {
            font-size: 22px;
            font-weight: bold;
            color: #00364A;
            line-height: normal;
            margin: 0;
            padding: 0;
        }

        h3 {
            margin: 0;
            padding: 0;
            font-weight: 400;
            color: #00364A;
            font-size: 16px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        p {
            padding: 0;
            margin: 0;
            font-size: 16px;
            line-height: 20px;
            color: #00364A;
        }

        table {
            border: 2px solid #E6EAED;
            padding: 50px;
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 auto;
        }

        table tr {
            padding: 0;
            vertical-align: top;
        }

        p span {
            color: #BBBBBB
        }

        p em {
            color: #42A5ED;
            font-style: normal;
        }


        @media only screen and (max-width:600px) {
            h2 {
                font-size: 26px !important;
            }

            h2 span {
                padding-bottom: 5px !important;
            }

            .responsive-table {
                width: 96% !important;
                padding: 30px;
                height: 250px !important;
            }
        }

        @media only screen and (max-width:360px) {
            h2 {
                font-size: 22px !important;
            }

            .mt-20 {
                margin-bottom: 20px !important;
            }

            .padd-30 {
                padding: 30px 20px !important;
            }

            .responsive-table {
                padding: 20px 15px;
                width: 96% !important;
                height: 230px !important;
            }

            .dis-block {
                display: block !important;
            }

            .marg-none {
                margin: 0 !important;
            }
        }
    </style>
</head>

<body>

    <table width="500" align="center" class="responsive-table" height="286">
        <tr>
            <td>
                <h2><span
                        style="border-bottom:2px solid #219be6; padding-bottom:10px; padding-right:0px;">Hello</span>,&nbsp;
                </h2>
            </td>
        </tr>
        <tr style="margin-bottom:15px;">
            <td>
                <h3>Welcome to {{ config('app.name') }}</h3>
            </td>
        </tr>
        <tr height="30">
            <td>Email: {{ $user['email'] }}</td>
        </tr>
        <tr height="30">
            <td>Password: {{ $plainPassword }}</td>
        </tr>
        <tr height="30">
            <td>Login with your email and password.</td>
        </tr>
        <tr height="30">
            <td style="mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;">
                <a href="{{ $url }}"
                    style="background-color: #7367f0;font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;width:100px;">Login
                    link</a>
            </td>
        </tr>
    </table>
</body>

</html>
