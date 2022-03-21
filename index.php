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
            <div class="row">
                <div class="col-8">
                    <h1 class="mb-5 text-center">Bài 3 lá</h1>
                    <div id="result" class="row g-4 justify-content-center ">

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
                </div>
                <div class="col-4">
                    <form id="form" class="position-sticky" action="">
                        <h2 class="mb-3 text-center">Nhập vào số người chơi</h2>
                        <input type="number" autocomplete="off" id="number" required min="1" max="17"
                            class="form-control" placeholder="Nhập số người chơi">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3" id="btn-submit">Chia bài</button>
                        </div>
                        <button type="button" class="text-start w-100 btn btn-danger mt-3">Người thắng: <span
                                id="win"></span> </button>
                    </form>
                </div>
            </div>


        </main>

        <script>
        // Chuyển json về mảng trong javascript
        let arr_all = JSON.parse('<?=$arr_json?>');
        console.log(arr_all);
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
            while (arr_1.length < arr_all.length) {
                let rand = Math.floor(Math.random() * arr_all.length);
                if (!arr_1.includes(rand)) {
                    arr_1.push(rand);
                }
            }
            return arr_1;
        }

        function chiabai(songuoi) {

            let sola = 3;

            let arr_2 = rand();

            let arr_news_2 = arr_2.map(x => arr_all[x]);

            //console.log(arr_news_2);

            let map = new Map();

            for (i = 0; i < songuoi; i++) {
                k = i;
                let arr_3 = [];

                for (j = 0; j < sola; j++) {
                    let name = arr_news_2[k];
                    arr_3.push(name);
                    k += songuoi;
                }
                let key = {
                    num: sum(arr_3),
                    arr: arr_3
                };
                map.set('Name_' + i, key);
            }
            //console.log(map);
            return map;

        }

        function sum(arr_4) {

            let result = '';
            // tổng
            let total = 0;
            // mảng 3 tây
            let arr_t = [];

            for (let i = 0; i < arr_4.length; i++) {

                let val = get_number(arr_4[i]);
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

        document.getElementById('form').onsubmit = function() {

            let val = Number(document.getElementById('number').value);

            if (val > 0 && val <= 17) {
                //console.log(val);
                let map = chiabai(val);
                let html = '';
                let obj = [];
                let max = 0;
                for (let value of map) {
                    let arr_f = value[1]['arr'];
                    let num_f = value[1]['num'];
                    html += `<div class="col-6 row gx-4 gy-3 ">`;
                    html +=
                        `<div class="text-center"><h4>Người chơi: ${value[0]} </h4></div>`;
                    for (value1 of arr_f) {
                        html += `<div class="col-4">
                            <img class="img-fluid" src="img/card/${value1}" alt="joker">
                        </div>`;
                    }
                    html +=
                        `<div><button type="button" class="w-100 btn btn-danger mt-3" >Số điểm: ${num_f} </button></div>`;
                    html += `</div>`;

                    if (num_f == '3 tây') num_f = 10;

                    if (num_f > max) max = num_f;

                    obj.push({
                        name: value[0],
                        num: num_f,
                    });

                }
                document.getElementById('result').innerHTML = html;

                // Tìm tra người thắng cuộc

                let result = obj.filter(ob => ob.num == max);

                let result_string = '';

                for (let r of result) {
                    result_string += r['name'] + ' ';
                }
                document.getElementById('win').innerHTML = result_string;

                return false;

            } else {
                alert('Số người chơi lơn hơn và nhỏ hơn hoặc bằng 17');
                document.getElementById('number').value = '';
                return false;
            }
            return false;
        }
        </script>
    </div>
</body>

</html>