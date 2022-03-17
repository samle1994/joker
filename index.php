<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Joker</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='plugins/bootstrap/css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link rel='stylesheet' type='text/css' href='css/media.css'>



</head>

<body>
    <div class="container">

        <?php

        //Lấy danh sách tên hình trong thư mục
        $path    = 'img/card';
        $files = array_values(array_diff(scandir($path), array('.', '..')));
        //echo '<pre>';echo print_r($files);echo '</pre>';
        $arr_json=json_encode($files);
        //print_r($arr_json);
    ?>

        <main class="my-5">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <img id="img-0" width="200" src="img/red_joker.png" alt="joker">
                </div>
                <div class="col-auto">
                    <img id="img-1" width="200" src="img/red_joker.png" alt="joker">
                </div>
                <div class="col-auto">
                    <img id="img-2" width="200" src="img/red_joker.png" alt="joker">
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-primary" id="btn-submit">Chia bài</button>
            </div>
            <div class=" d-flex justify-content-center mt-3">
                <button class="btn btn-danger">Số điểm là: <span id="result"></span></button>
            </div>
        </main>

        <script>
        // Chuyển json về mảng trong javascript
        let arr = JSON.parse('<?=$arr_json?>');

        // Mảng các lá bài là tiên
        let tien = ['jack', 'king', 'queen'];

        // lấy từ đầu tiên của img

        function get_number(name) {
            let arr_name = name.split("_");
            let number = arr_name[0];
            return number;
        }

        // radom ra 3 lá bài

        function rand(num) {

            let arr_1 = [];
            let tmp = '';
            let i = 0;
            while (arr_1.length < num) {
                let rand = Math.floor(Math.random() * arr.length);
                if (rand != tmp) {
                    tmp = rand;
                    // doi 3 la bai
                    element = document.getElementById('img-' + i);
                    element.setAttribute("src", 'img/card/' + arr[tmp]);
                    // lấy từ đầu tiên của img
                    let name = get_number(arr[tmp]);
                    // add vào mảng arr
                    arr_1.push(name);

                    i++;
                }
            }
            return arr_1;
        }

        function sum() {

            // mảng radom ra được 3
            let arr_2 = rand(3);
            // Kết quả trả về
            let result = '';
            // tổng
            let total = 0;
            // mảng 3 tiên
            let arr_t = [];
            // mảng cù
            let arr_in = [];

            let tmp = '';

            for (i = 0; i < arr_2.length; i++) {

                // check là cù
                if (tmp == arr_2[i]) {
                    arr_in.push(arr_2[i]);
                }

                tmp = arr_2[i];

                // check là 3 tiên
                if (tien.includes(arr_2[i])) {
                    arr_t.push(arr_2[i]);
                } else {
                    if (arr_2[i] == 'ace') {
                        total = total + 1;
                    } else {
                        total = total + Number(arr_2[i]);
                    }
                }
            }
            if (arr_t.length == 3) {
                result = '3 tiên';
            } else if (arr_in.length == 2) {
                result = 'cù';
            } else {
                total = total.toString();
                result = total.slice(-1);
            }
            return result;
        }

        document.getElementById('btn-submit').onclick = function() {
            let sum_s = sum();
            document.getElementById('result').innerHTML = sum_s;
        }
        </script>
    </div>
</body>

</html>