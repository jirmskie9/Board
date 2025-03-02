<div class="table-responsive shadow-sm p-3 bg-white rounded mb-4">
        <h3 class="mb-3">Payment History</h3>
        <table class="table table-bordered table-striped">
          <thead class="table-primary">
            <tr>
              <th class="text-center">#</th>
              <th>Month</th>
              <th class="text-center">Amount</th>
              <th class="text-center">Payment Date & Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM paymenthistory ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $count = 1;
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td class="text-center"><?php echo $count++; ?></td>
                  <td><?php echo date('F', strtotime($row['baseddate'])); ?></td>
                  <td class="text-center">
                    <span class="badge bg-warning text-dark">&#8369; <?php echo $row['amount']; ?></span>
                  </td>
                  <td class="text-center"><?php echo $row['paymentdate']; ?></td>
                </tr>
              <?php }
            } else {
              echo "<tr><td colspan='4' class='text-center'>No records found</td></tr>";
            }
            ?>
          </tbody>
        </table>
        <span class="fw-bold">Number of Transactions: <span style="color: red;" id="rowcount"><?php echo $result->num_rows; ?></span></span>
      </div>

      <!-- Applications Table -->
      <div class="table-responsive shadow-sm p-3 bg-white rounded">
        <h3 class="mb-3">Applications</h3>
        <table class="table table-bordered table-striped">
          <thead class="table-secondary">
            <tr>
              <th>Proof</th>
              <th>Valid ID</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM applications WHERE status = 'pending' AND user_id = '$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='proof' data-bs-toggle='modal' data-bs-target='#uploadModal'>Upload Proof of Income</a></td>";
                echo "<td><a href='#' class='upload-link' data-userid='{$row['user_id']}' data-field='valid_id' data-bs-toggle='modal' data-bs-target='#uploadModal'>Upload Valid ID</a></td>";
                echo "<td><span class='badge bg-warning text-dark'>{$row['status']}</span></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='3' class='text-center'>No pending applications found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      
      <!-- Bootstrap Modal -->
      <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Document</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="upload_application_file.php" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="user_id" id="modal_user_id">
                <input type="hidden" name="field_name" id="modal_field_name">

                <label for="file_upload" class="form-label">Choose File</label>
                <input type="file" name="file_upload" class="form-control" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
