<?php
namespace App\View\Client\Component;

class Form
{
    private static string $placeholder = "Vui lòng nhập";

    public static function input($name = null, $label = null, $type = 'text', $value = "", $class = 'form-control', $placeholder = null, $readonly = null)
    {
        ?>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"><?= $label ?> </label>
            <input value="<?= $value ?>" name="<?= $name ?>" id="<?= $name ?>" type="<?= $type ?>" class="<?= $class ?>"
                placeholder="<?= $placeholder ?>" <?= $readonly ?> />
        </div>

        <?php
    }

    public static function textarea($name = null, $placeholder = null, $label = null)
    {
        ?>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"><?= $label ?></label>
            <textarea name="<?= $name ?>" id="message" class="form-control" rows="8"
                placeholder="<?= $placeholder ?>"></textarea>
        </div>
        <?php
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
    public static function button($type = 'submit', $value = "", $class = 'form-control')
    {
        ?>
        <button type="<?= $type ?>" class="<?= $class ?>"><?= $value ?></button>
        <?php
    }
    public static function button_icon($type = 'submit', $value = "", $class = 'form-control', $class_icon = null)
    {
        ?>
        <button type="<?= $type ?>" class="<?= $class ?>"><?= $value ?><i class="<?= $class_icon ?>"></i></button>
        <?php
    }





}