<?php
if (!function_exists("currency_format")) {
    function currency_format($text = '', $currency = '')
    {
        if ($_SESSION['currency'] == 'CAD') {
            $currency_symbol = 'C$';
        } else {
            $currency_symbol = '$';
        }
        if ($currency == 'CAD') {
            $currency_symbol = 'C$';
        } if ($currency == 'USD') {
            $currency_symbol = '$';
        } 
        return $currency_symbol . ' ' . $text;
    }
}

if (!function_exists("astrik")) {
    function astrik()
    {
        return '<span class="text-danger">*</span>';
    }
}

if (!function_exists("date_format_book")) {
    function date_format_book($date = '')
    {
        if ($date != '') {
            return date('l, d F Y', strtotime($date));
        }
        return '';
    }
}

if (!function_exists("mail_button")) {
    function mail_button($data = array())
    {

        if (!empty($data)) {
            return '<!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="' . $data['url'] . '" style="mso-wrap-style:none; mso-position-horizontal: center" arcsize="5%" strokecolor="#B0A378" strokeweight="1px" fillcolor="linear-gradient(97.39deg, #B0A378 15.69%, #5C5E62 86.72%)">
                <v:textbox style="mso-fit-shape-to-text:true;v-text-anchor:middle-center;">
                <center style="color:#ffffff;font-size:16px;font-weight:normal;text-transform: uppercase;v-text-anchor:middle-center;background: linear-gradient(97.39deg, #B0A378 15.69%, #5C5E62 86.72%);">' . $data['text'] . '</center>
                </v:textbox>
                </v:roundrect>
            <![endif]-->
            <![if !mso]>
            <table>
                <tbody>
                    <tr>
                        <td align="center" bgcolor="#B0A378" style="border-radius:5px;text-decoration:none;font-weight:normal;background: linear-gradient(97.39deg, #B0A378 15.69%, #5C5E62 86.72%);">
                            <a href="' . $data['url'] . '" style="font-weight:normal;color:#ffffff;text-decoration:none;border-radius:5px;padding:10px 20px;display:inline-block;font-size: 16px;text-transform: uppercase;" target="_blank">
                                ' . $data['text'] . '
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <![endif]>';
        }
        return '';
    }
}

if (!function_exists("get_current_date")) {
    function get_current_date()
    {
        return date('Y-m-d h:i:s');
    }
}


function get_flash_data($session_flash = array())
{
    $flashdata = "";

    if ($fd = $session_flash['success']) {
        $flashdata = "<div class='alert alert-success alert-dismissible'>";
        //$flashdata .= "<button type='button' class='close btn-close' data-dismiss='alert' aria-label='close'></button>";
        $flashdata .= "<i class='flaticon-checked alert-i'></i><label class='alert-label'>" . $fd . "</label>";
        $flashdata .= "</div>";
    } elseif ($fd = $session_flash['error']) {
        $flashdata = "<div class='alert alert-danger alert-dismissible'>";
        //$flashdata .= "<button type='button' class='close btn-close' data-dismiss='alert' aria-label='close'></button>";
        $flashdata .= "<i class='flaticon-multiply-1 alert-i'></i><label class='alert-label'>" . $fd . "</label>";
        $flashdata .= "</div>";
        //$flashdata = 'Swal.fire("Good job!", "You clicked the button!", "error");';
    } elseif ($fd = $session_flash['fileerror']) {
        $flashdata = "<div class='alert alert-danger alert-dismissible'>";
        //$flashdata .= "<button type='button' class='close btn-close' data-dismiss='alert' aria-label='close'></button>";
        $flashdata .= "Following errors are related to uploaded files: <br/><ul>";
        foreach ($fd as $name => $error) {
            $flashdata .= "<li>$name - $error</li>";
        }
        $flashdata .= "</ul></div>";
    }

    if ($error != '') {
        $flashdata .= $error;
    }
    return $flashdata;
}

function get_flash_data_($session_flash = array())
{
    $flashdata = "";

    if ($fd = $session_flash['success']) {
        $flashdata = '<div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">' . $fd . '</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>';
    } elseif ($fd = $session_flash['error']) {
        $flashdata = '<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">' . $fd . '</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>';

    } elseif ($fd = $session_flash['fileerror']) {

        $error = "Following errors are related to uploaded files: <br/><ul>";
        foreach ($fd as $name => $error) {
            $error .= "<li>$name - $error</li>";
        }
        $error .= "</ul>";

        $flashdata = '<div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">' . $error . '</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>';
    }

    if ($error != '') {
        $flashdata .= $error;
    }
    return $flashdata;
}
