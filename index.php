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

        <!-- <main class="my-5">
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
        </main> -->

        <script>
        // Chuyển json về mảng trong javascript
        let arr = JSON.parse('<?=$arr_json?>');
        console.log(arr);
        // Mảng các lá bài là tây
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
            while (arr_1.length < arr.length) {
                let rand = Math.floor(Math.random() * arr.length);
                if (!arr_1.includes(rand)) {
                    arr_1.push(rand);
                }
            }
            return arr_1;
        }



        function chiabai(songuoi) {

            let sola = 3;

            let arr_2 = rand();

            let map = new Map();

            //console.log(arr_2);

            for (i = 0; i < songuoi; i++) {
                k = i;
                let arr_3 = [];

                for (j = 0; j < sola; j++) {
                    arr_3.push(arr_2[k]);
                    k += songuoi;
                }
                map.set('num' + i, arr_3);
            }

            return map;

        }

        let map = chiabai(3);

        map.forEach(function(value, key) {
            console.log(sum(value));
        });

        let max = Math.max(value);


        function sum(arr_4) {

            console.log(arr_4);

            let result = '';
            // tổng
            let total = 0;
            // mảng 3 tây
            let arr_t = [];

            for (i = 0; i < arr_4.length; i++) {

                let val = get_number(arr[arr_4[i]]);
                // check là 3 tây
                if (tien.includes(val)) {
                    arr_t.push(val);
                } else {
                    if (val == 'ace') {
                        total = total + 1;
                    } else {
                        total = total + Number(val);
                    }
                }
            }
            if (arr_t.length == 3) {
                result = '3 tây';
            } else {
                total = total.toString();
                result = total.slice(-1);
            }
            return result;
        }

        // document.getElementById('btn-submit').onclick = function() {
        //     let sum_s = sum();
        //     document.getElementById('result').innerHTML = sum_s;
        // }
        </script>
    </div>
</body>

</html>