<!DOCTYPE html>
<html lang="en">
<head>
<title>TenFour</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
          max-width: 80px !important;
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
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#EFECE8">
            <!-- HIDDEN PREHEADER TEXT -->
            <div style="display: none; font-size: 1px; color: #4A4A4A; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                    {{ $msg }}
            </div>
            <div align="center" style="padding: 0px 15px 0px 15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="500" class="wrapper">
                    <!-- LOGO/PREHEADER TEXT -->
                    <tr>
                        <td style="padding: 20px 0px 30px 0px;" class="logo">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td bgcolor="#EFECE8" width="100" align="left">
                                        <a href="#" target="_blank">
                                          <img alt="TenFour"
                                            src="{{ $message->embed(public_path() . '/images/tenfour.png') }}"
                                            style="display: block; font-family: Lato, Helvetica, Arial, sans-serif; color: #4A4A4A; font-size: 16px;" border="0" height="40" width="155">
                                        </a>
                                    </td>
                                    <td bgcolor="#EFECE8" width="400" align="right" class="mobile-hide">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="right" style="padding: 0 0 5px 0; font-size: 14px; font-family: Lato, Arial, sans-serif; color: #666666; text-decoration: none;"><span style="color: #4A4A4A; text-decoration: none;">
                                                    <a href="https://{{ $org_subdomain }}.tenfour.org" class="original-only" style="color: #666666; text-decoration: none;">
                                                        {{ $org_subdomain }}.tenfour.org
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<!-- ONE COLUMN SECTION -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#FBF9F6" align="center" style="padding: 35px 15px 35px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                <tr>
                    <td>
                        <!-- TenFour -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border: 1px solid #E6E6DD; box-shadow: 0 1px 3px rgba(0,0,0,.16);">
                            <tr>
                    <td align=center style="text-align: center; padding: 20px 20px 10px;">
                    @if($profile_picture)
                        <img src="{{ $message->embed($profile_picture) }}" alt="{{ $author }}" class="avatar-alpha"></td>
                    @else
                        <div class="avatar-alpha">{{$initials}}</div>
                    @endif
                    <td class="devices-deployment-name" style="display: none; vertical-align:top; text-align: left; padding: 8.5% 65% 0 29%; font-size: 9px; font-weight: 700; font-family: Lato, Helvetica, Arial, sans-serif; color: #fff;"> {{ $author }}</td>
                            </tr>
                            <tr>
                                <td class="padding-copy">
                                    <!-- MESSAGE -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="font-size: 25px; font-style: italic; font-family: Lato, Helvetica, Arial, sans-serif; color: #333333; padding: 0 20px 20px;" class="padding-copy"> {{ $msg }}</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size: 13px; font-weight: bold; font-family: Lato, Helvetica, Arial, sans-serif; color: #333333; padding: 0 20px 10px;" class="padding-copy">
                                              From {{$author}} at {{$org_name}}.
                                            </td>
                                        </tr>
                                        @if (count($answers) > 0)
                                            <tr>
                                                <td align="center" style="padding: 0 20px 20px; font-size: 16px; line-height: 25px; font-family: Lato, Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                                  Please select your answer below or reply directly to this email.
                                                  If you send an email reply, you can simply write
                                                  @foreach ($answers as $answer)
                                                  "{{$answer['answer']}},"
                                                  @endforeach
                                                  or write more if you'd like to provide more detail.
                                                  </td>
                                            </tr>
                                        @endif
                                    </table>
                                </td>
                            </tr>
                            @if (count($answers) > 0)
                            <tr>
                                <td align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#EFEFEB" class="mobile-button-container" style="border-top: 1px solid #E6E6DD;">
                                        <tbody><tr>
                                            <td align="center" class="padding-copy" style="padding: 20px;">
                                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table" style="min-width:50%;">
                                                  <tbody>

                                                    @for ($i = 0; $i < count($answers); $i++)
                                                    <tr>
                                                        <td align="center">
                                                          <a href="{{$answers[$i]['url']}}"
                                                            target="_blank"
                                                            style="width: 100%; font-size: 16px; font-family: Lato, Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: {{$answers[$i]['color']}}; border-top: 10px solid {{$answers[$i]['color']}}; border-bottom: 10px solid {{$answers[$i]['color']}}; border-left: 10px solid {{$answers[$i]['color']}}; border-right: 10px solid {{$answers[$i]['color']}}; border-radius: 5px; -webkit-border-radius: 5px; -moz-border-radius: 5px; display: inline-block; margin: 5px 0" class="mobile-button">
                                                            {{$answers[$i]['answer']}}
                                                          </a>
                                                        </td>
                                                    </tr>
                                                    @endfor

                                                </tbody>
                                              </table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#EFECE8" align="center" style="padding: 20px 0px;">
            <!-- UNSUBSCRIBE COPY -->
            <table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
                <tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Lato, Helvetica, Arial, sans-serif; color:#666666;">
                        <span class="appleFooter" style="color:#666666;">TenFour</span>
                        <br>
                        <a href="https://tenfour.org" class="original-only" style="color: #666666; text-decoration: none;">www.tenfour.org</a><span class="original-only" style="font-family: Lato, Arial, sans-serif; font-size: 12px; color: #444444;">
                        <br>
                        <a href="{{ $unsubscribe_url }}" class="original-only" style="color: #666666; text-decoration: underline;">I don't want to receive TenFour check-ins at this email address</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
