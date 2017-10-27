<html lang="en"><head>
<title>RollCall</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato);
    /* CLIENT-SPECIFIC STYLES */
    #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
    .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
    body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    body{margin:0; padding:0; background-color: #EFECE8;}
    img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
    table{border-collapse:collapse !important;}
    body{height:100% !important; margin:0; padding:0; width:100% !important;}

    /* iOS BLUE LINKS */
    .appleBody a {color:#68440a; text-decoration: none;}
    .appleFooter a {color:#999999; text-decoration: none;}

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        table[class="wrapper"]{
          width:100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        td[class="logo"]{
          text-align: left;
          padding: 20px 0 20px 0 !important;
        }

        td[class="logo"] img{
          margin:0 auto!important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        td[class="mobile-hide"]{
          display:none;}

        img[class="mobile-hide"]{
          display: none !important;
        }

        img[class="img-max"]{
          max-width: 100% !important;
          width: 100% !important;
          height:auto !important;
        }

        /* FULL-WIDTH TABLES */
        table[class="responsive-table"]{
          width:100%!important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        td[class="padding"]{
          padding: 10px 5% 15px 5% !important;
        }

        td[class="padding-copy"]{
          padding: 10px 5% 10px 5% !important;
          text-align: center;
        }

        td[class="padding-meta"]{
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        td[class="no-pad"]{
          padding: 0 0 20px 0 !important;
        }

        td[class="no-padding"]{
          padding: 0 !important;
        }

        td[class="section-padding"]{
          padding: 50px 15px 50px 15px !important;
        }

        td[class="section-padding-bottom-image"]{
          padding: 50px 15px 0 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        td[class="mobile-wrapper"]{
            padding: 10px 5% 15px 5% !important;
        }

        td[class="devices-deployment-name"]{
            font-size: 16px !important;
            padding-top: 3% !important;
        }

        table[class="mobile-button-container"]{
            margin:0 auto;
            width:100% !important;
        }

        a[class="mobile-button"]{
            width:80% !important;
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
        }
    }

    .avatar-alpha {
        margin: 0 auto;
        font-family: 'Lato', Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 1em;
        font-weight: 700;
        color: #FFFFFF;
        text-align: center;
        line-height: 90px;
         width: 90px;
        height: 90px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        max-width: 90px;
        border: 1px solid #DCDCDC;
        background-color: #222222;
    }

    @media screen and (max-width: 375px) {
        td[class="devices-deployment-name"]{
            display: none;
            font-size: 13px !important;
            padding-top: 2% !important;
        }
    }

</style>
</head>
<body style="margin: 0; padding: 0;">

<!-- HEADER -->
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tbody><tr>
        <td bgcolor="#EFECE8">
            <!-- HIDDEN PREHEADER TEXT -->
            <div style="display: none; font-size: 1px; color: #4A4A4A; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">

            </div>
            <div style="padding: 0px 15px 0px 15px;" align="center">
                <table class="wrapper" cellspacing="0" cellpadding="0" border="0" width="500">
                    <!-- LOGO/PREHEADER TEXT -->
                    <tbody><tr>
                        <td style="padding: 20px 0px 30px 0px;" class="logo">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tbody><tr>
                                    <td bgcolor="#EFECE8" align="left" width="100">
                                        <a href="#" target="_blank">
                                          <img alt="RollCall Logo" src="data:image/png;base64,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" style="display: block; font-family: Lato, Helvetica, Arial, sans-serif; color: #4A4A4A; font-size: 16px;" border="0" height="40" width="155">
                                        </a>
                                    </td>
                                    <td class="mobile-hide" bgcolor="#EFECE8" align="right" width="400">
                                        <table cellspacing="0" cellpadding="0" border="0">
                                            <tbody><tr>
                                                <td style="padding: 0 0 5px 0; font-size: 14px; font-family: Lato, Arial, sans-serif; color: #666666; text-decoration: none;" align="right"><span style="color: #4A4A4A; text-decoration: none;">
                                                  <a href="https://{{ $org_subdomain }}.rollcall.io" class="original-only" style="color: #666666; text-decoration: none;">
                                                    {{ $org_subdomain }}.rollcall.io
                                                  </a>
                                                </span></td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </div>
        </td>
    </tr>
</tbody></table>

<!-- ONE COLUMN SECTION -->
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tbody><tr>
        <td style="padding: 35px 15px 35px 15px;" class="section-padding" bgcolor="#FBF9F6" align="center">
            <table class="responsive-table" cellspacing="0" cellpadding="0" border="0" width="500">
                <tbody><tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody><tr>
                              	<td class="padding-copy" align="center">
                                  @if($profile_picture)
                                      <img src="{{ $message->embed($profile_picture) }}" alt="{{$org_name}}" style="display: block; color: #666666; font-family: Lato, Helvetica, arial, sans-serif; font-size: 16px;" class="img-max" border="0" height="80" width="80"></td>
                                  @else
                                      <div class="avatar-alpha">{{$initials}}</div>
                                  @endif
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody><tr>
                                            <td style="font-size: 25px; font-family: Lato, Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy" align="center">
                                              {{ $subject }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Lato, Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy" align="center">
                                              {!! $body !!}
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- BULLETPROOF BUTTON -->
                                    <table class="mobile-button-container" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody><tr>
                                            <td style="padding: 25px 0 0 0;" class="padding-copy" align="center">
                                                <table class="responsive-table" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody><tr>
                                                        <td align="center"><a href="{{ $action_url }}" target="_blank" style="font-size: 16px; font-family: Lato, Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #222222; border-top: 15px solid #222222; border-bottom: 15px solid #222222; border-left: 25px solid #222222; border-right: 25px solid #222222; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">
                                                          {{ $action_text }} →
                                                        </a></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tbody><tr>
                                            <td style="padding: 20px 0 0 0; font-size: 10px; line-height: 25px; font-family: Lato, Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy" align="center">
                                              If you're having trouble selecting the "{{ $action_text }}" button, copy and paste the following URL into your web browser:
                                              <a href="{{ $action_url }}">{{ $action_url }}</a>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

<!-- FOOTER -->
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tbody><tr>
        <td style="padding: 20px 0px;" bgcolor="#EFECE8" align="center">
            <!-- UNSUBSCRIBE COPY -->
            <table class="responsive-table" cellspacing="0" cellpadding="0" border="0" align="center" width="500">
                <tbody><tr>
                    <td style="font-size: 12px; line-height: 18px; font-family: Lato, Helvetica, Arial, sans-serif; color:#666666;" align="center">
                        <span class="appleFooter" style="color:#666666;">RollCall</span><br><a href="https://www.rollcall.io" class="original-only" style="color: #666666; text-decoration: none;">www.rollcall.io</a><span class="original-only" style="font-family: Lato, Arial, sans-serif; font-size: 12px; color: #444444;">
                    </span></td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>



</body></html>