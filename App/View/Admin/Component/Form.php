<?php

namespace App\View\Admin\Component;

use Dotenv\Parser\Value;

class Form
{
    private static string $placeholder = "Vui lòng nhập";

    public static function input($name = null, $placeholder = null, $type = 'text', $value = "", $class = 'form-control', $label = null, $id = null)
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/edit/' . $id):
            ?>
            <div class="form-password-toggle">
                <label class="form-label" for="basic-default-password12"><?= $label ?></label>
                <div class="input-group">
                    <input type="<?= $type ?>" class="<?= $class ?>" placeholder=" <?= self::$placeholder . " " . $placeholder ?>"
                        name="<?= $name ?>" value="<?= $value ?>" readonly>
                </div>
            </div>
            <?php
        else:
            ?>
            <div class="form-password-toggle">
                <label class="form-label" for="basic-default-password12"><?= $label ?></label>
                <div class="input-group">
                    <input type="<?= $type ?>" class="<?= $class ?>" placeholder=" <?= self::$placeholder . " " . $placeholder ?>"
                        name="<?= $name ?>" value="<?= $value ?>">
                </div>
            </div>
            <?php
        endif;
    }
    public static function password($label, $name = null, $value = "", $id = null)
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($url === 'http://' . $_SERVER['HTTP_HOST'] . '/admin/users/edit/' . $id):
            ?>
            <div class="form-password-toggle">
                <label class="form-label" for="basic-default-password12"><?= $label ?></label>
                <div class="input-group">
                    <input type="password" class="form-control" name="<?= $name ?>" value="<?= $value ?>" placeholder="············"
                        readonly>
                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            <?php
        else:
            ?>
            <div class="form-password-toggle">
                <label class="form-label" for="basic-default-password12"><?= $label ?></label>
                <div class="input-group">
                    <input type="password" class="form-control" name="<?= $name ?>" value="<?= $value ?>"
                        placeholder="············">
                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            <?php
        endif;
    }
    public static function image($name = null, array|string $value = "")
    {
        ?>
        <div class="form-password-toggle">
            <label class="form-label" for="basic-default-password12">Hình ảnh</label>
            <div class="input-group">
                <input type="file" class="form-control" name="<?= $name ?>" value="<?= $value ?>">
                <label class="input-group-text" for="inputGroupFile02">Tải lên</label>
            </div>
        </div>
        <?php
    }
    public static function email($name = null, $placeholder = null, $type = 'text', array|string $value = "", $class = 'form-control', $label = null)
    {
        ?>
        <div class="form-password-toggle">
            <label class="form-label" for="basic-default-password12"><?= $label ?></label>
            <div class="input-group">
                <input type="<?= $type ?>" class="<?= $class ?>" placeholder=" <?= self::$placeholder . " " . $placeholder ?>"
                    name="<?= $name ?>" value="<?= $value ?>">
                <span class="input-group-text" id="basic-addon13">@gmail.com</span>
            </div>
        </div>
        <?php
    }
    public static function textarea($name = 'description', $placeholder = null, $value = "", $label = 'Mô tả')
    {
        ?>
        <div>
            <label for="exampleFormControlTextarea1" class="form-label"><?= $label ?></label>
            <textarea class="form-control" name="<?= $name ?>" id="<?= $name ?>" rows="3"
                placeholder=" <?= self::$placeholder . " " . $placeholder ?>"><?= $value ?></textarea>
        </div> <?php
    }
    public static function select($name = null, $title = null, $data = [])
    {
        ?>
        <div class="mb-4">
            <label for="exampleFormControlSelect1" class="form-label"><?= $title ?></label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="<?= $name ?>">
                <option value="">Vui lòng chọn...</option>
                <?php
                foreach ($data as $key => $value):
                    $optionValue = isset($value['id']) ? $value['id'] : $key;
                    $optionText = isset($value['name']) ? $value['name'] : $value;
                    ?>
                    <option value="<?= $optionValue ?>">
                        <?= $optionText ?>
                    </option>
                    <?php
                endforeach;
                ?>
            </select>
        </div> <?php
    }
    public static function select_is_featured($data, $item = [], $name = null, $title = null, )
    { // data là mảng chứa biến data ['status, summary .....']; của db
        // status là mảng của value và text
        ?>
        <div class="mb-4">
            <label for="exampleFormControlSelect1" class="form-label"><?= $title ?></label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="<?= $name ?>">
                <option value="">Vui lòng chọn...</option>
                <?php
                foreach ($item as $key => $value):
                    ?>
                    <option value="<?= $key ?>" <?php if ($data == $key)
                          echo 'selected="selected"'; ?>><?= $value ?></option>
                    <?php
                endforeach;
                ?>

            </select>
        </div> <?php
    }

    // danh mục sản phẩm
    public static function select_category($name = null, $title = null, $data = [])
    {
        ?>

        <div class="mb-4">
            <label for="exampleFormControlSelect1" class="form-label"><?= $title ?></label>
            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="category_id">
                <?php
                foreach ($data['categories'] as $item):
                    ?>
                    <option value="<?= $item['id'] ?>" <?= ($item['id'] == $data['products']['category_id']) ? 'selected' : '' ?>>
                        <?= $item['name'] ?>
                    </option>
                    <?php
                endforeach;
                ?>
            </select>
        </div> <?php
    }

    public static function button($value)
    {
        ?>
        <button type="submit" class="btn btn-primary"><?= $value ?></button>
        <?php
    }

    public static function status($item = [], $page = null)
    {
        if ($item['status'] == 1):
            ?>
            <!-- Hiển thị -->
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                    data-id="<?= $item['id'] ?>" data-status="<?= $item['status'] ?>" data-pages="<?= $page ?>" checked>
            </div>
            <?php
        else:
            ?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                    data-id="<?= $item['id'] ?>" data-status="<?= $item['status'] ?>" data-pages="<?= $page ?>">
            </div>
        <?php endif;
    }
    public static function edit_update($url, $item)
    {
        ?>
        <div class="edit_delete text-nowrap">
            <a href="/admin/<?= $url ?>/edit/<?= $item ?>" class="btn btn-icon"><i class="icon-base bx bx-edit icon-md"></i></a>
            <form action="/admin/<?= $url ?>/delete/<?= $item ?>" method="POST"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                <button type="submit" class="submit_buton" style="border: none; background: none; cursor: pointer;">
                    <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1)">
                        <path
                            d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z">
                        </path>
                        <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
                    </svg>
                </button>
            </form>
        </div>
        <?php
    }
    public static function edit_update_trashcan($url, $item)
    {
        ?>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <form class="w-100" action="/admin/<?= $url ?>/delete/<?= $item ?>" method="post"
                    onsubmit="return confirm('Bạn có chắc xóa khôi phục?')">
                    <input type="hidden" name="method" value="POST" id="">
                    <button class="dropdown-item"><i class="bx bxs-color me-1"></i> Khôi phục</button>
                </form>
                <a href="/admin/<?= $url ?>/delete/model/<?= $item ?>">
                    <button type="button" class="dropdown-item" onclick="return confirm('Bạn có muốn xóa vĩnh viễn không?');">
                        <i class="bx bx-trash me-1"></i> Xóa
                    </button>
                </a>
            </div>
        </div>
        <?php
    }


}