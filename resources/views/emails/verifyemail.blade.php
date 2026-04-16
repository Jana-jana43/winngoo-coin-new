<!--<h2>Hello {{ $user->name }}</h2>-->

<!--<p>Please verify your account.</p>-->

<!--<a href="{{ $link }}" style="padding:10px 20px;background:#28a745;color:#fff;text-decoration:none;">-->
<!--Verify Email-->
<!--</a>-->




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Winngoo Coin  Account Verification</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>
<body style="margin:0;padding:0;font-family:'DM Sans',sans-serif;">

  <div style="display:none;max-height:0;overflow:hidden;font-size:1px;color:#ede4cc;">Verify your Winngoo Coin account </div>

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
                        <!-- Logo -->
                        <td style="vertical-align:middle;">
                          <img src="https://design.wimbgo.com/coin/frontend/assets/images/w-coin-logo.png"
                               alt="Winngoo Coin" width="130"
                               style="display:block;max-width:150px;width:100%;height:auto;border:0;opacity:0.95;" />
                        </td>
                        <!-- Right tag -->
                        <td style="text-align:right;vertical-align:middle;">
                          <div style="border:1.5px solid rgba(255,255,255,0.55);border-radius:3px;display:inline-block;padding:7px 16px;">
                            <p style="margin:0;font-size:8px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:rgba(255,255,255,0.75);line-height:1;">Account</p>
                            <p style="margin:4px 0 0;font-size:13px;font-weight:700;color:#fff;letter-spacing:0.04em;line-height:1;">Security</p>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>


                <!-- ██ PERFORATED TEAR LINE ██ -->
                <tr>
                  <td style="background:#fff;padding:0;position:relative;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="height:36px;vertical-align:middle;text-align:center;">
                          <span style="font-size:9px;font-weight:600;letter-spacing:0.22em;text-transform:uppercase;color:#c8a030;line-height:1;">Winngoo Coin   Account Verification</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>


                <!-- ██ BODY ██ -->
                <tr>
                  <td style="background:#ffffff;padding:40px 48px 44px;">

                    <h1 style="margin:0 0 14px;font-family:'Playfair Display',serif;font-size:25px;font-weight:700;color:#1a1000;line-height:1.05;letter-spacing:-0.8px;">
                      Hello, <em style="color:#c8900a;">  
                      
                 
                      {{ $user->name }}
                      
                      </em>
                    </h1>

                    <p style="margin:0 0 32px;font-size:14px;font-weight:300;color:#7a6030;line-height:1.9;">
   Click the button below to verify your account and get started:
                    </p>

                    <!-- CTA -->
                    <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:32px;">
                      <tr>
                        <td style="border-radius:50px;background:linear-gradient(135deg,#f5c840,#d49010);box-shadow:0 6px 24px rgba(200,140,0,0.26);">
                          <a href="{{ $link }}" style="display:block;color:#2a1600;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:700;text-decoration:none;padding:15px 44px;letter-spacing:0.4px;">
                           Verify Your Account &rarr;
                          </a>
                        </td>
                      </tr>
                    </table>

                    <!-- Expiry note -->
                   <!-- Expiry note -->
    <!--<p style="margin:0;font-size:13px;font-weight:400;color:#7a6030;line-height:1.8;border-top:1px dashed #f0e090;padding-top:20px;">-->
    <!--This verification link will expire in<strong style="color:#a07010;font-weight:600;"> 10 minutes for security reasons.</strong>-->
    <!-- request this account, please ignore this email.-->
    <!--</p>-->

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