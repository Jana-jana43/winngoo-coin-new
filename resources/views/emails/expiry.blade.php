<!--<h2>Hello {{ $user->name }}</h2>-->

<!--<p>Your mining plan is going to expire soon.</p>-->

<!--<p><strong>Due Date:</strong> {{ $dueDate }}</p>-->

<!--<p>Please renew your plan to continue the service.</p>-->

<!--Thanks,<br>-->
<!--Your Team-->




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Activation Reminder – Winngoo Coin</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>
<body style="margin:0;padding:0;font-family:'DM Sans',sans-serif;">

  <div style="display:none;max-height:0;overflow:hidden;font-size:1px;color:#ede4cc;">Your Winngoo Coin monthly activation is due soon.</div>

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding:52px 16px;">
    <tr>
      <td align="center">
        <table width="500" cellpadding="0" cellspacing="0" border="0" style="max-width:500px;width:100%;">
          <tr>
            <td style="border-radius:4px;overflow:hidden;box-shadow:0 8px 48px rgba(140,100,0,0.16);">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">


                <!-- ██ TOP TICKET STUB — gold ██ -->
                <tr>
                  <td style="background:linear-gradient(135deg,#e8b820 0%,#c88000 100%);padding:36px 48px 32px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="vertical-align:middle;">
                          <img src="https://design.wimbgo.com/coin/frontend/assets/images/w-coin-logo.png"
                               alt="Winngoo Coin" width="130"
                               style="display:block;max-width:150px;width:100%;height:auto;border:0;opacity:0.95;" />
                        </td>
                        <td style="text-align:right;vertical-align:middle;">
                          <div style="border:1.5px solid rgba(255,255,255,0.55);border-radius:3px;display:inline-block;padding:7px 16px;">
                            <p style="margin:0;font-size:8px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:rgba(255,255,255,0.75);line-height:1;">Action</p>
                            <p style="margin:4px 0 0;font-size:13px;font-weight:700;color:#fff;letter-spacing:0.04em;line-height:1;">Required</p>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>


                <!-- ██ PERFORATED TEAR LINE ██ -->
                <tr>
                  <td style="background:#fff;padding:0;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="height:36px;vertical-align:middle;text-align:center;">
                          <span style="font-size:9px;font-weight:600;letter-spacing:0.22em;text-transform:uppercase;color:#c8a030;line-height:1;">Winngoo Coin &middot; Monthly Activation Reminder</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>


                <!-- ██ BODY ██ -->
                <tr>
                  <td style="background:#ffffff;padding:40px 48px 44px;">

                    <!-- Reminder label -->
                    <p style="margin:0 0 6px;font-size:10px;font-weight:600;letter-spacing:0.28em;text-transform:uppercase;color:#c8a030;">Activation Reminder</p>

                    <!-- Decorative rule -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:18px;">
                      <tr>
                        <td width="40" style="height:2px;background:#f5c518;"></td>
                        <td style="height:1px;background:#f5eca0;"></td>
                      </tr>
                    </table>

                    <h1 style="margin:0 0 28px;font-family:'Playfair Display',serif;font-size:25px;font-weight:700;color:#1a1000;line-height:1.05;letter-spacing:-0.8px;">
                      Dear, <em style="color:#c8900a;font-style:italic;">{{ $user->name }}</em>
                    </h1>

                    <p style="margin:0 0 18px;font-size:14px;font-weight:300;color:#7a6030;line-height:1.9;">
                      Your monthly mining activation for Winngoo Coin is now due. Activating on time ensures your mining cycle continues without interruption and your progress remains fully intact for this month.
                    </p>

                    <!-- Activation Details Box -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 28px;">
                      <tr>
                        <td style="border:1.5px dashed #f0e090;border-radius:3px;padding:22px 28px;background:#fffdf3;">
                          <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td style="padding-bottom:14px;">
                                <p style="margin:0;font-size:8px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:#c8a030;line-height:1;">Activation Details</p>
                              </td>
                            </tr>
                            <!--<tr>-->
                            <!--  <td style="padding-bottom:10px;">-->
                            <!--    <table width="100%" cellpadding="0" cellspacing="0" border="0">-->
                            <!--      <tr>-->
                            <!--        <td style="font-size:12px;font-weight:300;color:#7a6030;line-height:1;">Activation Month</td>-->
                            <!--        <td style="text-align:right;font-size:13px;font-weight:600;color:#1a1000;line-height:1;">July 2026</td>-->
                            <!--      </tr>-->
                            <!--    </table>-->
                            <!--  </td>-->
                            <!--</tr>-->
                            <tr>
                              <td style="border-top:1px solid #f5eca0;padding-top:10px;padding-bottom:10px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                  <tr>
                                    <td style="font-size:12px;font-weight:300;color:#7a6030;line-height:1;">Due Date</td>
                                    <td style="text-align:right;font-size:13px;font-weight:600;color:#1a1000;line-height:1;">{{ $dueDate }}</td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <!--<tr>-->
                            <!--  <td style="border-top:1px solid #f5eca0;padding-top:10px;">-->
                            <!--    <table width="100%" cellpadding="0" cellspacing="0" border="0">-->
                            <!--      <tr>-->
                            <!--        <td style="font-size:12px;font-weight:300;color:#7a6030;line-height:1;">Current Status</td>-->
                            <!--        <td style="text-align:right;font-size:13px;font-weight:600;color:#c88000;line-height:1;">Pending</td>-->
                            <!--      </tr>-->
                            <!--    </table>-->
                            <!--  </td>-->
                            <!--</tr>-->
                          </table>
                        </td>
                      </tr>
                    </table>

                    <!-- Regards -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="border-top:1px dashed #f0e090;padding-top:24px;">
                          <p style="margin:0 0 2px;font-size:13px;font-weight:300;color:#7a6030;line-height:1.8;">Best Regards,</p>
                          <p style="margin:0;font-size:14px;font-weight:600;color:#2a1800;">Winngoo Coin Team</p>
                        </td>
                      </tr>
                    </table>

                  </td>
                </tr>


                <!-- ██ FOOTER STUB ██ -->
                <tr>
                  <td style="background:#fdf6dc;padding:20px 48px;text-align:center;">
                    <p style="margin:0;font-size:11px;color:#c8a84a;">&copy; 2026 Winngoo Coin &middot; All Rights Reserved</p>
                  </td>
                </tr>


              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

</body>
</html>