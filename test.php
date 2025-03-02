<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Table with Double Click</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Bootstrap Table with Double Click</h2>
    <table id="table" class="table table-bordered" data-toggle="table" data-pagination="true">
      <thead>
        <tr>
          <th data-field="id">ID</th>
          <th data-field="name">Name</th>
          <th data-field="price">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Item 1</td>
          <td>$10</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Item 2</td>
          <td>$20</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery for easier handling -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    // Handle double-click event on table rows
    $('#table tbody tr').on('dblclick', function() {
      // Retrieve the row data
      const rowId = $(this).find('td:first').text();
      const itemName = $(this).find('td:nth-child(2)').text();
      const price = $(this).find('td:nth-child(3)').text();

      // Display an alert or trigger a modal with details (or perform any action)
      alert('Double-clicked on Item ID: ' + rowId + '\nName: ' + itemName + '\nPrice: ' + price);

      // Optionally: Open a modal or perform other actions here
      // $('#myModal').modal('show');  // Example for opening a modal
    });
  </script>
</body>
</html>
