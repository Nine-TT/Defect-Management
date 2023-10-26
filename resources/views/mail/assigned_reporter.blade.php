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
    <h3 style="color: #7747FF; font-weight: 700; font-size: 24px; margin-top: 10px; text-align: center;">{{$content["projectName"]}}</h3>
    <p>Xin chào <strong>{{$user->lastName}} {{$user->firstName}},</strong></p>
    @if ($content["type"] != 'assigned')
    <p>
        Chúng tôi xin thông báo rằng bạn đã được giao công việc mới. Dưới đây là thông tin chi tiết về công việc:
    </p>
    <p>
        Tiêu đề : {{$content["jobTitle"]}}
    </p>
    <p>
        Nội dung : {{$content["jobContent"]}}
    </p>
    <p>Chúng tôi kỳ vọng bạn sẽ thực hiện công việc này một cách xuất sắc và đúng thời hạn</p>
    @elseif($content["type"] != 'reporter')
    <p>
        Chúng tôi xin thông báo rằng công việc mới đã được tạo thành công và bạn được chỉ định là người nhận báo cáo cho công việc này.
        Dưới đây là thông tin chi tiết về công việc và tiến trình thực hiện:
    </p>
    <p>
        Tiêu đề : {{$content["jobTitle"]}}
    </p>
    <p>
        Nội dung : {{$content["jobContent"]}}
    </p>
    @endif
    <p>Chúc bạn một ngày làm việc hiệu quả!</p>
    <p>Trân trọng, Phenikaa Bug Master</p>
    <div style="text-align: center;">
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/projects/{{$content['projectID']}}" target="_blank" style="text-decoration: none; display: inline-block; color: #ffffff; background-color: #7747FF; border-radius: 4px; padding: 5px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;">Chi tiết công việc</a>
    </div>
</div>
</body>

</html>
