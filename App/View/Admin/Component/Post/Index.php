<?php


namespace App\View\Admin\Component\Post;

use App\View\Admin\Component\Form;

trait Index
{
    public static function Form($title,$url = null , $submit = "", $data = [])
    {
        ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row g-6 mb-6">
                    <!-- Basic -->
                    <div class="col-md-12">
                        <form action="<?= $url ?>" id="" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <h5 class="card-header"><?= $title ?></h5>
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <?php
                                    Form::input(name: 'title', placeholder: 'tiêu đề', label: 'Tiêu đề', value: $data['title'] ?? '');
                                    Form::input(name: 'author', placeholder: 'tác giả', label: 'Tác giả', value: $data['author'] ?? '');
                                    Form::image(name: 'image', value: $data['image'] ?? '');
                                    Form::textarea(name:'summary',placeholder: 'Vui lòng nhập mô tả',value: $data['summary'] ?? '', label: 'Mô tả ngắn');
                                    Form::textarea(name:'content',placeholder: 'Vui lòng nhập mô tả', value: $data['content'] ?? '');
                                    Form::button($submit);
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

