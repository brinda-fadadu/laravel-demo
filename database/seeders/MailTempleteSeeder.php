<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailTempleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::truncate();
        $data = [
            [
                'title' => "Confirmation Mail",
                'subject' => "Email Verification Mail",
                'description' => "<td align='center' class='sm-px-24' style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;\">
                <table style=\"width: 100%;\" cellpadding='0' cellspacing='0' role='presentation'>
                <tr>
                    <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                    <p style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;\"> Hey</p>
                    <p style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;\">
                        {{ name }}!
                    </p>
                    <p class='sm-leading-32' style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px; font-size: 24px; font-weight: 600; color: #263238;\"> Welcome to the project_name Community! 👋 </p>
                    <p style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;\">To finalize your membership, please verify your email address by clicking the button below and start your health journey!</p>
                    <table cellpadding='0' cellspacing='0' role='presentation'>
                        <tr>
                        <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'>
                            <a href='{{ url }}' style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\">Verify Email Now &rarr;</a></button>
                        </td>
                        </tr>
                    </table>
                    <table style=\"width: 100%;\" cellpadding='0' cellspacing='0' role='presentation'>
                        <tr>
                        <td style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;\">
                            <div style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;\"> &zwnj;</div>
                        </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 20px;\"></td>
                </tr>
                <tr>
                    <td style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 16px;\"></td>
                </tr>
                </table>
                </td>",

            ],
            [
                'title' => "Welcome Email",
                'subject' => "Welcome To project_name",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                  <tr>
                    <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                      <p style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'> Hey</p>
                      <p style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>
                        {{ name }}!
                      </p>
                      <p class='sm-leading-32' style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px; font-size: 24px; font-weight: 600; color: #263238;'> Welcome to the project_name! 👋 </p>
                          <p style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>
                              Email: {{ email }}
                          </p>
                          <p style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>
                              Password: {{ password }}
                          </p>
                          <p style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>
                              Login with your email and password.
                          </p>

                      <table cellpadding='0' cellspacing='0' role='presentation'>
                        <tr>
                          <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;'>
                          <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'>
                          <a href='{{ url }}'  style=\"font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\">Login
                                  link &rarr;</a></button>
                          </td>
                        </tr>
                      </table>
                      <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                        <tr>
                          <td style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                            <div style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'> &zwnj;</div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                  </tr>
                  <tr>
                    <td style='font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                  </tr>
                </table>
              </td>",
            ],
            [
                'title' => "Nutrition approval",
                'subject' => "Nutrition approval mail",
                'description' => "<td align='center' class='sm-px-24'
                style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24'
                            style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p
                                style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>
                                Hey</p>
                                <p
                                style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'
                                >
                                    {{ name }}!
                                </p>

                            <p
                                style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>
                                You as a nutritionist has been approved please login using below link
                            </p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td
                                        style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'>
                                        <a href='{{ url }}'
                                            style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>Login From Our Website &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0'
                                role='presentation'>
                                <tr>
                                    <td
                                        style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div
                                            style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>
                                            &zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'>
                        </td>
                    </tr>
                </table>
            </td>",
            ],
            [
                'title' => "Recipe Approval",
                'subject' => "Recipe Approval",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>{{ name }}!</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>I am seeking approval for a new recipe to be added to our collection. Details are as follows:<br>Recipe Name: {{ recipename }}</p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>Take An Action &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                    </tr>
                </table>
                </td>",

            ],
            [
                'title' => "Recipe Approved",
                'subject' => "Recipe Approved",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>{{ name }}!</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>Your recipe has been approved by admin. Please click on the link below to proceed further.<br>Recipe Name: {{ recipename }}</p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>View Recipe &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                    </tr>
                </table>
                </td>",

            ],
            [
                'title' => "New Member",
                'subject' => "Member Invitation",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                    <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                        <tr>
                            <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                                <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                                <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>We hope this message finds you in good spirits. We are excited to extend a warm invitation for you to join {{ config('app.name') }} as a valued member.</p>
                                <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>{{ personalmessage }}</p>
                                <table cellpadding='0' cellspacing='0' role='presentation'>
                                    <tr>
                                        <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                            <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>Sign Up Link &rarr;</a></button>
                                        </td>
                                    </tr>
                                </table>
                                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                    <tr>
                                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                            <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                        </tr>
                        <tr>
                            <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                        </tr>
                    </table>
                    </td>",

            ],
            [
                'title' => "Forgot Password",
                'subject' => "Forgot Password",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>{{ name }}!</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>You have requested to reset the email associated with your project_name account. You can reset your password for your project_name account by clicking the link below.</p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>Reset Password &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                    </tr>
                </table>
                </td>"
            ],
            [
                'title' => "Reset Password",
                'subject' => "Reset Password",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>{{ name }}!</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>Your password has been successfully reset. You can now log in to your project_name account using your new password. Click the link provided below to access your account.</p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>Login Link &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                    </tr>
                </table>
                </td>"
            ],
            [
                'title' => "Recipe Rejected",
                'subject' => "Recipe Rejected",
                'description' => "<td align='center' class='sm-px-24' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly;'>
                <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                    <tr>
                        <td class='sm-px-24' style='mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif; font-size: 16px; line-height: 24px; color: #626262;'>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;'>Hey</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;'>{{ name }}!</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>Your recipe has been rejected by admin. <br>Recipe Name: {{ recipename }}</p>
                            <p style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;'>Reason: {{ reason }}</p>
                            <table cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='mso-line-height-rule: exactly; mso-padding-alt: 16px 24px; border-radius: 4px; background-color: #199DD7; font-family: Montserrat, -apple-system, \"Segoe UI\", sans-serif;'>
                                        <button style='box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";color:#fff;background-color:#3869d4;border-radius:8px;padding:10px 20px;border:none;text-decoration:none;cursor:pointer;'><a href='{{ url }}' style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; display: block; padding-left: 24px; padding-right: 24px; padding-top: 16px; padding-bottom: 16px; font-size: 16px; font-weight: 600; line-height: 100%; color: #ffffff; text-decoration: none;\'>View Recipe &rarr;</a></button>
                                    </td>
                                </tr>
                            </table>
                            <table style='width: 100%;' cellpadding='0' cellspacing='0' role='presentation'>
                                <tr>
                                    <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;'>
                                        <div style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 1px; background-color: #eceff1; line-height: 1px;'>&zwnj;</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 20px;'></td>
                    </tr>
                    <tr>
                        <td style='font-family: \"Montserrat\", sans-serif; mso-line-height-rule: exactly; height: 16px;'></td>
                    </tr>
                </table>
                </td>",

            ],
        ];

        foreach ($data as $item) {
            MailTemplate::create($item);
        }
    }
}
