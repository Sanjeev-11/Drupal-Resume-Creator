<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
// use Drupal\Core\Database\Connection;
// use Psr\Container\ContainerInterface;

class resumeForm extends FormBase {

  // protected $database;

  // public function __construct(Connection $database) {
  //   $this->database = $database;
  // }

  // public static function create(ContainerInterface $container) {
  //   return new static(
  //     $container->get('database')
  //   );
  // }

  public function getFormId() {
    return 'resume_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['phone'] = [
      '#type' => 'number',
      '#title' => $this->t('Phone'),
      '#required' => TRUE,
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#required' => TRUE,
    ];

    

    $form['pg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post graduation'),
      '#required' => TRUE,
    ];

    $form['ug'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Under graduation'),
      '#required' => TRUE,
    ];

    $form['10th'] = [
      '#type' => 'textfield',
      '#title' => $this->t('10th'),
      '#required' => TRUE,
    ];

    $form['12th'] = [
      '#type' => 'textfield',
      '#title' => $this->t('12th'),
      '#required' => TRUE,
    ];

    $form['workexp'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Internship/Employment Details'),
      '#required' => TRUE,
    ];

    $form['skills'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Skills'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit Details'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $Name = $form_state->getValue('name');
    $Email = $form_state->getValue('email');
    $Phone = $form_state->getValue('phone');
    $Address = $form_state->getValue('address');
    $PG = $form_state->getValue('pg');
    $UG = $form_state->getValue('ug');
    $Tenth = $form_state->getValue('10th');
    $Twelfth = $form_state->getValue('12th');
    $Workexp = $form_state->getValue('workexp');
    $Skills = $form_state->getValue('skills');
   

    // Perform necessary actions with the submitted values
    // (e.g., insert the employee details into the database).

    // $insert = $this->database->insert('employee')
    //   ->fields([
    //     'EmpName' => $employeeName,
    //     'EmpSalary' => $employeeSalary,
    //   ])
    //   ->execute();

    // if ($insert) {
    //   $this->messenger()->addStatus($this->t('Employee added successfully.'));
    // } else {
    //   $this->messenger()->addError($this->t('Failed to add employee.'));
    // }
    $connection = mysqli_connect('localhost', 'root', '', 'resume_db');

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    
    // $employeeName = mysqli_real_escape_string($connection, $_POST["employeeName"]);
    // $employeeSalary = mysqli_real_escape_string($connection, $_POST["employeeSalary"]);

    // Insert the data into the database
    $sql = "INSERT INTO resume (Name,Email,Phone,Address,PG,UG,_10,_12,WorkExp,Skills)
            VALUES ('$Name', '$Email','$Phone','$Address','$PG','$UG','$Tenth','$Twelfth','$Workexp','$Skills')";

    if (mysqli_query($connection, $sql)) {
      $this->messenger()->addStatus($this->t('Employee added successfully.'));
    } else {
      $this->messenger()->addError($this->t('Failed to add employee.'));
    }
  }

}
}
