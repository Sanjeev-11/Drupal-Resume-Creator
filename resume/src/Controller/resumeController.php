<?php

namespace Drupal\resume\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\resume\Form\resumeForm;

class resumeController extends ControllerBase {

  public function resumeList() {
    $connection = mysqli_connect('localhost', 'root', '', 'resume_db');

    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM resume";
    $resume = mysqli_query($connection, $sql);

    mysqli_close($connection); 

    $form = \Drupal::formBuilder()->getForm(resumeForm::class);

    return [
      '#theme' => 'resumelist',
      '#title' => 'Resume Creator',
      '#details' => $resume,
      '#form' => $form,
    ];
  }

}

?>