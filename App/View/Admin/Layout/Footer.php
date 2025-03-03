<?php
namespace App\View\Admin\Layout;

class Footer
{


    public static function render($data = null)
    {
        ?>
        <script>
            CKEDITOR.replace('summary');
            CKEDITOR.replace('content');
            CKEDITOR.replace('description');
        </script>
        <script>
            function confirmDelete(url, item) {
                if (confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')) {
                    window.location.href = '/admin/' + url + '/delete/model/' + item;
                }
            }

        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $(document).on('change', '.form-check-input', function () {
                    let id = $(this).data('id');
                    let pages = $(this).data('pages');
                    let status = $(this).data('status'); // Lấy trạng thái mới của checkbox
                    console.log("ID: ", pages);
                    console.log(window.location.href);
                    if (id) {
                        $.ajax({
                            url: '/update/status',
                            method: 'POST',
                            data: {
                                id: id,
                                url: window.location.href,
                                status: status,
                                pages: pages,
                            },
                            success: function (response) {
                                $("#alert").fadeIn().delay(5000).fadeOut();
                            },
                            error: function (xhr, status, error) {
                                console.log("AJAX Error:", xhr.responseText);
                                alert('Có lỗi xảy ra!');
                            }
                        });
                    } else {
                        window.location.href = '/admin';
                    }
                });
            });

        </script>
        <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->



        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/jquery/jquery.js"></script>

        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/popper/popper.js"></script>
        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/js/bootstrap.js"></script>
        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/@algolia/autocomplete-js.js"></script>



        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/pickr/pickr.js"></script>



        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>


        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/hammer/hammer.js"></script>

        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/i18n/i18n.js"></script>


        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
        <script src="<?= APP_URL ?>/public/Admin/assets/vendor/libs/select2/select2.js"></script>

        <!-- Main JS -->

        <script src="<?= APP_URL ?>/public/Admin/assets/js/main.js"></script>


        <!-- Page JS -->
        <script src="<?= APP_URL ?>/public/Admin/assets/js/app-ecommerce-product-list.js"></script>
        </body>

        </html>

        <?php

    }
}