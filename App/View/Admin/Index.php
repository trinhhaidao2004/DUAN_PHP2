<?php
namespace App\View\Admin;

class Index
{


    public static function render($data = null)
    {
        ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-xxl-12 mb-6 order-0">
                        <div class="row p-2  thongke">
                            <h4 class="card-title text-primary mb-3">Thống kê 🎉</h4>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-6 mb-6">
                                    <div class="card h-80">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                                <div class="text-primary title_card">
                                                    <a href="/admin/users" class="text-primary">Khách hàng</a>
                                                </div>
                                                <div class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                        <path
                                                            d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <p class="mb-1">Số lượng</p>
                                            <h4 class="card-title mb-3"><?= $data['total_user'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-6 mb-6">
                                    <div class="card h-80">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                                <div class="text-primary title_card">
                                                    <a href="/admin/products" class="text-primary">Sản phẩm</a>
                                                </div>
                                                <div class="icon_card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                        <path
                                                            d="M11 17.916V20H9v2h6v-2h-2v-2.084c3.162-.402 5.849-2.66 6.713-5.793.264-.952.312-2.03.143-3.206l-.866-6.059A1 1 0 0 0 18 2H6a1 1 0 0 0-.99.858l-.865 6.058c-.169 1.177-.121 2.255.143 3.206.863 3.134 3.55 5.392 6.712 5.794zM17.133 4l.57 4H6.296l.571-4h10.266z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <p class="mb-1">Số lượng</p>
                                            <h4 class="card-title mb-3"><?= $data['total_product'] ?></h4>

                                        </div>


                                    </div>
                                </div>
                                <div class="col-3 mb-6">
                                    <div class="card h-80">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                                <div class="text-primary title_card">
                                                    <a href="/admin/categories" class="text-primary">Loại sản phẩm</a>
                                                </div>
                                                <div class="icon_card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                        <path
                                                            d="M4 11h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm10 0h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zM4 21h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm13 0c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <p class="mb-1">Số lượng</p>
                                            <h4 class="card-title mb-3"><?= $data['total_category'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mb-6">
                                    <div class="card h-80">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                                <div class="text-primary title_card">
                                                    <a href="/admin/products" class="text-primary">Bình luận</a>
                                                </div>
                                                <div class="icon_card">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                        <path
                                                            d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z">
                                                        </path>
                                                    </svg>

                                                </div>
                                            </div>
                                            <p class="mb-1">Số lượng</p>
                                            <h4 class="card-title mb-3">5</h4>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Total Revenue -->
                    <div class="col-12 col-xxl-12 order-2 order-md-3 order-xxl-2 mb-6">
                        <div class="card">
                            <div class="row row-bordered g-0">
                                <div class="col-lg-12">
                                    <div>
                                        <canvas id="product_by_category"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xxl-12 order-2 order-md-3 order-xxl-2 mb-6 mt-3">
                        <div class="card">
                            <div class="row row-bordered g-0">
                                <div class="col-lg-12">
                                    <div class="card-header d-flex  justify-content-between">
                                        <h5 class="card-title mb-0">Thống kê doanh thu theo ngày <span id="text-date"></span></h5>
                                        <select class="form-select w-50" aria-label="Default select example">
                                            <option value="365">Tất cả</option>
                                            <option value="3">3 Ngày</option>
                                            <option value="5">5 Ngày</option>
                                            <option value="7">7 Ngày</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div id="myfirstchart" style="height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script>
            $(document).ready(function () {
                var char = new Morris.Bar({
                    element: 'myfirstchart',
                    xkey: 'order_day',
                    ykeys: ['total_value', 'total_orders'],
                    labels: ['Doanh thu (VND)', 'Số lượng bán ra']
                });
                function statistical(date) {
                    console.log('Selected date: ' + date);
                    $.ajax({
                        url: '/statistical',
                        method: 'POST',
                        dataType: 'JSON',
                        data: { date: date },
                        success: function (data) {
                            console.log(data);
                            char.setData(data);
                            $('#text-date').text('khoảng thời gian: ' + date + ' ngày');
                        }
                    });
                }
                statistical(365);
                $('.form-select').change(function () {
                    var date = $(this).val();
                    statistical(date);
                });
            });
        </script>

        <script>
            function producByCategory() {
                const ctx = document.getElementById('product_by_category');
                var php_data = <?= json_encode($data['product_by_category']) ?>;
                console.log(php_data);
                var labels = [];
                var data = [];
                for (let i of php_data) {
                    // console.log(i);
                    labels.push(i.name);
                    data.push(i.count);

                }
                console.log(labels);
                console.log(data);
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Số lượng sản phẩm ',
                            data: data,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }


            producByCategory();
        </script>
        <?php

    }
}