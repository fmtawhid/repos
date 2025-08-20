<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailTemplateSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('email_templates')->delete();
    $templates = [
      'welcome-email' => [
        'user_id'   => 1,
        'name'      => 'Welcome Email',
        'subject'   => 'Welcome Email',
        'slug'      => 'welcome-email',
        'type'      => 'welcome-email',
        'variables' => '[name], [email], [phone]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hey
                            [name],
                            thanks for
                            signing up!</p>
                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'registration-verification' => [
        'user_id' => 1,
        'name'      => 'Registration Verification',
        'subject'      => 'Registration Verification',
        'slug'      => 'registration-verification',
        'type'      => 'registration-verification',
        'variables' => '[name], [email], [phone]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hey
                            [name],
                            thanks for
                            signing up!</p>
                          <h4 style="margin-bottom:2px; color:#7E8299">Email Verification
                          </h4>
                          <p style="margin-bottom:2px; color:#7E8299">paragraphs. Please click the button below to verify your email address
                          </p>
                         
                        </div>
                        <!--end:Text-->

                        <!--begin:Action-->
                        <a href="[active_url]" target="_blank"
                          style="background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;">
                          Activate Account
                        </a>
                        <!--begin:Action-->
                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'add-new-customer-welcome-email' => [
        'user_id' => 1,
        'name'      => 'Add New Customer Welcome Email',
        'subject'   => 'Add New Customer Welcome Email',
        'slug'      => 'add-new-customer-welcome-email',
        'type'      => 'add-new-customer-welcome-email',
        'variables' => '[name], [email], [phone], [password], [package], [startDate], [endDate], [price], [method]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
          <div
            style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
              style="border-collapse:collapse">
              <tbody>
                <tr>
                  <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                    <!--begin:Email content-->
                    <div style="text-align:center; margin:0 15px 34px 15px">
                      <!--begin:Logo-->
                      <div style="margin-bottom: 10px">
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                          <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                        </a>
                      </div>
                      <!--end:Logo-->

                      <!--begin:Media-->
                      <div style="margin-bottom: 15px">
                        <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                          style="width: 120px; margin:40px auto;">
                      </div>
                      <!--end:Media-->

                      <!--begin:Text-->
                      <div
                        style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                        <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi [name],
                        We have created account for you . your login credentails here :
                          Email : [email]
                          Phone : [phone]
                          password : [password]
                          <strong> and your package info</strong>:
                          Package name : [package]
                          Price : [price]
                          Payment Method : [method]
                          Start Date : [startDate]
                          End Date : [endDate]
                          </p>
                       
                      </div>
                      <!--end:Text-->
                      <!--begin:Action-->
                      <a href="[login_url]" target="_blank"
                        style="background-color:#29a762; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;">
                        Login
                      </a>
                      <!--begin:Action-->
                    </div>
                    <!--end:Email content-->
                  </td>
                </tr> 

                <tr>
                  <td align="center" valign="center"
                    style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                    <p
                      style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                      It’s all about customers!</p>
                    <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                    <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                        rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                    </p>
                    <p>We serve Mon-Fri, 9AM-18AM</p>
                  </td>
                </tr>  
                <tr>
                  <td align="center" valign="center"
                    style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                    <p> © Copyright ThemeTags.
                      <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                        style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                      from newsletter.
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>',
      ],
      'purchase-package' => [
        'user_id' => 1,
        'name'      => 'Purchase Package',
        'subject'      => 'Purchase Package',
        'slug'      => 'purchase-package',
        'type'      => 'purchase-package',
        'variables' => '[name], [email], [phone], [package],[startDate], [endDate],[price]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi
                            [name],
                            thanks for
                            purchase [package].</p>
                            <p>Your [Package] price [price] and start from [startDate]</p>
                            <p>Your [Package] Will be expire [endDate]</p>                                 
                        </div>
                        
                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'admin-assign-package' => [
        'user_id' => 1,
        'name'      => 'Admin Assign Package',
        'subject'      => 'Admin Assign Package',
        'slug'      => 'admin-assign-package',
        'type'      => 'admin-assign-package',
        'variables' => '[name], [email], [phone], [package],[startDate], [endDate],[price]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi
                            [name],
                           Admin Assigned this <strong>[package]</strong> for you.
                            purchase <strong>[package]</strong>.</p>
                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>
                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>
                
                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'offline-payment-request' => [
        'user_id' => 1,
        'name'      => 'Offline Payment Request',
        'subject'      => 'Offline Payment Request',
        'slug'      => 'offline-payment-request',
        'type'      => 'offline-payment-request',
        'variables' => '[name], [email], [phone], [package],[price], [method],[note]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi, <br>
                           [name] request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>
                            <p>And  <strong>[package]</strong> price  <strong>[price]</strong></p>                         

                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'offline-payment-request-approve' => [
        'user_id' => 1,
        'name'      => 'Offline Payment Request Approve',
        'subject'      => 'Offline Payment Request Approve',
        'slug'      => 'offline-payment-request-approve',
        'type'      => 'offline-payment-request-approve',
        'variables' => '[name], [email], [phone], [package],[startDate], [endDate],[price], [method],[note]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi [name], <br>
                           Your request a offline payment has been approved [package]</strong> using this payment method <strong>[method]</strong> .</p>
                                                  
                            <p>Your  <strong>[package]</strong> price  <strong>[price]</strong> and start from [startDate]</p>
                            <p>Your [Package] Will be expire <strong>[endDate]</strong></p>
                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'offline-payment-request-rejected' => [
        'user_id' => 1,
        'name'      => 'Offline Payment Request Reject',
        'subject'   => 'Offline Payment Request Reject',
        'slug'      => 'offline-payment-request-rejected',
        'type'      => 'offline-payment-request-rejected',
        'variables' => '[name], [email], [phone], [package],[price], [method],[note]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi [name], <br>
                           Your requested a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> has been <strong>Rejected</strong> .</p>
                                        

                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',

      ],
      'offline-payment-request-add-note' => [
        'user_id' => 1,
        'name'      => 'Offline Payment Request Add Note',
        'subject'   => 'Offline Payment Request Add Note',
        'slug'      => 'offline-payment-request-add-note',
        'type'      => 'offline-payment-request-add-note',
        'variables' => '[name], [email], [phone], [package],[price], [method],[note]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hi [name], <br>
                           Your request a offline payment for purchase <strong>[package]</strong> using this payment method <strong>[method]</strong> .</p>
                            <p>But Admin Want more information from you</p>
                            <p>[note]</p>                         

                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',
      ],
      'ticket-assign' => [
        'user_id' => 1,
        'name'      => 'Assign Ticket',
        'subject'   => 'Assign Ticket',
        'slug'      => 'ticket-assign',
        'type'      => 'ticket-assign',
        'variables' => '[name], [email], [phone], [title], [ticketId]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hey, <br>
                            New Ticket from <strong>[name]</strong> and [ticketId] .</p>
                          

                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',
      ],
      'ticket-reply' => [
        'user_id' => 1,
        'name'      => 'Ticket Reply',
        'subject'   => 'Ticket Reply',
        'slug'      => 'ticket-reply',
        'type'      => 'ticket-reply',
        'variables' => '[name], [email], [phone], [title],[titleId]',
        'code'      => '<div style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
            <div
              style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 0px; margin:0 auto; max-width: 600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                style="border-collapse:collapse">
                <tbody>
                  <tr>
                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                      <!--begin:Email content-->
                      <div style="text-align:center; margin:0 15px 34px 15px">
                        <!--begin:Logo-->
                        <div style="margin-bottom: 10px">
                          <a href="https://writerap.themetags.net/" rel="noopener" target="_blank">
                            <img alt="Logo" src="https://writerap.themetags.net/public/uploads/media/bwZeX0SwgEwevLfO0yCGNAvxkFq8vdlVAt6swLQX.png" style="height: 35px">
                          </a>
                        </div>
                        <!--end:Logo-->

                        <!--begin:Media-->
                        <div style="margin-bottom: 15px">
                          <img alt="Logo" src="https://writerap.themetags.net/public/images/like.svg"
                            style="width: 120px; margin:40px auto;">
                        </div>
                        <!--end:Media-->

                        <!--begin:Text-->
                        <div
                          style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                          <p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Hey, <br>
                            Ticket reply from  <strong>[name]</strong> and [ticketId] .</p>
                          

                         
                        </div>
                        <!--end:Text-->

                      </div>
                      <!--end:Email content-->
                    </td>
                  </tr> 

                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
                      <p
                        style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ">
                        It’s all about customers!</p>
                      <p style="margin-bottom:2px">Call our customer care number: 540-907-0453</p>
                      <p style="margin-bottom:4px">You may reach us at <a href="https://writerap.themetags.net/"
                          rel="noopener" target="_blank" style="font-weight: 600">admin@themetags.com</a>.
                      </p>
                      <p>We serve Mon-Fri, 9AM-18AM</p>
                    </td>
                  </tr>  
                  <tr>
                    <td align="center" valign="center"
                      style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                      <p> © Copyright ThemeTags.
                        <a href="https://writerap.themetags.net/" rel="noopener" target="_blank"
                          style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                        from newsletter.
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>',
      ],
    ];

    DB::table('email_templates')->insert($templates);
  }
}
