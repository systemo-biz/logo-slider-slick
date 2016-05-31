<?php
/*
Create team model
*/

class LogoModelS {

  function __construct() {
      add_action('init', array($this, 'cpt'));
  }

  function cpt(){
      $labels = array(
        'name'=>'Логотипы',
        'singular_name'=>'Логотип',
        'add_new'=>'Добавить',
        'add_new_item'=>'Добавить',
        'edit_item'=>'Редактировать',
        'new_item'=>'Новый',
        'view_item'=>'Просмотр',
        'search_items'=>'Поиск',
        'not_found'=>'Не найден',
        'parent_item_colon'=>''
      );

     $supports = array(
      'editor',
      'title',
      'thumbnail',
     );

    register_post_type('logo-s', array(
        'supports'=> $supports,
        'label'=>$labels['singular_name'],
        'labels'=>$labels,
        'public' => true,
        'menu_icon'   => 'dashicons-art',
        'has_archive'         => false,
    ));
  }

} $TheLogoModelS = new LogoModelS;

//add_image_size( 'team-thumb', 333, 333, true );
