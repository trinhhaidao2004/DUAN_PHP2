
// này của trang sản phẩm
$(document).ready(function () {
    $(document).on("click", ".category-product", function (e) {
        e.preventDefault(); // Ngăn chặn chuyển trang (nếu có)
        var categoryId = $(this).data("id");

        console.log("Danh mục ID:", categoryId); // Kiểm tra giá trị

        $.ajax({
            url: "/categories/products",
            type: "POST",
            data: { category_id: categoryId },
            success: function (response) {
                $("#product-list-select").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Lỗi AJAX:", status, error);
            }
        });
    });
});
$(document).ready(function () {
    $(document).on("click", ".category-age-product", function (e) {
        e.preventDefault(); // Ngăn chặn chuyển trang (nếu có)
        var id = $(this).data("id");

        console.log("Danh mục ID:", id); // Kiểm tra giá trị

        $.ajax({
            url: "/age/products",
            type: "POST",
            data: { id: id },
            success: function (response) {
                $("#product-list-select").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Lỗi AJAX:", status, error);
            }
        });
    });
});


// naỳ của trang chủ 
$(document).ready(function () {
    loadProducts(0);
    $(".category-filter").click(function (e) {
        e.preventDefault();
        var categoryId = $(this).data("id");
        loadProducts(categoryId);
    });
    function loadProducts(categoryId) {
        $.ajax({
            url: "/categories/select/products",
            type: "POST",
            data: { category_id: categoryId },
            success: function (response) {
                $("#product-list").html(response);
            }
        });
    }
});

// lấy đơn hàng theo tranbgj thái 
$(document).ready(function () {
    loadProducts(9);
    $(".account-trash-filter").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        
        loadProducts(id);
    });
    function loadProducts(id) {
        $.ajax({
            url: "/trashcan/select/order",
            type: "POST",
            data: { id: id },
            success: function (response) {
                $("#order-list").html(response);
            }
        });
    }
});

