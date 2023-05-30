(function ($, Drupal, _drupalSettings) {

  'use strict';

  /**
   * Attaches the employee JavaScript behavior.
   */
  Drupal.behaviors.employee = {
    attach: function (context, _settings) {
      $('.employee-checkbox', context).once('employee').on('change', function () {
        toggleHikePercentage(this);
      });

      $('.hike-percentage-field', context).once('employee').on('change', function () {
        updateSalary(this);
      });
    }
  };
  

  /**
   * Toggles the display of the hike percentage container.
   */
  function toggleHikePercentage(checkbox) {
    const hikePercentageContainer = $(checkbox).next('.hike-percentage-container');
    hikePercentageContainer.toggle(checkbox.checked);
  }

  /**
   * Updates the displayed salary based on the hike percentage.
   */
  function updateSalary(input) {
    const hikePercentage = parseFloat($(input).val());
    if (!isNaN(hikePercentage)) {
      const salaryCell = $(input).closest('tr').find('td:nth-child(3)');
      const baseSalary = parseFloat(salaryCell.text());
      if (!isNaN(baseSalary)) {
        const updatedSalary = baseSalary + (baseSalary * hikePercentage) / 100;
        salaryCell.text(updatedSalary.toFixed(2));

        // Send the updated salary to the server-side for database update
        const employeeId = $(input).closest('tr').find('td:nth-child(1)').text();

        // Make an AJAX request to a PHP file or server-side endpoint
        $.ajax({
          url: '/emp/modules/custom/employee/update_salary.php',
          method: 'POST',
          data: {
            employeeId: employeeId,
            updatedSalary: updatedSalary
          },
          success: function (_response) {
            // Handle the response if needed
            console.log('Salary updated successfully');
          },
          error: function (_xhr, _status, error) {
            // Handle the error if the request fails
            console.error('Error updating salary:', error);
          }
        });
      }
    }
  }

})(jQuery, Drupal, drupalSettings);
