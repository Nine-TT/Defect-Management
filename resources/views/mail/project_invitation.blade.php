<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thông báo tham gia dự án</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        p {
            line-height: inherit;
        }

        .desktop_hide,
        .desktop_hide img {
            display: none !important;
        }

        @media (max-width: 500px) {
            .desktop_hide {
                display: block !important;
            }

            .mobile_hide {
                display: none !important;
            }
        }
    </style>
</head>

<body style="background-color: #fff; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<div style="max-width: 480px; margin: 0 auto; padding: 20px; font-family: Arial, Helvetica, sans-serif; color: #000;">
    <div style="text-align: center;">
        <img src="https://f85ec2983f.imgdist.com/public/users/Integrators/BeeProAgency/1078917_1064219/logo_phenikaa_bugs_master.png" alt="Logo" style="max-width: 120px; width: 100%; height: auto;">
    </div>
    <h3 style="color: #7747FF; font-weight: 700; font-size: 24px; margin-top: 10px; text-align: center;">Thư mời tham gia dự án</h3>
    <p>Xin chào <strong>{{$user->lastName}} {{$user->firstName}},</strong></p>
    <p>Bạn đã được {{$content["inviter"]}} thêm vào dự án "{{$content['projectName']}}"</p>
    <p>Bạn có quyền truy cập và tham gia vào dự án này.</p>
    @if ($content["role"] != 'Viewer')
    <p>Vai trò của bạn trong dự án là: <strong>{{$content["role"]}}</strong></p>
    @endif
    <p>Chúc bạn một ngày làm việc hiệu quả!</p>
    <p>Trân trọng, Phenikaa Bug Master</p>
    <div style="text-align: center;">
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/projects/{{$content['projectID']}}" target="_blank" style="text-decoration: none; display: inline-block; color: #ffffff; background-color: #7747FF; border-radius: 4px; padding: 5px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;">Truy cập dự án</a>
    </div>
</div>
</body>

</html>
