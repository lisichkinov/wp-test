<?php

namespace Lisi4\Hello\Posttypes;

use Lisi4\Hello\Traits\{
  HasScripts,
  HasStyles,
  HasViews,
};

class Quiz
{
  use HasScripts, HasStyles, HasViews;

  public function __construct()
  {
    add_action('init', [$this, 'register'], 5);
    add_action('add_meta_boxes', [$this, 'addMetaBoxes'], 20);
    add_action('save_post_quiz', [$this, 'save']);
    add_action('admin_enqueue_scripts', [$this, 'addScriptsAndStyles']);
  }

  public function register()
  {
    register_post_type('quiz', [
      'label'         => null,
      'labels'        => [
        'name'               => __('Quizes', 'lisi4-hello'),
        'singular_name'      => __('Quiz', 'lisi4-hello'),
        'add_new'            => __('Add quiz', 'lisi4-hello'),
        'add_new_item'       => __('Add new quiz', 'lisi4-hello'),
        'edit_item'          => __('Edit quiz', 'lisi4-hello'),
        'new_item'           => __('New quiz', 'lisi4-hello'),
        'view_item'          => __('View quiz', 'lisi4-hello'),
        'search_items'       => __('Search quizes', 'lisi4-hello'),
        'not_found'          => __('No quizes found', 'lisi4-hello'),
        'not_found_in_trash' => __('No quizes found in trash', 'lisi4-hello'),
        'menu_name'          => __('Quizes', 'lisi4-hello'),
      ],
      'description'   => __('Some quizes', 'lisi4-hello'),
      'public'        => false,
      'show_ui'       => true,
      'show_in_menu'  => true,
      'menu_position' => 58,
      'menu_icon'     => 'dashicons-welcome-learn-more',
      'hierarchical'  => false,
      'supports'      => ['title', 'editor'],
      'has_archive'   => false,
      'query_var'     => false,
    ]);
  }

  public function addMetaBoxes()
  {
    $screen = 'quiz';

    add_meta_box(
      'lisi4-hello-questions',
      __('Questions', 'lisi4-hello'),
      [$this, 'renderQuestionsMetabox'],
      $screen
    );
  }

  public function renderQuestionsMetabox()
  {
    $questions = get_post_meta(get_the_ID(), 'questions', true);

    echo $this->render('metaboxes/questions', [
      'config' => [
        'questions' => $questions ? $questions : [],
      ]
    ]);
  }

  public function save($id)
  {
    $questions  = filter_input(INPUT_POST, 'questions');

    update_post_meta($id, 'questions', $questions);
    // TODO: save
  }

  public function addScriptsAndStyles()
  {
    $screen = get_current_screen();

    if ($screen->id !== 'quiz') {
      return;
    }

    $this
      ->registerStyle('quiz-style-admin', 'admin.css')
      ->registerScript('quiz-script-admin', 'admin.tsx.js', ['react', 'react-dom'])
      ->addStyle('quiz-style-admin')
      ->addScript('quiz-script-admin');
  }
}
